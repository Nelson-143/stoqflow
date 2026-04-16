@extends('front.themefront')

@section('title')
Our Services | StoqFlow
@endsection
 
@section('me')
    @parent
@endsection

@section('content')
        <div class="stg-container">
            <!-- Section: Intro -->
            <section>
                <div class="stg-row stg-large-gap stg-tp-normal-gap stg-tp-column-reverse">
                    <div class="stg-col-6 stg-vertical-space-between" data-unload="fade-left">
                        <div class="stg-tp-bottom-gap">
                            <h1 class="bringer-page-title" data-split-appear="fade-up">Control Your Stock. Master Your Flow.</h1>
                            <p class="bringer-large-text bringer-tp-normal-text" data-appear="fade-right" data-delay="200">StoqFlow helps you run your business smoothly, from inventory to sales, all in one place. Clear enough for daily use, strong enough to keep your business in control.</p>
                        </div>
                        <div class="align-right" data-appear="fade-right">
                            <a href="{{ route('price.route') }}" class="bringer-icon-link">
                                <div class="bringer-icon-link-content">
                                    <h6>
                                        Control your
                                        <br>
                                        business flow
                                    </h6>
                                    <span class="bringer-label">View pricing</span>
                                </div>
                                <div class="bringer-icon-wrap">
                                    <i class="bringer-icon bringer-icon-explore"></i>
                                </div>
                            </a><!-- .bringer-icon-link -->
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-bottom-gap-l" data-appear="fade-left" data-unload="fade-right">
                        <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/bgg.jpg') }}" alt="Brainding" width="800" height="1200">
                    </div>
                </div>
            </section>

            <!-- Section: Details -->
            <section class="backlight-both">
                <!-- Section Title -->
                <div class="stg-row stg-bottom-gap-l">
                    <div class="stg-col-7">
                        <h2 data-split-appear="fade-up" data-unload="fade-up">What StoqFlow helps you control</h2>
                    </div>
                    <div class="stg-col-5"></div>
                </div>
                <!-- Details 01 Row -->
                <div class="stg-row stg-bottom-gap stg-valign-middle stg-m-bottom-gap-l" data-unload="fade-left">
                    <div class="stg-col-3 stg-offset-3 stg-tp-col-6 stg-m-bottom-gap" data-appear="fade-right">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/inv.jpg') }}" alt="Branding 01" width="960" height="960">
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-6" data-appear="fade-right" data-delay="100">
                        <span class="bringer-label">Stock Control</span>
                        <h4>Know what you have and what to buy</h4>
                        <p>Keep stock clear and organized with:
                            ✓ real-time inventory tracking
                            ✓ smart alerts for low stock
                            ✓ smart buying suggestions
                            ✓ multi-location visibility
                            ✓ faster product handling</p>
                    </div>
                </div>
                <!-- Details 02 Row -->
                <div class="stg-row stg-bottom-gap stg-valign-middle stg-tp-row-reverse stg-m-bottom-gap-l" data-unload="fade-right">
                    <div class="stg-col-3 stg-tp-col-6 stg-m-bottom-gap" data-appear="fade-left">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/mee.jpg') }}" alt="Branding 02" width="960" height="960">
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-6" data-appear="fade-left" data-delay="100">
                        <span class="bringer-label">Sales Flow</span>
                        <h4>Run sales and invoicing without confusion</h4>
                        <p>Keep sales moving with:
                            ✓ fast invoicing
                            ✓ payment tracking
                            ✓ clear sales reports
                            ✓ customer purchase history
                            ✓ easier follow-up on payments</p>
                    </div>
                    <div class="stg-col-3"><!-- Empty Column --></div>
                </div>
                <!-- Details 03 Row -->
                <div class="stg-row stg-bottom-gap stg-valign-middle stg-m-bottom-gap-l" data-unload="fade-left">
                    <div class="stg-col-3 stg-offset-3 stg-tp-col-6 stg-m-bottom-gap" data-appear="fade-right">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/dep.jpg') }}" alt="Branding 03" width="960" height="960">
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-6" data-appear="fade-right" data-delay="100">
                        <span class="bringer-label">Financial Clarity</span>
                        <h4>Stay on top of money coming in and out</h4>
                        <p>Make better decisions with:
                            ✓ clear reporting
                            ✓ customer debt management
                            ✓ cash flow visibility
                            ✓ expense tracking
                            ✓ insights that reduce losses</p>
                    </div>
                </div>
                <!-- Details 04 Row -->
                <div class="stg-row stg-bottom-gap stg-valign-middle stg-tp-row-reverse stg-m-bottom-gap-l" data-unload="fade-right">
                    <div class="stg-col-3 stg-tp-col-6 stg-m-bottom-gap" data-appear="fade-left">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/hall.jpg') }}" alt="Branding 04" width="960" height="960">
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-6" data-appear="fade-left" data-delay="100">
                        <span class="bringer-label">Customer Records</span>
                        <h4>Keep every customer interaction organized</h4>
                        <p>Manage customer activity with:
                            ✓ complete customer profiles
                            ✓ purchase history
                            ✓ clearer balance follow-up
                            ✓ better credit control
                            ✓ easier day-to-day service</p>
                    </div>
                    <div class="stg-col-3"><!-- Empty Column --></div>
                </div>
                <!-- Details 05 Row -->
                <div class="stg-row stg-valign-middle" data-unload="fade-left">
                    <div class="stg-col-3 stg-offset-3 stg-tp-col-6 stg-m-bottom-gap" data-appear="fade-right">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/web.jpg') }}" alt="Branding 05" width="960" height="960">
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-6" data-appear="fade-right" data-delay="100">
                        <span class="bringer-label">Business Growth</span>
                        <h4>Expand with tools that keep your flow connected</h4>
                        <p>Grow with connected tools such as:
                            ✓ integrated online selling support
                            ✓ inventory sync
                            ✓ mobile-friendly access
                            ✓ better product visibility
                            ✓ smoother operations as you scale</p>
                    </div>
                </div>
            </section>

            <!-- Section: Offer -->
            <section>
                <!-- Services Grid -->
                <div class="bringer-grid-3cols bringer-tp-grid-2cols bringer-tp-stretch-last-item" data-stagger-appear="fade-up" data-stagger-unload="fade-up">
                    <!-- Item 01 -->
                    <div class="bringer-block stg-aspect-square stg-vertical-space-between">
                        <h5>Reliable support<span class="bringer-accent">.</span></h5>
                        <p>Get help when you need it so your business keeps moving without delays.</p>
                    </div>
                    <!-- Item 02 -->
                    <div class="bringer-block stg-aspect-square stg-vertical-space-between">
                        <h5>Continuous improvement<span class="bringer-accent">.</span></h5>
                        <p>Use a system that keeps getting better as your business needs change.</p>
                    </div>
                    <!-- Item 03 -->
                    <div class="bringer-masked-block bringer-grid-more-masked">
                        <div class="bringer-block stg-aspect-square stg-vertical-space-between is-accented bringer-masked-media">
                            <h5>Ready to take control?<span class="bringer-accent">.</span></h5>
                            <p class="bringer-large-text">Choose StoqFlow to simplify stock, sales, and business decisions in one trusted system.</p>
                        </div>
                        <div class="bringer-masked-content at-bottom-right">
                            <span class="bringer-square-button is-secondary">
                                <span class="bringer-icon bringer-icon-explore"></span>
                            </span>
                        </div>
                        <a href="{{ route('contact.route') }}"></a>
                    </div>
                </div>
            </section>

        </div><!-- .stg-container -->
@endsection
        
