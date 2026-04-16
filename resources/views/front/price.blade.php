@extends('front.themefront')

@section('title')
Pricing | StoqFlow
@endsection

@section('me')
    @parent
@endsection

@section('content')
        <div class="stg-container">
            <!-- Section: Page Title -->
            <section class="backlight-bottom">
                <div class="stg-row">
                    <div class="stg-col-6 stg-offset-3 align-center stg-tp-col-10 stg-tp-offset-1">
                        <h1 class="bringer-page-title" data-appear="fade-up" data-unload="fade-up">Pricing built for better business flow</h1>
                        <p class="bringer-large-text" data-appear="fade-up" data-delay="100" data-unload="fade-up">Choose the StoqFlow plan that fits your business and get the clarity you need to control stock, manage sales, and avoid losses.</p>
                    </div>
                </div>
            </section>

            <!-- Section: Intro -->
            <section>
                <div class="stg-row stg-large-gap stg-m-normal-gap">
                    <div class="stg-col-6 stg-tp-bottom-gap-l stg-m-bottom-gap" data-appear="fade-right" data-unload="fade-left">
                        <div class="bringer-parallax-media">
                            <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/sal.jpg') }}" alt="Ignite Your Potential" width="1200" height="1200">
                        </div>
                    </div>
                    <div class="stg-col-6 stg-vertical-space-between" data-appear="fade-left" data-unload="fade-right">
                        <div>
                            <h2>Control your stock without the guesswork</h2>
                            <p class="bringer-large-text">StoqFlow helps you know what you have, know what to buy, and avoid losses with one clear system.</p>
                            <p>Whether you are starting small or managing a growing operation, each plan is built to keep your business flow simple, reliable, and easy to trust.</p>
                        </div>
                        <div class="tp-align-right">
                            <a href="{{ route('contact.route') }}" class="bringer-icon-link">
                                <div class="bringer-icon-wrap">
                                    <i class="bringer-icon bringer-icon-explore"></i>
                                </div>
                                <div class="bringer-icon-link-content">
                                    <h6>
                                        Start the
                                        <br>
                                        flow
                                    </h6>
                                    <span class="bringer-label">Talk to us</span>
                                </div>
                            </a><!-- .bringer-icon-link -->
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section: How We Make -->
            <section class="divider-top">
                <!-- Section Title -->
                <div class="stg-row stg-bottom-gap-l">
                    <div class="stg-col-6 stg-offset-3 align-center">
                        <h2 data-split-appear="fade-up" data-unload="fade-up">Why businesses choose StoqFlow</h2>
                    </div>
                </div>
                <!-- Services Grid -->
                <div class="bringer-grid-3cols bringer-tp-grid-2cols bringer-tp-stretch-last-item" data-stagger-appear="fade-up" data-delay="100" data-stagger-unload="fade-up">
                    <!-- Item 01 -->
                    <div class="bringer-block stg-aspect-square stg-vertical-space-between">
                        <h5>Clear value<span class="bringer-accent">.</span></h5>
                        <p class="bringer-large-text bringer-tp-normal-text">Pay for the level of control your business needs without adding unnecessary complexity.</p>
                    </div>
                    <!-- Item 02 -->
                    <div class="bringer-block stg-aspect-square stg-vertical-space-between">
                        <h5>Practical features<span class="bringer-accent"></span></h5>
                        <p class="bringer-large-text bringer-tp-normal-text">Get the tools that help you stay in control of stock, sales, and business flow every day.</p>
                    </div>
                    <!-- Item 03 -->
                    <div class="bringer-block stg-aspect-square stg-vertical-space-between">
                        <h5>Trusted support<span class="bringer-accent">.</span></h5>
                        <p class="bringer-large-text">Get responsive support from a team focused on helping your business run smoothly.</p>
                    </div>
                </div>
            </section>

            <!-- Section: Prices -->
            <section class="divider-both tp-is-fullwidth tp-is-stretched">
                <!-- Section Title -->
                <div class="stg-row stg-bottom-gap" data-unload="fade-up">
                    <div class="stg-col-8 stg-offset-2 stg-tp-col-6 stg-tp-offset-3">
                        <div class="align-center">
                            <h2 data-split-appear="fade-up">Ready to simplify your business?</h2>
                        </div>
                    </div>
                </div>
                <div class="stg-row stg-bottom-gap-l" data-unload="fade-up" data-delay="100">
                    <div class="stg-col-6 stg-offset-3 stg-tp-col-6 stg-tp-offset-3">
                        <div class="align-center">
                            <p class="bringer-large-text" data-appear="fade-up" data-delay="100">
                                Compare plans and choose the setup that fits the way your business works.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Price Table Carousel -->
                <div class="swiper bringer-carousel" data-appear="fade-up" data-delay="200" data-tp-count="2" data-unload="fade-up">
                    <div class="swiper-wrapper">
                        <!-- Carousel Item 01 -->
                       <!-- .bringer-carousel-card -->


                        <div class="bringer-block bringer-price-table swiper-slide">
                            <h6>Flow Scale<span class="bringer-accent">.</span></h6>
                            <p>For businesses ready to scale operations</p>
                            <div class="bringer-price-wrapper">
                                <div class="bringer-label">Built to scale with you</div>
                                <h2>Tsh.25,000/=</h2>
                            </div>
                            <div class="bringer-label bringer-highlight">Most popular</div>
                            <ul class="bringer-marked-list">
                                <li>Expanded business management tools</li>
                                <li>Advanced operational features</li>
                                <li>Stronger security controls</li>
                                <li>AI support</li>
                                <li>Multi-user access </li>
                                <li>Priority assistance</li>
                            </ul>
                            <a href="{{ route('register') }}" class="bringer-button is-fullwidth">Choose Flow Scale</a>
                        </div>

                        <!-- Carousel Item 02 -->
                        <div class="bringer-block bringer-price-table swiper-slide">
                            <h6>Flow Core<span class="bringer-accent">.</span></h6>
                            <p>For businesses that need stronger control</p>
                            <div class="bringer-price-wrapper">
                                <div class="bringer-label">Advanced business flow</div>
                                <h2>Tsh.35,000/=</h2>
                            </div>
                            <div class="bringer-label bringer-highlight">Advanced Plan</div>
                            <ul class="bringer-marked-list">
                                <li>Advanced stock management</li>
                                <li>Full sales and invoice tracking</li>
                                <li>Customer balance management</li>
                                <li>Stronger analytics and reports</li>
                                <li>Multi-user access </li>
                                <li>Priority support</li>
                            </ul>
                            <a href="{{ route('register') }}" class="bringer-button is-fullwidth">Choose Flow Core</a>
                        </div><!-- .bringer-carousel-card -->

                         <div class="bringer-block bringer-price-table swiper-slide">
                            <h6>Flow Start<span class="bringer-accent">.</span></h6>
                            <p>For simple, everyday stock control</p>
                            <div class="bringer-price-wrapper">
                                <div class="bringer-label">A clear place to begin</div>
                                <h2>Tsh.15,000/=</h2>
                            </div>
                            <div class="bringer-label bringer-highlight">Good for getting started</div>
                            <ul class="bringer-marked-list">
                                <li>Core stock control tools</li>
                                <li>Basic sales and invoicing</li>
                                <li>Basic support and maintenance</li>
                                <li>Simple business reporting</li>
                                <li>Essential system access</li>
                                <li>Single user account</li>
                            </ul>
                            <a href="{{ route('register') }}" class="bringer-button is-fullwidth">Start with Flow Start</a>
                        </div>
                        <!-- Carousel Item 03 -->
                        <!-- .bringer-carousel-card -->

                        <!-- Carousel Item 04 -->


                        <!-- Carousel Item 05 -->
                        <!-- <div class="bringer-block bringer-price-table swiper-slide">
                            <h6>Free Flow<span class="bringer-accent">.</span></h6>
                            <p>Try the essentials at no cost</p>
                            <div class="bringer-price-wrapper">
                                <div class="bringer-label">per month</div>
                                <h2>FREE</h2>
                            </div>
                            <div class="bringer-label bringer-highlight">Included in the free plan</div>
                            <ul class="bringer-marked-list">
                                <li>Basic inventory management</li>
                                <li>Sales and invoice management</li>
                                <li>Basic analytics and reporting</li>
                                <li>Basic support and maintenance</li>
                                <li>Basic customer debt tracking</li>
                                <li>1 account</li>
                            </ul>
                            <a href="{{ route('register') }}" class="bringer-button is-fullwidth">Start Free</a>
                        </div>.bringer-carousel-card -->
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination bringer-dots"></div>
                </div><!-- .bringer-carousel -->
            </section>

            <!-- Section: FAQ -->
            <section>
                <!-- Section Title -->
                <div class="stg-row stg-bottom-gap-l">
                    <div class="stg-col-8 stg-offset-2">
                        <div class="align-center">
                            <h2 data-split-appear="fade-up" data-unload="fade-up">Common questions about StoqFlow</h2>
                            <p class="bringer-large-text" data-appear="fade-up" data-delay="100" data-unload="fade-up">Clear answers before you choose your plan.</p>
                        </div>
                    </div>
                </div>
                <!-- FAQ List -->
                <div class="bringer-faq-list">
                    <!-- FAQ Item 01 -->
                    <div class="bringer-toggles-item bringer-block" data-appear="fade-up" data-unload="fade-up">
                        <div class="bringer-toggles-item--title">
                            <span class="bringer-label">General</span>
                            <h4>
                                <sup>01.</sup>
                                What exactly does StoqFlow do?
                            </h4>
                        </div>
                        <div class="bringer-toggles-item--content">
                            <p>StoqFlow helps you manage stock, sales, invoicing, customer balances, reporting, and day-to-day business flow in one place.</p>
                        </div>
                    </div>
                    <!-- FAQ Item 02 -->
                    <div class="bringer-toggles-item bringer-block" data-appear="fade-up" data-unload="fade-up">
                        <div class="bringer-toggles-item--title">
                            <span class="bringer-label">General</span>
                            <h4>
                                <sup>02.</sup>
                                I have a small business; is StoqFlow right for me?
                            </h4>
                        </div>
                        <div class="bringer-toggles-item--content">
                            <p>Yes. StoqFlow is designed to be simple enough for small businesses and strong enough to support growth as your operations become more complex.</p>
                        </div>
                    </div>
                    <!-- FAQ Item 03 -->
                    <div class="bringer-toggles-item bringer-block" data-appear="fade-up" data-unload="fade-up">
                        <div class="bringer-toggles-item--title">
                            <span class="bringer-label">General</span>
                            <h4>
                                <sup>03.</sup>
                                What kind of results can I expect from using StoqFlow?
                            </h4>
                        </div>
                        <div class="bringer-toggles-item--content">
                            <span class="bringer-highlight">What businesses gain:</span>
                            <ul class="bringer-marked-list">
                                <li>Better stock accuracy with fewer shortages and overstock issues</li>
                                <li>Faster daily operations across sales, invoicing, and follow-up</li>
                                <li>Clearer financial control and expense visibility</li>
                                <li>Smarter buying and planning decisions</li>
                                <li>A smoother business flow as you grow</li>
                            </ul>
                        </div>
                    </div>
                    <!-- FAQ Item 04 -->
                    <div class="bringer-toggles-item bringer-block" data-appear="fade-up" data-unload="fade-up">
                        <div class="bringer-toggles-item--title">
                            <span class="bringer-label">General</span>
                            <h4>
                                <sup>04.</sup>
                                How does StoqFlow help with budget management?
                            </h4>
                        </div>
                        <div class="bringer-toggles-item--content">
                            <p>StoqFlow helps you track expenses, monitor spending, and review reports that make it easier to understand where money is going and where you can improve.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section: CTA Form -->
            <section class="backlight-top is-fullwidth">
                <div class="stg-row stg-valign-middle stg-cta-with-image stg-tp-column-reverse">
                    <div class="stg-col-5" data-unload="fade-left">
                        <div class="bringer-offset-image" data-bg-src="{{ asset('frontend/assets/img/home/curr.jpg') }}" data-appear="fade-up" data-threshold="0.25"></div>
                        <form action="mail.php" method="post" class="bringer-contact-form bringer-block" data-fill-error="Please, fill out the contact form." data-appear="fade-right" data-threshold="0.25">
                            <div class="bringer-form-content">
                                <!-- Field: Name -->
                                <label for="name">Your Name</label>
                                <input type="text" id="name" name="name" placeholder="Your Name" required>
                                <!-- Field: Email -->
                                <label for="email">Your Email</label>
                                <input type="email" id="email" name="email" placeholder="email@example.com" required>
                                <!-- Field: Message -->
                                <label for="message">Your Message</label>
                                <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                                <!-- Form Button -->
                                <button type="submit" value="Send Message">Get a FREE Quote</button>
                                <div class="bringer-contact-form__response"></div>
                            </div>
                            <span class="bringer-form-spinner"></span>
                        </form>
                    </div>
                    <div class="stg-col-6 stg-offset-1" data-unload="fade-right">
                        <div class="bringer-cta-form-content">
                            <div class="bringer-cta-form-title" data-split-appear="fade-up" data-split-delay="100" data-split-by="line">
                            Ready to bring more control into your daily flow?
                            </div>
                            <div class="bringer-cta-text">
                                <div class="stg-row stg-valign-middle">
                                    <div class="stg-col-2 stg-offset-2 stg-tp-col-1 stg-tp-offset-3 stg-m-col-1 stg-m-offset-2" data-appear="fade-right">
                                        <i class="bringer-cta-icon"></i>
                                    </div>
                                    <div class="stg-col-8 stg-tp-col-7 stg-m-col-8 stg-m-offset-1" data-appear="fade-left">
                                        <p class="bringer-large-text">Start with StoqFlow and keep stock, sales, and decisions moving in one clear flow. Powered by RomanSofts.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div><!-- .stg-container -->
@endsection
