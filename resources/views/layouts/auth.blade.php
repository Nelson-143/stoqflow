<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="manifest" href="/manifest.json">
        <meta name="theme-color" content="#7ed957">
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>StoqFlow</title>
        {{--- <script defer data-api="/stats/api/event" data-domain="preview.tabler.io" src="{{ asset('stats/js/script.js') }}"></script> ---}}
        <meta name="msapplication-TileColor" content="#7ed957"/>
        <meta name="theme-color" content="#7ed957"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>
        <link rel="icon" href="{{ asset('frontend/assets/img/favicon.png') }}" type="image/x-icon"/>
<meta name="description" content="StoqFlow helps you control your stock, master your flow, and run your business with confidence. Powered by RomanSofts.">
<meta name="canonical" content="https://stoqflow.com/">
<meta name="twitter:image:src" content="{{ asset('frontend/assets/img/logo.png') }}">
<meta name="twitter:site" content="@stoqflow">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="StoqFlow | Control Your Stock. Master Your Flow.">
<meta name="twitter:description" content="Know what you have. Know what to buy. Avoid losses with StoqFlow. Powered by RomanSofts.">
<meta property="og:description" content="StoqFlow helps you stay in control of stock, sales, and business flow with one clear system. Powered by RomanSofts.">

        <!-- CSS files -->
        <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet"/>
        <style>
            @import url('https://rsms.me/inter/inter.css');
            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
                --tblr-primary: #7ed957;
                --tblr-primary-rgb: 126, 217, 87;
                --tblr-link-color: #2f7d16;
                --tblr-body-bg: #f7fbf5;
                --tblr-body-color: #111111;
            }
            body {
                font-feature-settings: "cv03", "cv04", "cv11";
                background: url('{{ asset("assets/bgg.jpg") }}') center center / cover no-repeat fixed;
            }
            .btn-primary {
                --tblr-btn-bg: #7ed957;
                --tblr-btn-border-color: #7ed957;
                --tblr-btn-hover-bg: #69c148;
                --tblr-btn-hover-border-color: #69c148;
                --tblr-btn-color: #000000;
                --tblr-btn-active-bg: #69c148;
                --tblr-btn-active-border-color: #69c148;
            }
            .card,
            .form-control,
            .input-group-text {
                border-color: rgba(0, 0, 0, 0.12);
            }
            .navbar-brand-autodark {
                background: url('{{ asset("frontend/assets/img/logo.png") }}') center center no-repeat;
                background-size: contain;
                width: 200px;
                height: 200px;
                display: inline-block;
                margin-left: 0.5rem;
            }
        </style>
        @stack('page-styles')
    </head>
    <body class="d-flex flex-column">
        <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>

        <div class="page page-center">
            <div class="container container-tight py-4">
              <div class="text-center mb-4">
    <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark">
    </a>
</div>

                @include('components.alert')

                @if (session('status'))
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <h3 class="mb-1">Success</h3>
                        <p>{{ session('status') }}</p>

                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

        <!-- Libs JS -->
        <!-- Tabler Core -->
        <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
        <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
        @stack('page-scripts')
    </body>
</html>
