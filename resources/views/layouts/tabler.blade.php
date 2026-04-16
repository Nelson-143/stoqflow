<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="StoqFlow helps you control your stock, master your flow, and run your business with confidence. Powered by RomanSofts." />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#7ed957" />

    <!-- Open Graph / Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@stoqflow" />
    <meta name="twitter:title" content="StoqFlow | Control Your Stock. Master Your Flow." />
    <meta name="twitter:description" content="Know what you have. Know what to buy. Avoid losses with StoqFlow." />
    <meta name="twitter:image:src" content="{{ asset('logo.png') }}" />
    <meta property="og:description" content="StoqFlow helps you stay in control of stock, sales, and business flow with one clear system. Powered by RomanSofts." />

    <link rel="manifest" href="{{ asset('manifest.json') }}" />
    <link rel="icon" href="{{ asset('frontend/assets/img/favicon.png') }}" />

    <title>@yield('title', 'StoqFlow')</title>

    <!-- Tabler CSS -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />

    <!-- Lord Icons -->
    <script src="https://cdn.lordicon.com/lordicon.js"></script>

    <style>
        @import url('https://rsms.me/inter/inter.css');

        /* ── Brand Variables ── */
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica Neue, sans-serif;
            --tblr-primary: #7ed957;
            --tblr-primary-rgb: 126, 217, 87;
            --tblr-link-color: #2f7d16;
            --tblr-body-bg: #f7fbf5;
            --tblr-body-color: #111111;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .btn-primary,
        .btn-outline-primary {
            --tblr-btn-bg: #7ed957;
            --tblr-btn-border-color: #7ed957;
            --tblr-btn-hover-bg: #69c148;
            --tblr-btn-hover-border-color: #69c148;
            --tblr-btn-color: #000;
            --tblr-btn-active-bg: #69c148;
            --tblr-btn-active-border-color: #69c148;
        }

        .form-control:focus { box-shadow: none; }

        /* ── Blur Page Loader ── */
        #page-loader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 14px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background: rgba(247, 251, 245, 0.55);
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }

        #page-loader.fade-out {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .loader-logo {
            width: 56px;
            height: 56px;
            object-fit: contain;
            animation: loader-pulse 1.2s ease-in-out infinite;
        }

        @keyframes loader-pulse {
            0%, 100% { transform: scale(1);   opacity: 1; }
            50%       { transform: scale(1.1); opacity: 0.7; }
        }

        .loader-bar {
            width: 160px;
            height: 3px;
            background: rgba(126, 217, 87, 0.2);
            border-radius: 99px;
            overflow: hidden;
        }

        .loader-bar-fill {
            height: 100%;
            width: 40%;
            background: #7ed957;
            border-radius: 99px;
            animation: loader-slide 1s ease-in-out infinite;
        }

        @keyframes loader-slide {
            0%   { transform: translateX(-100%); }
            100% { transform: translateX(400%); }
        }

        .loader-text {
            font-size: 12px;
            color: #555;
            letter-spacing: 0.04em;
        }

        /* ── Lord icon alignment ── */
        lord-icon {
            vertical-align: middle;
            margin-right: 6px;
        }
    </style>

    @stack('page-styles')
    @livewireStyles
</head>

