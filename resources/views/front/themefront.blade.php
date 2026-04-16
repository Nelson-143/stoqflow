<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="StoqFlow helps you control your stock, master your flow, and run your business with confidence. Know what you have, know what to buy, and avoid losses. Powered by RomanSofts.">

    <title>@yield('title', 'Welcome | StoqFlow')</title>

    <meta name="author" content="StoqFlow">
    <meta name="keywords" content="StoqFlow, stock management, inventory management, sales tracking, business flow, stock control, business software, RomanSofts">
    <meta name="application-name" content="StoqFlow">
    <meta name="msapplication-TileColor" content="#4ba600">
    <meta name="theme-color" content="#0054a6">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <link rel="icon" href="{{ asset('frontend/assets/img/favicon.png') }}" type="image/x-icon">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/config.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/libs.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">

    <style>
        /* ── Active nav link highlight ── */
        .main-menu li a.nav-active {
            color: #4ba600;
            border-bottom: 2px solid #4ba600;
            padding-bottom: 3px;
        }

        /* ── Nav link sizing ── */
        .main-menu li a {
            font-size: 13px;
            letter-spacing: 0.6px;
            transition: color 0.2s ease;
        }

        /* ── Header action buttons side by side ── */
        .bringer-header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>

    <!-- ═══════════════════════════════════════
         HEADER
    ════════════════════════════════════════ -->
    <header id="bringer-header" class="is-frosted is-sticky" data-appear="fade-down" data-unload="fade-up">

        <!-- Desktop Header -->
        <div class="bringer-header-inner">

            <!-- Logo -->
            <div class="bringer-header-lp">
                <a href="{{ route('about_master.route') }}" class="bringer-logo">
                    <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="StoqFlow" width="180">
                </a>
            </div>

            <!-- Main Navigation -->
            <div class="bringer-header-mp">
                <nav class="bringer-nav">
                    <ul class="main-menu" data-stagger-appear="fade-down" data-stagger-delay="75">

                        <li>
                            <a href="{{ route('about_master.route') }}"
                               class="{{ request()->routeIs('about_master.route') ? 'nav-active' : '' }}">
                                HOME
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('habout.route') }}"
                               class="{{ request()->routeIs('habout.route') ? 'nav-active' : '' }}">
                                ABOUT US
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('service.route') }}"
                               class="{{ request()->routeIs('service.route') ? 'nav-active' : '' }}">
                                SERVICES
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('price.route') }}"
                               class="{{ request()->routeIs('price.route') ? 'nav-active' : '' }}">
                                PRICING
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('contact.route') }}"
                               class="{{ request()->routeIs('contact.route') ? 'nav-active' : '' }}">
                                CONTACT
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>

            <!-- Login / Sign Up Buttons -->
            <div class="bringer-header-actions">
                <a href="{{ route('login') }}" class="bringer-button">Login</a>
                <a href="{{ route('register') }}" class="bringer-button">Sign Up</a>
            </div>

        </div>
        <!-- /Desktop Header -->

        <!-- Mobile Header -->
        <div class="bringer-mobile-header-inner">
            <a href="{{ route('about_master.route') }}" class="bringer-logo">
                <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="StoqFlow" width="180">
            </a>
            <a href="#" class="bringer-mobile-menu-toggler">
                <i class="bringer-menu-toggler-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </i>
            </a>
        </div>
        <!-- /Mobile Header -->

    </header>
    <!-- /HEADER -->


    <!-- ═══════════════════════════════════════
         PAGE MAIN CONTENT
    ════════════════════════════════════════ -->
    <main id="bringer-main">

        @yield('content')


        <!-- ═══════════════════════════════════════
             FOOTER
        ════════════════════════════════════════ -->
        <footer id="bringer-footer" data-appear="fade-up" data-unload="fade-down">

            <!-- Footer Widgets -->
            <div class="bringer-footer-widgets">
                <div class="stg-container">
                    <div class="stg-row" data-stagger-appear="fade-left" data-stagger-delay="100">

                        <!-- Brand Info -->
                        <div class="stg-col-5 stg-tp-col-12 stg-tp-bottom-gap-l">
                            <div class="bringer-info-widget">
                                <a href="{{ route('about_master.route') }}" class="bringer-logo footer-logo">
                                    <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="StoqFlow" width="150">
                                </a>
                                <div class="bringer-info-description">
                                    StoqFlow helps business owners stay in control of stock, sales, and daily decisions
                                    with one clear system. Know what you have. Know what to buy. Avoid losses.
                                    Powered by RomanSofts.
                                </div>
                                <span class="bringer-label">Follow us:</span>
                                <ul class="bringer-socials-list" data-stagger-appear="fade-up" data-stagger-delay="75">
                                    <li>
                                        <a href="#" target="_blank" class="bringer-socials-facebook"><i></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/romansofts/" target="_blank" class="bringer-socials-instagram"><i></i></a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="bringer-socials-x"><i></i></a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="bringer-socials-tiktok"><i></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Brand Info -->

                        <!-- About Links -->
                        <div class="stg-col-2 stg-tp-col-4 stg-m-col-4">
                            <div class="bringer-widget">
                                <h6>About Us</h6>
                                <div class="bringer-menu-widget">
                                    <ul>
                                        <li><a href="{{ route('habout.route') }}">About Us</a></li>
                                        <!-- <li><a href="{{ route('team.route') }}">Our Team</a></li> -->
                                        <li><a href="{{ route('about_master.route') }}">Welcome</a></li>
                                        <li><a href="{{ route('contact.route') }}">Get in Touch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /About Links -->

                        <!-- Resources Links -->
                        <div class="stg-col-2 stg-tp-col-4 stg-m-col-4">
                            <div class="bringer-widget">
                                <h6>Resources</h6>
                                <div class="bringer-menu-widget">
                                    <ul>
                                        <li><a href="{{ route('price.route') }}">Pricing</a></li>
                                        <li><a href="{{ route('contact.route') }}">Contact Us</a></li>
                                        <li><a href="{{ route('service.route') }}">Our Services</a></li>
                                        <li><a href="{{ route('register') }}">Create Account</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /Resources Links -->

                    </div>
                </div>
            </div>
            <!-- /Footer Widgets -->

            <!-- Copyright -->
            <div class="bringer-footer-line stg-container">
                <div class="align-center">
                    Copyright &copy; {{ date('Y') }} | StoqFlow. Powered by <a href="https://romansofts.co.tz">RomanSofts</a>.
                </div>
            </div>
            <!-- /Copyright -->

        </footer>
        <!-- /FOOTER -->

    </main>
    <!-- /PAGE MAIN -->


    <!-- Right Click Protection -->
    <div class="bringer-rcp-wrap">
        <div class="bringer-rcp-overlay"></div>
        <div class="bringer-rcp-container">
            <h2>#StoqFlow</h2>
        </div>
    </div>

    <!-- Dynamic Backlight -->
    <div class="bringer-backlight"></div>

    <!-- Scripts -->
    <script src="{{ asset('frontend/assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/lib/libs.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/contact_form.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/st-core.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/classes.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

</body>
</html>
