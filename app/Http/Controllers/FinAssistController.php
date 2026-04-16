<?php

namespace App\Http\Controllers;

use App\Services\FinAssistService;
use App\Models\AnalysisConversations;
use App\Models\AnalysisMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class FinAssistController extends Controller
{
    protected $finAssistService;

    public function __construct(FinAssistService $finAssistService)
    {
        $this->finAssistService = $finAssistService;
    }

    public function index()
    {
        $conversations = AnalysisConversations::with('messages')->latest()->get();
        return view('finAssist.finassist', compact('conversations'));
    }

    public function handleQuery(Request $request)
    {
        $userInput = trim($request->input('message'));

        // Validate input
        if (empty($userInput)) {
            return response()->json(['response' => 'Please enter a message.'], 400);
        }

        // 🔒 Rate Limit: 3 chats per day per user
        $userId = Auth::id() ?? $request->ip();
        $cacheKey = "finassist:limit:{$userId}:" . now()->toDateString();
        $dailyLimit =10;

        $chatCount = Cache::get($cacheKey, 0);
        if ($chatCount >= $dailyLimit) {
            return response()->json([
                'response' => "⚠️ You've reached your daily limit of {$dailyLimit} chats. Please try again tomorrow."
            ], 429);
        }
        Cache::put($cacheKey, $chatCount + 1, now()->endOfDay());

        // 🎯 Handle greetings
        if ($this->isGreeting($userInput)) {
            $name = Auth::user()?->name ?? 'there';
            return response()->json(['response' => $this->handleGreeting($name)]);
        }

        // 🎯 Handle predefined queries (exact keyword matching to avoid false positives)
        $predefined = $this->getPredefinedResponse($userInput);
        if ($predefined) {
            return response()->json(['response' => $predefined]);
        }

        // 🤖 Call Groq API
        $botResponse = $this->callGroqApi($userInput);

        return response()->json(['response' => $botResponse]);
    }

    /**
     * Call Groq API with proper error handling
     */
    private function callGroqApi(string $userInput): string
    {
        try {
            $apiKey = env('GROQ_API_KEY');

            if (empty($apiKey)) {
                Log::error('Groq API key not configured');
                return 'Service configuration error. Please contact support.';
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])
            ->timeout(15)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant', // ✅ Verified working model
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are StoqFlow Assist, a helpful AI assistant for inventory management and financial analysis. Keep responses concise, professional, and actionable.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $userInput
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);

            // Log raw response for debugging (remove in production if needed)
            Log::debug('Groq API Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->failed()) {
                $error = $response->json('error.message') ?? $response->status();
                Log::error('Groq API Failed', ['error' => $error, 'body' => $response->body()]);

                if ($response->status() === 429) {
                    return 'Rate limit exceeded. Please wait a moment and try again.';
                }
                if ($response->status() === 401) {
                    return 'Authentication error. Please check API configuration.';
                }
                throw new \Exception("API error: {$error}");
            }

            // Parse response - Groq returns OpenAI-compatible format
            $data = $response->json();
            $content = $data['choices'][0]['message']['content'] ?? null;

            if (empty($content)) {
                Log::warning('Groq returned empty content', ['response' => $data]);
                return 'I received your question but could not generate a response. Please try rephrasing.';
            }

            return trim($content);

        } catch (\Throwable $e) {
            Log::error('FinAssist Groq Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 'StoqFlow Assist is temporarily unavailable. Please try again later.';
        }
    }

    /**
     * Check if message is a greeting
     */
    private function isGreeting(string $message): bool
    {
        $greetings = ['hi', 'hello', 'hey', 'good morning', 'good afternoon', 'good evening'];
        $lower = strtolower($message);

        foreach ($greetings as $greeting) {
            if (str_contains($lower, $greeting)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Handle greeting responses
     */
    private function handleGreeting(string $userName): string
    {
        return "Hello {$userName}! 👋 StoqFlow Assist is here to help with your inventory and financial questions. What would you like to know?";
    }

    /**
     * Return predefined response for exact keyword matches only
     * Uses stricter matching to avoid intercepting AI-worthy queries
     */
    private function getPredefinedResponse(string $message): ?string
    {
        $lower = strtolower($message);

        // Only match if message is VERY short and exactly about these topics
        // This prevents "What about sales forecast trends?" from being intercepted
        $exactMatches = [
            'sales forecast' => 'Based on historical data, your sales forecast shows steady growth. Consider optimizing high-performing products.',
            'stock reorder' => 'It looks like some items are running low. Would you like me to generate a reorder list?',
            'profit margin' => 'Your current profit margin is 25%. To improve, consider adjusting pricing or reducing costs.',
        ];

        // Only use predefined if message length < 30 chars (simple queries)
        if (strlen($lower) < 30) {
            foreach ($exactMatches as $keyword => $response) {
                if (str_contains($lower, $keyword)) {
                    return $response;
                }
            }
        }

        return null; // Let AI handle complex/longer queries
    }
}