<body>
    <!-- Theme script must run before body renders -->
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>

    <!-- ═══════════════════════════════════
         BLUR PAGE LOADER
    ════════════════════════════════════ -->
    <div id="page-loader">
        <img src="{{ asset('frontend/assets/img/favicon.png') }}" alt="StoqFlow" class="loader-logo" />
        <div class="loader-bar"><div class="loader-bar-fill"></div></div>
        <span class="loader-text">Loading StoqFlow…</span>
    </div>

    <script>
        window.addEventListener('load', function () {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.classList.add('fade-out');
                setTimeout(() => loader.remove(), 450);
            }
        });
    </script>


    <!-- ═══════════════════════════════════
         EMAIL VERIFICATION BANNER
    ════════════════════════════════════ -->
    @if (auth()->check() && !auth()->user()->hasVerifiedEmail())
        <div class="alert alert-warning mb-0 rounded-0 text-center">
            Please verify your email address sent to <strong>{{ auth()->user()->email }}</strong>.
            <a href="{{ route('verification.resend') }}" class="alert-link ms-1">Resend link</a>
        </div>
    @endif


    <div class="page">

        <!-- ═══════════════════════════════════
             TOP NAVBAR (Logo + User Actions)
        ════════════════════════════════════ -->
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-xl">

                <!-- Mobile toggler -->
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Logo -->
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('frontend/assets/img/favicon.png') }}" alt="StoqFlow"
                             style="width:44px; height:44px; object-fit:contain;" />
                    </a>
                </h1>

                <!-- Right side: theme toggle, notifications, user menu -->
                <div class="navbar-nav flex-row order-md-last">

                    <!-- Dark / Light toggle -->
                    <div class="d-none d-md-flex align-items-center me-1">
                        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark"
                           title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"/>
                            </svg>
                        </a>
                        <a href="?theme=light" class="nav-link px-0 hide-theme-light"
                           title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
                                <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Notifications -->
                    <x-notification-panel />

                    <!-- User dropdown -->
                    <div class="nav-item dropdown ms-2">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0"
                           data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-rounded"
                                  style="background-color:#7ed957; color:#000; width:36px; height:36px; line-height:36px; text-align:center; font-size:13px; font-weight:600;">
                                {{ substr(Auth::user()->name, 0, 1) }}{{ substr(Auth::user()->name, strpos(Auth::user()->name, ' ') + 1, 1) }}
                            </span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="mt-1 small text-muted">{{ Auth::user()->getRoleNames()->first() }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"/>
                                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"/>
                                </svg>
                                {{ __('Account') }}
                            </a>

                            @role('Super Admin')
                            <a href="{{ route('subscriptions.index') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                                    <path d="M12.5 17h-6.5v-14h-2"/>
                                    <path d="M6 5l14 1l-.854 5.977m-2.646 1.023h-10.5"/>
                                    <path d="M19 22v-6"/><path d="M22 19l-3 -3l-3 3"/>
                                </svg>
                                {{ __('Subscriptions') }}
                            </a>
                            @endrole

                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"/>
                                        <path d="M9 12h12l-3 -3"/><path d="M18 15l3 -3"/>
                                    </svg>
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </header>


        <!-- ═══════════════════════════════════
             BOTTOM NAVBAR (Navigation Links)
        ════════════════════════════════════ -->
        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar">
                    <div class="container-xl">
                        <ul class="navbar-nav">

                            {{-- Dashboard --}}
                            <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0"/>
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/>
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">{{ __('Dashboard') }}</span>
                                </a>
                            </li>

                            {{-- Products --}}
                            <li class="nav-item dropdown {{ request()->is('products*', 'shelf-products*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z"/>
                                            <path d="M2 13.5v5.5l5 3"/><path d="M7 16.545l5 -3.03"/>
                                            <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z"/>
                                            <path d="M12 19l5 3"/><path d="M17 16.5l5 -3"/>
                                            <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5"/>
                                            <path d="M7 5.03v5.455"/><path d="M12 8l5 -3"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">{{ __('Products') }}</span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="{{ route('products.index') }}">{{ __('Products') }}</a>
                                            <a class="dropdown-item" href="{{ route('shelf-products.index') }}">{{ __('Shelf Products') }}</a>
                                            <a class="dropdown-item" href="{{ route('location-setup') }}">{{ __('Stock Adjustment') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            {{-- Orders --}}
                            <li class="nav-item dropdown {{ request()->is('orders*', 'pos*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5"/>
                                            <path d="M12 12l8 -4.5"/><path d="M12 12v9"/><path d="M12 12l-8 -4.5"/>
                                            <path d="M15 18h7"/><path d="M19 15l3 3l-3 3"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">{{ __('Orders') }}</span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="{{ route('orders.index') }}">{{ __('All Orders') }}</a>
                                            <a class="dropdown-item" href="{{ route('orders.complete') }}">{{ __('Completed') }}</a>
                                            <a class="dropdown-item" href="{{ route('orders.pending') }}">{{ __('Pending') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            {{-- Purchases (Super Admin only) --}}
                            @role('Super Admin')
                            <li class="nav-item dropdown {{ request()->is('purchases*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5"/>
                                            <path d="M12 12l8 -4.5"/><path d="M12 12v9"/><path d="M12 12l-8 -4.5"/>
                                            <path d="M22 18h-7"/><path d="M18 15l-3 3l3 3"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">{{ __('Purchases') }}</span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="{{ route('purchases.index') }}">{{ __('All') }}</a>
                                            <a class="dropdown-item" href="{{ route('purchases.approvedPurchases') }}">{{ __('Approval') }}</a>
                                            <a class="dropdown-item" href="{{ route('purchases.purchaseReport') }}">{{ __('Daily Report') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endrole

                            {{-- Pages (misc features) --}}
                            <li class="nav-item dropdown {{ request()->is('suppliers*','customers*','debts*','expenses*','stock*','budgets*','gamification*','quotations*','ads*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"/>
                                            <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">{{ __('Pages') }}</span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <!-- <a class="dropdown-item" href="{{ route('quotations.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/rguiapej.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Quotations') }}
                                            </a> -->
                                            @role('Super Admin')
                                            <a class="dropdown-item" href="{{ route('suppliers.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/pbrgppbb.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Suppliers') }}
                                            </a>
                                            @endrole
                                            <a class="dropdown-item" href="{{ route('customers.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/iazmohzf.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Customers') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('debts.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/xuyycdjx.json" trigger="morph" colors="primary:black" state="morph-card" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Debts') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('expenses.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/gjjvytyq.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Expenses') }}
                                            </a>
                                            @role('Super Admin')
                                            <a class="dropdown-item" href="{{ route('budgets.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/ncitidvz.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Budgets') }}
                                            </a>
                                            @endrole
                                            <a class="dropdown-item" href="{{ route('stock.transfer') }}">
                                                <lord-icon src="https://cdn.lordicon.com/qnpnzlkk.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Transfer / Damage') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('ads.generator') }}">
                                                <lord-icon src="https://cdn.lordicon.com/wsaaegar.json" trigger="hover" stroke="bold" colors="primary:#000000,secondary:#000000" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Ads Generator') }}
                                            </a>
                                            @role('Super Admin')
                                            <a class="dropdown-item" href="{{ route('gamification.board') }}">
                                                <lord-icon src="https://cdn.lordicon.com/jyjslctx.json" trigger="morph" state="morph-pie-chart" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('StoqFlow Play') }}
                                            </a>
                                            @endrole
                                        </div>
                                    </div>
                                </div>
                            </li>

                            {{-- Reports (Super Admin only) --}}
                            @role('Super Admin')
                            <li class="nav-item {{ request()->is('reports*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('reports.index') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10 3.2a9 9 0 1 0 10.8 10.8a1 1 0 0 0 -1 -1h-6.8a2 2 0 0 1 -2 -2v-7a.9 .9 0 0 0 -1 -.8"/>
                                            <path d="M15 3.5a9 9 0 0 1 5.5 5.5h-4.5a1 1 0 0 1 -1 -1v-4.5"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">{{ __('Reports') }}</span>
                                </a>
                            </li>

                            {{-- StoqFlow Assist --}}
                            <li class="nav-item {{ request()->is('finassist*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('finassist') }}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M13 3l0 7l6 0l-8 11l0 -7l-6 0l8 -11"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">{{ __('StoqFlow Assist') }}</span>
                                </a>
                            </li>
                            @endrole

                            {{-- Settings --}}
                            <li class="nav-item dropdown {{ request()->is('users*','categories*','units*','team*','branches*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"/>
                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">{{ __('Settings') }}</span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="{{ route('categories.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/jnikqyih.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Categories') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('units.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/jgnvfzqg.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Units') }}
                                            </a>
                                            @role('Super Admin')
                                            <a class="dropdown-item" href="{{ route('admin.team.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/hrjifpbq.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Your Team') }}
                                            </a>
                                            <a class="dropdown-item" href="{{ route('branches.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/mjcariee.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Set Branch') }}
                                            </a>
                                            @endrole
                                            <a class="dropdown-item" href="{{ route('locations.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/bpmglzll.json" trigger="hover" colors="primary:black" style="width:20px;height:20px"></lord-icon>
                                                {{ __('Set Location') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            {{-- Language --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M4 5h7"/><path d="M7 4c0 4.846 0 7 .5 8"/>
                                            <path d="M10 8.5c0 2.286 -2 4.5 -3.5 4.5s-2.5 -1.135 -2.5 -2c0 -2 1 -3 3 -3s5 .57 5 2.857c0 1.524 -.667 2.571 -2 3.143"/>
                                            <path d="M12 20l4 -9l4 9"/><path d="M19.1 18h-6.2"/>
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">{{ __('Language') }}</span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            <a class="dropdown-item" href="{{ route('change-locale', 'en') }}">EN {{ __('English') }}</a>
                                            <a class="dropdown-item" href="{{ route('change-locale', 'sw') }}">🇹🇿 {{ __('Swahili') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </header>


        <!-- ═══════════════════════════════════
             PAGE CONTENT
        ════════════════════════════════════ -->
        <div class="page-wrapper">
            <div>
                @yield('content')
                @yield('finassist')
                @yield('Debts')
                @yield('rsmplay')
                @yield('stocktrans')
                @yield('Damage')
                @yield('matumizi')
                @yield('budget')
                @yield('report')
            </div>

            <!-- ═══════════════════════════════════
                 FOOTER
            ════════════════════════════════════ -->
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; {{ now()->year }}
                                    <a href="." class="link-secondary">StoqFlow</a>. Powered by RomanSofts.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>
    {{-- /page --}}


    <!-- ═══════════════════════════════════
         SCRIPTS
    ════════════════════════════════════ -->
    @stack('page-libraries')
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
    @stack('page-scripts')
    @livewireScripts

    <!-- Notification helpers -->
    <script>
        function markAllAsRead() {
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
            }).then(r => r.json()).then(d => { if (d.message) location.reload(); });
        }

        function markNotificationAsRead(id) {
            fetch(`/notifications/${id}/mark-as-read`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
            }).then(r => r.json()).then(d => { if (d.message) location.reload(); });
        }
    </script>

    <!-- PWA Service Worker -->
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('{{ asset('service-worker.js') }}')
                .then(reg => console.log('SW registered:', reg.scope))
                .catch(err => console.error('SW failed:', err));
        }
    </script>

</body>
</html>
