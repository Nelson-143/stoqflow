<?php

namespace app\Http\Controllers\Product;

use app\Http\Controllers\Controller;
use app\Http\Requests\Product\StoreProductRequest;
use app\Http\Requests\Product\UpdateProductRequest;
use app\Models\Category;
use app\Models\Product;
use app\Models\Unit;
use app\Models\Supplier;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure authentication
    }

    public function index()
    {
        // Temporarily remove pagination for debugging
        $products = Product::with(['category', 'unit', 'supplier'])
            ->orderBy('created_at', 'desc')
            ->get();

        Log::debug('All products without pagination', [
            'count' => $products->count(),
            'items' => $products->pluck('id')
        ]);

        return view('products.index', ['products' => $products]);
    }

  public function create(Request $request)
{
    $categories = Category::all();
    $units = Unit::all();
    $suppliers = Supplier::all();
    $locations = \App\Models\Location::where('account_id', auth()->user()->account_id)->get();

    return view('products.create', compact('categories', 'units', 'suppliers', 'locations'));
}

public function store(StoreProductRequest $request)
{
    $data = $request->validated();
    $data['uuid'] = Str::uuid();
    $data['user_id'] = auth()->id();
    $data['account_id'] = auth()->user()->account_id;
    $data['slug'] = Str::slug($data['name']);

    // Set default quantity to 0 (will be updated from locations)
    $data['quantity'] = 0;

    // Auto-generate product code if not provided
    if (empty($data['code'])) {
        $data['code'] = IdGenerator::generate([
            'table' => 'products',
            'field' => 'code',
            'length' => 10,
            'prefix' => 'PRD-'
        ]);
    }

    // Handle image upload
    if ($request->hasFile('product_image')) {
        $file = $request->file('product_image');
        $destinationPath = public_path('assets/img/products/');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move($destinationPath, $fileName);
        $data['product_image'] = 'assets/img/products/' . $fileName;
    }

    // Handle expire date
    if ($request->has('expire_date_toggle') && $request->expire_date_toggle == 'on') {
        $data['expire_date'] = $request->expire_date;
    } else {
        $data['expire_date'] = null;
    }

    // Create the product
    $product = Product::create($data);

    // Handle location stocks using the correct relationship
    $totalQuantity = 0;
    if ($request->has('location_ids') && $request->has('quantities')) {
        foreach ($request->location_ids as $index => $locationId) {
            if (!empty($locationId) && isset($request->quantities[$index]) && $request->quantities[$index] > 0) {
                $quantity = $request->quantities[$index];
                $totalQuantity += $quantity;

                // Use productLocations() relationship
                $product->productLocations()->create([
                    'location_id' => $locationId,
                    'quantity' => $quantity,
                    'account_id' => auth()->user()->account_id
                ]);
            }
        }
    }

    // Update total quantity
    $product->update(['quantity' => $totalQuantity]);

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}
    public function show($uuid)
{
    $product = Product::with(['category', 'unit', 'supplier', 'user'])
                     ->where('uuid', $uuid)
                     ->firstOrFail();

    // Verify account access in middleware instead
    $this->authorize('view', $product);

    $barcode = (new BarcodeGeneratorHTML())->getBarcode($product->code, 'C128');
    return view('products.show', compact('product', 'barcode'));
}

public function edit($uuid)
{
    $accountId = auth()->user()->account_id;

    $product = Product::where('uuid', $uuid)
                        ->where('account_id', $accountId)
                        ->with('stocks') // Eager load stocks
                        ->firstOrFail();

    $categories = Category::all();
    $units = Unit::all();
    $suppliers = Supplier::all();
    $locations = \App\Models\Location::where('account_id', $accountId)->get();

    return view('products.edit', compact('product', 'categories', 'units', 'suppliers', 'locations'));
}
public function update(UpdateProductRequest $request, $uuid)
{
    $accountId = auth()->user()->account_id;
    $product = Product::where('uuid', $uuid)
                        ->where('account_id', $accountId)
                        ->firstOrFail();

    $data = $request->validated();
    $data['slug'] = Str::slug($data['name']);
    $data['account_id'] = auth()->user()->account_id;

    // Auto-generate code if empty
    if (empty($data['code'])) {
        $data['code'] = IdGenerator::generate([
            'table' => 'products',
            'field' => 'code',
            'length' => 10,
            'prefix' => 'PRD-'
        ]);
    }

    // Handle image upload
    if ($request->hasFile('product_image')) {
        $file = $request->file('product_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('assets/img/products');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $fileName);

        // Delete old image if exists
        if ($product->product_image && file_exists(public_path($product->product_image))) {
            unlink(public_path($product->product_image));
        }

        $data['product_image'] = 'assets/img/products/' . $fileName;
    } else {
        $data['product_image'] = $product->product_image;
    }

    // Handle expire date
    if ($request->has('expire_date_toggle') && $request->expire_date_toggle == 'on') {
        $data['expire_date'] = $request->expire_date;
    } else {
        $data['expire_date'] = null;
    }

    $product->update($data);

    // Update location stocks
    $totalQuantity = 0;
    if ($request->has('location_ids') && $request->has('quantities')) {
        // Delete existing product locations
        $product->productLocations()->delete();

        // Create new product locations
        foreach ($request->location_ids as $index => $locationId) {
            if (!empty($locationId) && isset($request->quantities[$index]) && $request->quantities[$index] > 0) {
                $quantity = $request->quantities[$index];
                $totalQuantity += $quantity;

                $product->productLocations()->create([
                    'location_id' => $locationId,
                    'quantity' => $quantity,
                    'account_id' => auth()->user()->account_id
                ]);
            }
        }
    }

    // Update total quantity
    $product->update(['quantity' => $totalQuantity]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}
public function destroy($uuid)
{
    $accountId = auth()->user()->account_id;

    $product = Product::where('uuid', $uuid)
                     ->where('account_id', $accountId)
                     ->firstOrFail();

    // Remove image if exists
    if ($product->product_image && file_exists(public_path($product->product_image))) {
        unlink(public_path($product->product_image));
    }

    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}
}
