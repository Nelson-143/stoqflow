@extends('front.themefront')

@section('title')
About Us | StoqFlow
@endsection

@section('me')
    @parent
@endsection

@section('content')

<div class="stg-container">
            <!-- Section: Page Title -->
            <section class="backlight-bottom">
                <div class="stg-row stg-bottom-gap-l">
                    <div class="stg-col-8 stg-tp-bottom-gap" data-appear="fade-right" data-unload="fade-left">
                        <h2>StoqFlow for businesses that want control</h2>
                    </div>
                    <div class="stg-col-4 stg-tp-col-8 stg-tp-offset-4 tp-align-right stg-m-col-9 stg-m-offset-3" data-appear="fade-left" data-unload="fade-right">
                        <p>Discover how StoqFlow helps you <span class="bringer-highlight">control your stock and master your flow</span> with one clear system. Powered by RomanSofts.</p>
                    </div>
                </div>

                <!-- Slider -->
                <div class="bringer-slider-wrapper bringer-masked-block stg-bottom-gap" data-appear="fade-up" data-delay="100" data-unload="fade-up">
                    <div class="swiper bringer-slider bringer-masked-media" data-autoplay="2000" data-duration="800" data-effect="slide">
                        <div class="swiper-wrapper">
                            <!-- Slider Item -->
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/img/inner-pages/view4.jpg') }}" alt="Positive Beverage" width="1920" height="1080">
                            </div>
                            <!-- Slider Item -->
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/img/inner-pages/view5.jpeg') }}" alt="Positive Beverage" width="1920" height="1080">
                            </div>
                            <!-- Slider Item -->
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/img/inner-pages/view6.jpeg') }}" alt="Positive Beverage" width="1920" height="1080">
                            </div>
                             <!-- Slider Item -->
                             <div class="swiper-slide">
                                <img src="{{ asset('frontend/assets/img/inner-pages/view8.jpg') }}" alt="Positive Beverage" width="1920" height="1080">
                            </div>
                        </div>
                    </div><!-- .bringer-slider -->
                    <!-- Masked Navigation -->
                    <div class="bringer-slider-nav bringer-masked-content at-bottom-right">
                        <a href="#" class="bringer-slider-prev">
                            <span class="bringer-icon bringer-icon-chevron-left"></span>
                        </a>
                        <a href="#" class="bringer-slider-next">
                            <span class="bringer-icon bringer-icon-chevron-right"></span>
                        </a>
                    </div>
                </div>

                <!-- Meta -->
                <div class="bringer-hero-info-line" data-stagger-appear="fade-up" data-delay="200" data-unload="fade-up">
                    <div class="bringer-meta">
                         <span>Built for everyday business control</span>
                    </div>
                    <div class="bringer-meta">
                         <span>From small shops to growing teams</span>
                    </div>
                    <div class="bringer-meta">
                         <span>Clear, trusted, simple to use</span>
                    </div>
                </div>
            </section>

            <!-- Section: The Challenge -->
            <section>
                <div class="stg-row">
                    <div class="stg-col-6 stg-tp-bottom-gap-l" data-unload="fade-left">
                        <div class="bringer-sticky-block">
                            <h2 data-appear="fade-right">About StoqFlow</h2>
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-10 stg-tp-offset-2 stg-m-col-11 stg-m-offset-1" data-unload="fade-right">
                        <div class="stg-bottom-gap-section stg-tp-bottom-gap-l" data-appear="fade-up">
                            <h4>The business challenge</h4>
                            <p>Many businesses lose money because they do not have a clear view of stock, sales, and buying decisions. Manual follow-up creates delays, mistakes, and uncertainty.</p>
                            <p>When you do not know what is available or what needs restocking, you risk stockouts, overbuying, and avoidable losses.</p>
                        </div>
                        <div data-appear="fade-up">
                            <h4>The StoqFlow solution</h4>
                            <p class="bringer-large-text">StoqFlow gives you one place to manage inventory, sales, customer balances, and smarter buying decisions without making the work complicated.</p>
                            <p>It combines clear tracking, simple reporting, and smart suggestions so you can stay in control and keep your business moving.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section: Gallery -->
            <section data-tp-padding="none">
                <div class="bringer-grid-3cols" data-stagger-appear="fade-up" data-stagger-unload="fade-left">
                    <div>
                        <img class="bringer-lazy" src="img/null.png" data-src="{{ asset('frontend/assets/img/inner-pages/pos09.jpg') }}" alt="Positive Beverage" data-speed="0.9" data-m-speed="1" width="800" height="1200">
                    </div>
                    <div>
                        <img class="bringer-lazy" src="img/null.png" data-src="{{ asset('frontend/assets/img/inner-pages/pos02.jpg') }}" alt="Positive Beverage" width="800" height="1200">
                    </div>
                    <div>
                        <img class="bringer-lazy" src="img/null.png" data-src="{{ asset('frontend/assets/img/inner-pages/pos08.jpg') }}" alt="Positive Beverage" data-speed="1.1" data-m-speed="1" width="800" height="1200">
                    </div>
                </div>
            </section>

            <!-- Section: Solution -->
            <section>
                <div class="stg-row">
                    <div class="stg-col-6 stg-tp-bottom-gap-l" data-appear="fade-right" data-unload="fade-left">
                        <h2>What StoqFlow helps you do</h2>
                    </div>
                    <div class="stg-col-6 stg-tp-col-10 stg-tp-offset-2 stg-m-col-11 stg-m-offset-1" data-appear="fade-left" data-unload="fade-right">
                        <p class="bringer-large-text">Take control of stock, avoid losses, and run your business with confidence.</p>
                        <ul class="bringer-marked-list">
                            <li><span class="bringer-highlight">Clear stock visibility:</span> Know what you have, what is moving, and what needs attention before it becomes a problem.</li>
                            <li><span class="bringer-highlight">Smarter buying decisions:</span> Get smart suggestions on what to buy next so you can avoid shortages and overstock.</li>
                            <li><span class="bringer-highlight">Confident business control:</span> Follow sales, debt, and performance from one dashboard built to keep decisions simple.</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section data-padding="none" data-unload="zoom-out">
                <div class="bringer-expand-on-scroll">
                    <img class="bringer-lazy" src="img/null.png" data-src="{{ asset('frontend/assets/img/inner-pages/view2.png') }}" alt="Positive Beverage" width="1920" height="960">
                </div><!-- .bringer-expand-on-scroll -->
            </section>

            <!-- Section: Results & Impact -->
            <section>
                <div class="stg-row">
                    <div class="stg-col-6 stg-tp-bottom-gap" data-appear="fade-up" data-unload="fade-left">
                        <div class="bringer-sticky-block">
                        <h2>Results &amp; Impact</h2>
                        </div>
                    </div>
                    <div class="stg-col-6 stg-tp-col-10 stg-tp-offset-2 stg-m-col-11 stg-m-offset-1" data-appear="fade-up" data-delay="100" data-unload="fade-right">
                        <p class="bringer-large-text">Businesses use StoqFlow to reduce confusion, improve stock control, and make faster decisions every day.</p>
                        <ul class="bringer-marked-list">
                            <li><span class="bringer-highlight">Fewer stock surprises:</span> Stay ahead of shortages and overbuying with better visibility and planning.</li>
                            <li><span class="bringer-highlight">Less money lost:</span> Catch waste, missing items, and slow-moving stock earlier.</li>
                            <li><span class="bringer-highlight">More time back:</span> Spend less time chasing records and more time running the business.</li>
                            <li><span class="bringer-highlight">Better decisions:</span> Use clear numbers and smart suggestions to move with confidence.</li>
                        </ul>
                        <p>StoqFlow is built to help you stay clear, stay organized, and stay in control as your business grows.</p>
                    </div>
                </div>
            </section>

            <!-- Section: Next Post -->
            <section class="divider-top" data-appear="fade-up">
                <div class="align-center" data-unload="zoom-in">
                    <a href="{{ route('contact.route') }}" class="bringer-icon-link bringer-next-post">
                        <div class="bringer-icon-link-content">
                            <h6>START WITH STOQFLOW</h6>
                            <h2>Control Your Stock<br>Master Your Flow</h2>
                        </div>
                        <div class="bringer-icon-wrap">
                            <i class="bringer-icon bringer-icon-explore"></i>
                        </div>
                    </a><!-- .bringer-icon-link -->
                </div>
            </section>
        </div><!-- .stg-container -->
@endsection

