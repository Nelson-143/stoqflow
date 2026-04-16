@extends('front.themefront')

@section('title')
    Welcome | StoqFlow
@endsection

@section('me')
    @parent
@endsection

@section('content')
<div class="stg-container">
            <!-- Hero Section -->
            <section>
                <div class="bringer-hero-block bringer-hero-type01">
                    <!-- Main Line -->
                    <div class="stg-row stg-bottom-gap-l stg-m-bottom-gap-l">
                       <div class="stg-col-9 stg-tp-col-8 stg-m-col-12">
                        <!-- Title -->
                        <h1 class="bringer-page-title" id="typed-title" data-split-appear="fade-up" data-split-unload="fade-up"></h1>
                        </div>

                        <!-- Include Typed.js (via CDN) -->
                        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
                        <script>
                        var typed = new Typed('#typed-title', {
                            strings: [
                            "StoqFlow<br>Control Your Stock. Master Your Flow.<br>Know what you have. Know what to buy."
                            ],
                            typeSpeed: 50,       // typing speed
                            backSpeed: 30,       // backspacing speed
                            backDelay: 10000,     // pause before clearing
                            loop: true,          // repeat indefinitely
                            smartBackspace: true // only erase what’s necessary
                        });
                        </script>

                        <div class="stg-col-3 stg-tp-col-4 stg-m-col-12">
                            <!-- Social Proof -->
                            <div class="bringer-hero-social-proof">
                                <div data-stagger-appear="fade-up" data-stagger-delay="100" data-stagger-unload="fade-up">
                                    <img src=" {{ asset('frontend/assets/img/home/rs.png') }}" alt="Client 03">
                                    <a href="https://www.romansofts.co.tz/" target="_blank">rs</a>
                                </div>
                                <p data-appear="fade-up" data-unload="fade-up" data-delay="200">Built for control. Powered by RomanSofts.</p>
                            </div>
                        </div>
                    </div><!-- .stg-row -->

                    <!-- Masked Media Container -->
                    <div class="bringer-hero-media-wrap bringer-masked-bottom-right bringer-masked-block stg-bottom-gap-l" data-appear="zoom-out" data-unload="zoom-out">
                        <!-- Masked Media -->
                        <div class="bringer-masked-media bringer-masked-media bringer-parallax-media">
                            <img src=" {{ asset('frontend/assets/img/home/girl.jpg') }}" alt="Unleash Your Creativity">
                        </div>
                        <!-- Content -->
                        <div class="bringer-masked-content at-bottom-right">
                            <a href="#page01" class="bringer-square-button" data-appear="fade-left">
                                <span class="bringer-icon bringer-icon-arrow-down"></span>
                            </a>
                        </div>
                    </div>

                    <!-- Additional Information Line -->
                    <div class="stg-row stg-valign-bottom">
                        <div class="stg-col-3 stg-tp-col-3 stg-m-col-6" data-appear="fade-up" data-delay="200" data-unload="fade-up">
                            <div class="bringer-counter bringer-small-counter" data-delay="3000">
                                <div class="bringer-counter-number">7</div>
                                <div class="bringer-counter-label">Business tools in one clear flow</div>
                            </div><!-- .bringer-counter -->
                        </div>

                        <div class="stg-col-6 stg-tp-col-6 stg-m-col-12 stg-m-top-gap" data-appear="fade-up" data-delay="400" data-unload="fade-up">
                            <p class="bringer-large-text">Take control of your stock. Run your business with confidence. StoqFlow helps you know what you have, know what to buy, and avoid losses before they grow.</p>
                        </div>
                    </div><!-- .stg-row -->
                </div><!-- .bringer-hero-block -->
            </section>

            <!-- Section: Steps -->
            <section class="backlight-top" id="page01">
                <div class="stg-bottom-gap-l">
                    <h2 data-appear="fade-up" data-unload="fade-up">How StoqFlow keeps your business in flow</h2>
                </div>
                <!-- Step 01 Row -->
                <div class="stg-row stg-bottom-gap stg-valign-middle stg-m-bottom-gap-l" data-unload="fade-left">
                    <div class="stg-col-3 stg-offset-3 stg-tp-col-6 stg-m-bottom-gap" data-appear="fade-right">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src=" {{ asset('frontend/assets/img/null.jpg') }}" data-src=" {{ asset('frontend/assets/img/home/ph.jpg') }}" alt="Step 01" width="960" height="960">
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-6" data-appear="fade-right" data-delay="100">
                        <span class="bringer-label">Stock Control</span>
                        <h4>Know what you have at all times</h4>
                        <p><span class="bringer-highlight">01:</span> Track stock clearly across products, movements, and locations so you always know what is available.</p>
                        <p><span class="bringer-highlight">02:</span> Get smart suggestions on what to buy next before shortages slow down your business.</p>
                    </div>
                </div>
                <!-- Step 02 Row -->
                <div class="stg-row stg-bottom-gap stg-valign-middle stg-tp-row-reverse stg-m-bottom-gap-l" data-unload="fade-right">
                    <div class="stg-col-3 stg-tp-col-6 stg-m-bottom-gap" data-appear="fade-left">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src=" {{ asset('frontend/assets/img/null.jpg') }}" data-src=" {{ asset('frontend/assets/img/home/gr.jpg') }}" alt="Step 02" width="960" height="960">
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-6" data-appear="fade-left" data-delay="100">
                        <span class="bringer-label">Financial Clarity</span>
                        <h4>See sales, debt, and cash flow in one place</h4>
                        <p><span class="bringer-highlight">01:</span> Follow sales, invoices, and expenses with less guesswork and better daily decisions.</p>
                        <p><span class="bringer-highlight">02:</span> Stay in control of customer balances and business spending with a clear view of your numbers.</p>
                    </div>
                    <div class="stg-col-3"><!-- Empty Column --></div>
                </div>
                <!-- Step 03 Row -->
                <div class="stg-row stg-bottom-gap stg-valign-middle stg-m-bottom-gap-l" data-unload="fade-left">
                    <div class="stg-col-3 stg-offset-3 stg-tp-col-6 stg-m-bottom-gap" data-appear="fade-right">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src=" {{ asset('frontend/assets/img/null.jpg') }}" data-src=" {{ asset('frontend/assets/img/home/ics.jpg') }}" alt="Step 03" width="960" height="960">
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-6" data-appear="fade-right" data-delay="100">
                        <span class="bringer-label">Trusted Access</span>
                        <h4>Keep your business data safe and organized</h4>
                        <p><span class="bringer-highlight">01:</span> Manage your operations with role-based access and a system built for reliable day-to-day use.</p>
                        <p><span class="bringer-highlight">02:</span> Work with confidence knowing your records are structured, protected, and easy to find.</p>
                    </div>
                </div>
                <!-- Step 04 Row -->
                <div class="stg-row stg-valign-middle stg-tp-row-reverse" data-unload="fade-right">
                    <div class="stg-col-3 stg-tp-col-6 stg-m-bottom-gap" data-appear="fade-left">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src=" {{ asset('frontend/assets/img/null.jpg') }}" data-src=" {{ asset('frontend/assets/img/home/hom.jpg') }}" alt="Step 04" width="960" height="960">
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-6" data-appear="fade-left" data-delay="100">
                        <span class="bringer-label">Business Flow</span>
                        <h4>Stay on top of your business from anywhere</h4>
                        <p><span class="bringer-highlight">01:</span> Keep stock, sales, and decisions moving with a system that stays simple, fast, and easy to use every day.</p>
                    </div>
                    <div class="stg-col-3"><!-- Empty Column --></div>
                </div>
            </section>

            <!-- Section: About Us -->
            <section class="backlight-bottom divider-top">
                <div class="stg-row stg-large-gap stg-valign-middle stg-tp-column-reverse">
                    <div class="stg-col-6" data-appear="fade-right" data-unload="fade-left">
                        <h3>Built for businesses that need clarity</h3>
                        <p class="bringer-large-text">StoqFlow gives you the control to reduce waste, avoid stockouts, and run with confidence.</p>
                        <p>From the shop floor to sales reporting, every part of the system is designed to help you stay organized and move faster.</p>
                        <div class="align-right">
                            <a href="{{ route('habout.route') }}" class="bringer-arrow-link">Learn More About Us</a>
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-bottom-gap-l stg-m-bottom-gap" data-unload="fade-right" data-appear="fade-left">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src=" {{ asset('frontend/assets/img/null.jpg') }}" data-src=" {{ asset('frontend/assets/img/home/s.jpg') }}" alt="About Us" width="960" height="960">
                        </div>
                    </div>
                </div><!-- .stg-row -->
            </section>


            <!-- Section: Our Services -->
            <section class="backlight-top">
                <!-- Section Title -->
                <div class="stg-row bringer-section-title">
                    <div class="stg-col-8 stg-offset-2">
                        <div class="align-center">
                            <h2 data-appear="fade-up" data-unload="fade-up">What StoqFlow helps you do</h2>
                            <p class="bringer-large-text" data-appear="fade-up" data-unload="fade-up" data-delay="100">StoqFlow helps you run your business smoothly, from inventory to sales, in one place. Simple to use, clear to trust, and built to keep your flow moving.</p>
                        </div>
                    </div>
                </div>
                <!-- Services List -->
                <div class="bringer-detailed-list-wrap" data-appear="fade-up" data-unload="fade-up" data-delay="200">
                    <ul class="bringer-detailed-list">
                        <li>
                            <div class="bringer-detailed-list-title">
                                <h4>Control stock with confidence</h4>
                            </div>
                            <div class="bringer-detailed-list-description">
                                <p>See current stock levels, track movement, and avoid losses caused by missing records or late buying decisions.</p>
                            </div>
                            <div class="bringer-detailed-list-button">
                                <span class="bringer-icon bringer-icon-explore"></span>
                            </div>
                            <a href="{{ route('service.route') }}"></a>
                        </li>
                        <li>
                            <div class="bringer-detailed-list-title">
                                <h4>Run sales and invoicing smoothly</h4>
                            </div>
                            <div class="bringer-detailed-list-description">
                                <p>Create invoices, follow payments, and keep every sale connected to the stock and business records behind it.</p>
                            </div>
                            <div class="bringer-detailed-list-button">
                                <span class="bringer-icon bringer-icon-explore"></span>
                            </div>
                            <a href="{{ route('service.route') }}"></a>
                        </li>
                        <li>
                            <div class="bringer-detailed-list-title">
                                <h4>Manage debt and cash flow clearly</h4>
                            </div>
                            <div class="bringer-detailed-list-description">
                                <p>Track customer balances, understand what is owed, and make better financial decisions with less guesswork.</p>
                            </div>
                            <div class="bringer-detailed-list-button">
                                <span class="bringer-icon bringer-icon-explore"></span>
                            </div>
                            <a href="{{ route('service.route') }}"></a>
                        </li>
                        <li>
                            <div class="bringer-detailed-list-title">
                                <h4>Get smarter business direction</h4>
                            </div>
                            <div class="bringer-detailed-list-description">
                                <p>Use reports and smart suggestions to know what to buy, what sells best, and where to improve your flow.</p>
                            </div>
                            <div class="bringer-detailed-list-button">
                                <span class="bringer-icon bringer-icon-explore"></span>
                            </div>
                            <a href="{{ route('service.route') }}"></a>
                        </li>
                    </ul>
                </div>
                <div class="align-center stg-top-gap" data-appear="fade-up" data-unload="zoom-out" data-delay="100">
                    <a href="{{ route('service.route') }}" class="bringer-button">Explore All Services</a>
                </div>
            </section>

            <!-- Section: CTA -->
            <section data-padding="bottom">
                <div class="bringer-masked-cta bringer-masked-block" data-unload="fade-down">
                    <form action="mail-short.php" method="post" data-fill-error="Please, fill out the form." class="bringer-contact-form is-short bringer-masked-media" data-appear="fade-up">
                        <div class="bringer-form-content bringer-cta-form">
                            <div class="bringer-cta-form-content" data-appear="fade-up" data-delay="100">
                                <div class="bringer-cta-title">Ready to take control with StoqFlow?</div>
                                <input type="email" id="subscribe_email" name="subscribe_email" placeholder="your@email.com" required>
                            </div>
                            <div class="bringer-cta-form-button" data-appear="fade-up" data-delay="200">
                                <button type="submit">
                                    <span class="bringer-icon bringer-icon-arrow-submit"></span>
                                </button>
                            </div>
                            <div class="bringer-contact-form__response"></div>
                        </div>
                        <span class="bringer-form-spinner"></span>
                    </form>
                    <div class="bringer-masked-cta-content bringer-masked-content at-top-right">
                        <p class="bringer-large-text" data-appear="fade-down">Control your stock. Master your flow. Powered by RomanSofts.</p>
                    </div>
                </div>
            </section>
        </div><!-- .stg-container -->

@endsection
