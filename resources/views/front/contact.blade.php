@extends('front.themefront')

@section('title')
Contact Us | StoqFlow
@endsection

@section('me')
    @parent
@endsection

@section('content')
        <div class="stg-container">
            <!-- Section: Page Title -->
            <section class="backlight-bottom">
                <div class="stg-row stg-bottom-gap-l">
                    <div class="stg-col-6 stg-offset-3 align-center">
                        <h1 class="bringer-page-title" data-appear="fade-up" data-unload="fade-up">Take control of your business today</h1>
                        <p class="bringer-large-text" data-appear="fade-up" data-delay="100" data-unload="fade-up">If stock confusion is costing you time or money, StoqFlow is ready to help you bring clarity back to your business flow.</p>
                    </div>
                </div>
                <div class="bringer-parallax-media" data-parallax-speed="20" data-appear="fade-up" data-delay="200" data-unload="fade-up">
                    <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/ref.jpg') }}" alt="Get in Touch" width="1920" height="960">
                </div><!-- .bringer-parallax-media -->
            </section>

            <!-- Section: About Us -->
            <section>
                <!-- Section Title -->
                <div class="stg-row stg-bottom-gap">
                    <div class="stg-col-8">
                        <h2 data-split-appear="fade-up" data-unload="fade-up">Ready to stop losing time and stock?</h2>
                    </div>
                    <div class="stg-col-4"></div>
                </div>
                <!-- Section Content -->
                <div class="stg-row stg-bottom-gap-l">
                    <div class="stg-col-6 stg-offset-6" data-appear="fade-up" data-delay="200" data-unload="fade-up">
                        <p>Every day without clear stock control can mean missed sales, avoidable losses, and harder decisions. Talk to us about how StoqFlow can simplify the way you manage inventory, sales, and business records.</p>
                    </div>
                </div>
                <!-- Grid Galery -->
                <div class="bringer-grid-3cols bringer-parallax-media bringer-m-grid-3cols stg-m-small-gap" data-stagger-appear="fade-up" data-delay="200" data-stagger-unload="fade-up">
                    <a href="{{ asset('frontend/assets/img/inner-pages/spp.jpg') }}" class="bringer-lightbox-link" data-size="960x960">
                        <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/spp.jpg') }}" alt="Bringer" width="960" height="960">
                    </a>
                    <a href="{{ asset('frontend/assets/img/inner-pages/qnn.jpg') }}" class="bringer-lightbox-link" data-size="960x960">
                        <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/qnn.jpg') }}" alt="Bringer" width="960" height="960">
                    </a>
                    <a href="{{ asset('frontend/assets/img/inner-pages/rt.jpg') }}" class="bringer-lightbox-link" data-size="960x960">
                        <img class="bringer-lazy" src="{{ asset('frontend/assets/img/null.png') }}" data-src="{{ asset('frontend/assets/img/inner-pages/rt.jpg') }}" alt="Bringer" width="960" height="960">
                    </a>
                </div>
            </section>

            <!-- Section: Let's Talk -->
            <section class="backlight-top divider-bottom">
                <!-- Section Title -->
                <div class="stg-row bringer-section-title">
                    <div class="stg-col-8 stg-offset-2">
                        <div class="align-center">
                            <h2 data-appear="fade-up" data-unload="fade-up">Let's talk</h2>
                            <p class="bringer-large-text" data-appear="fade-up" data-delay="100" data-unload="fade-up">Here is how you can connect with the StoqFlow team.</p>
                        </div>
                    </div>
                </div>
                <!-- Contacts Grid -->
                <div class="stg-row" data-stagger-appear="fade-up" data-delay="200" data-stagger-unload="fade-up">
                    <div class="stg-col-4 stg-tp-col-6 stg-tp-bottom-gap">
                        <!-- Phone -->
                        <div class="bringer-block stg-aspect-square stg-vertical-space-between">
                            <a href="tel:+255 738-020-528" class="bringer-grid-item-link"></a>
                            <div>
                                <h5>Call us directly<span class="bringer-accent">.</span></h5>
                                <h6>+255 71514 4962</h6>
                            </div>
                            <p>Speak with us about your stock, sales, or setup needs and get direct guidance on the best next step.</p>
                        </div>
                    </div>
                    <div class="stg-col-4 stg-tp-col-6 stg-tp-bottom-gap">
                        <!-- Email -->
                        <div class="bringer-block stg-aspect-square stg-vertical-space-between">
                            <a href="mailto:stoqflow@romansofts.co.tz" class="bringer-grid-item-link"></a>
                            <div>
                                <h5>Send us an email<span class="bringer-accent">.</span></h5>
                                <h6>stoqflow@romansofts.co.tz</h6>
                            </div>
                            <p>Tell us what you need help with and we will show you how StoqFlow can keep your business in control.</p>
                        </div>
                    </div>
                    <div class="stg-col-4 stg-tp-col-12">
                        <!-- Social Media -->
                        <div class="bringer-block stg-aspect-square stg-tp-aspect-rectangle stg-vertical-space-between">
                            <div>
                                <h5>Follow our updates<span class="bringer-accent">.</span></h5>
                                <ul class="bringer-socials-list stg-small-gap" data-stagger-appear="fade-up" data-stagger-delay="75">
                                    <li>
                                        <a href="#" target="_blank" class="bringer-socials-facebook">
                                            <i></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/romansofts/" target="_blank" class="bringer-socials-instagram">
                                            <i></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="bringer-socials-x">
                                            <i></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" class="bringer-socials-tiktok">
                                            <i></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <p>Stay connected for product updates, practical tips, and business insights from the team behind StoqFlow.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Map -->
            <section>
                <!-- Section Title -->
                <div class="stg-row bringer-section-title">
                    <div class="stg-col-8 stg-offset-2">
                        <div class="align-center">
                            <h2 data-appear="fade-up" data-unload="fade-up">Visit our office</h2>
                            <p class="bringer-large-text" data-appear="fade-up" data-delay="100" data-unload="fade-up">Meet the team behind StoqFlow and talk through the best way to bring more control and clarity to your business.</p>
                        </div>
                    </div>
                </div>
                <!-- Contacts Grid -->
                <div class="stg-row">
                    <div class="stg-col-4 stg-tp-col-6 stg-m-bottom-gap" data-appear="fade-right" data-delay="100" data-unload="fade-left">
                        <!-- Phone -->
                        <div class="bringer-block stg-aspect-square stg-vertical-space-between">
                            <a href="https://maps.app.goo.gl/WbTG6EKuF9dE1Xuy8" class="bringer-grid-item-link"></a>
                            <div>
                                <h5>Office location<span class="bringer-accent">.</span></h5>
                                <h6>KARIAKOO, Gogo and Narun`gombe,<br>Bona redeast</h6>
                            </div>
                            <p>Visit us and see how StoqFlow can fit into the way your business works today.</p>
                        </div>
                    </div>
                    <div class="stg-col-8 stg-tp-col-6" data-appear="fade-left" data-delay="200" data-unload="fade-right">
                        <iframe class="bringer-google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.58424554139!2d39.2714055726446!3d-6.820312778098908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4ba8f10a9c4f%3A0xa4516a5c6b7d8bb7!2sGogo%20Street%20%26%20Narung&#39;ombeStreet%2C%20Dar%20es%20Salaam!5e0!3m2!1sen!2stz!4v1719122406006!5m2!1sen!2stz" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </section>

            <!-- Section: CTA Form -->
            <section class="backlight-top is-fullwidth">
                <div class="stg-row stg-valign-middle stg-cta-with-image stg-tp-column-reverse">
                    <div class="stg-col-5" data-unload="fade-left">
                        <div class="bringer-offset-image" data-bg-src="{{ asset('frontend/assets/img/curr.jpg') }}" data-appear="fade-up" data-threshold="0.25"></div>
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
                            Control Your Stock. Master Your Flow.
                            </div>
                            <div class="bringer-cta-text">
                                <div class="stg-row stg-valign-middle">
                                    <div class="stg-col-8 stg-tp-col-7 stg-m-col-8 stg-m-offset-1" data-appear="fade-left">
                                        <p class="bringer-large-text">Every day without clear stock control creates risk. Start with StoqFlow and run your business with more confidence. Powered by RomanSofts.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div><!-- .stg-container -->
@endsection
