<?php
/*
 * Custom homepage hero section for Alba Privé & Upul Sanjeewa Gamage
 * Place customizations for the homepage hero here.
 */

add_action('wp_head', function() {
    if (is_front_page()) {
        echo '<style>
            .custom-home-hero {
                background: linear-gradient(135deg, #f8fafc 0%, #e0e7ef 50%, #c6a87d 100%);
                padding: 100px 0 80px 0;
                text-align: left;
                position: relative;
                overflow: hidden;
            }
            .custom-home-hero::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url("data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23c6a87d\' fill-opacity=\'0.03\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                opacity: 0.1;
            }
            .custom-home-hero .container {
                position: relative;
                z-index: 2;
            }
            .custom-home-hero h1 {
                font-size: 3.5rem;
                font-weight: 700;
                color: #1a202c;
                margin-bottom: 16px;
                line-height: 1.1;
                text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .custom-home-hero h1 span {
                font-size: 1.8rem !important;
                font-weight: 500 !important;
                color: #c6a87d !important;
                display: block;
                margin-top: 8px;
                font-style: italic;
            }
            .custom-home-hero p {
                font-size: 1.4rem;
                color: #374151;
                margin-bottom: 40px;
                max-width: 750px;
                line-height: 1.6;
                font-weight: 400;
            }
            .custom-home-hero .cta-btn {
                background: linear-gradient(135deg, #1a202c 0%, #374151 100%);
                color: #fff !important;
                padding: 18px 44px;
                border-radius: 12px;
                font-size: 1.2rem;
                text-decoration: none;
                font-weight: 600;
                box-shadow: 0 4px 16px rgba(26,32,44,0.3);
                transition: all 0.3s ease;
                margin-right: 20px;
                display: inline-block;
                position: relative;
                overflow: hidden;
            }
            .custom-home-hero .cta-btn::before {
                content: "";
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: left 0.5s;
            }
            .custom-home-hero .cta-btn:hover::before {
                left: 100%;
            }
            .custom-home-hero .cta-btn.secondary {
                background: linear-gradient(135deg, #c6a87d 0%, #a8906d 100%);
                color: #1a202c !important;
                box-shadow: 0 4px 16px rgba(198,168,125,0.3);
            }
            .custom-home-hero .cta-btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 24px rgba(26,32,44,0.4);
            }
            .custom-home-hero .cta-btn.secondary:hover {
                box-shadow: 0 8px 24px rgba(198,168,125,0.4);
            }
        </style>';
    }
});
    // Remove 'Built with GeneratePress' from footer credits
    add_filter('generate_footer_credits', function() {
        return '&copy; 2025 Upul Sanjeewa Gamage. All rights reserved. | Global AI E-commerce Architect & Alba Privé Sensory Rituals';
    });
    // Add favicon meta tags to the head
    add_action('wp_head', function() {
        $theme_dir = get_stylesheet_directory_uri();
        echo '<link rel="apple-touch-icon" sizes="180x180" href="' . $theme_dir . '/assets/apple-touch-icon.png">';
        echo '<link rel="icon" href="' . $theme_dir . '/assets/favicon.ico" sizes="any">';
        echo '<link rel="icon" href="' . $theme_dir . '/assets/favicon.svg" type="image/svg+xml">';
        echo '<link rel="icon" type="image/png" sizes="96x96" href="' . $theme_dir . '/assets/favicon-96x96.png">';
        echo '<link rel="manifest" href="' . $theme_dir . '/assets/site.webmanifest">';
        echo '<meta name="msapplication-TileColor" content="#1d2d3c">';
        echo '<meta name="theme-color" content="#ffffff">';
    });

    // Enqueue Google Fonts
    add_action('wp_enqueue_scripts', function() {
        wp_enqueue_style('generatepress-child-google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap', [], null);
    });

    // TEMP fix: Strip non-standard id="cta-top" from Button wrapper on the Waiting Room page
    add_filter('the_content', function($content) {
        if (!is_page()) return $content;
        if (!is_page('waiting-room') && !is_page('Waiting Room')) return $content;
        return preg_replace('/(<div\s[^>]*class=\"[^\"]*wp-block-button[^\"]*\"[^>]*?)\s+id=\"cta-top\"/i', '$1', $content);
    }, 20);
    // Enqueue Prestige-inspired global stylesheet
    add_action('wp_enqueue_scripts', function() {
        wp_enqueue_style('prestige-style', get_stylesheet_directory_uri() . '/prestige-style.css', [], '1.0');
    });

add_action('generate_after_header', function() {
    if (is_front_page()) {
        ?>
        <section class="custom-home-hero">
            <div class="container">
                <h1>Upul Sanjeewa Gamage<br><span style="font-size:2rem;font-weight:400;color:#374151;">Global AI E-commerce Architect & Visionary Technologist</span></h1>
                <p>Welcome to Alba Privé — a sensory ritual brand and global authority hub for AI-powered commerce, innovation, and personal transformation. Discover the future of e-commerce, experience the art of sensory living, and unlock new possibilities for your brand, business, and life.</p>
                <div class="cta-buttons">
                    <a href="/waiting-room" class="cta-btn primary">Join Alba Privé Waiting Room</a>
                    <a href="#contact" class="cta-btn secondary">Work With Upul</a>
                </div>
            </div>
        </section>
        <section class="about-snapshot" style="background:#fff;padding:64px 0 48px 0;text-align:left;border-bottom: 1px solid #e5e7eb;">
            <div class="container">
                <h2 style="font-size:2.2rem;font-weight:600;color:#1a202c;margin-bottom:20px;border-bottom: 3px solid #c6a87d;padding-bottom: 12px;">About Upul & Alba Privé</h2>
                <p style="font-size:1.2rem;color:#374151;max-width:750px;margin-bottom:24px;line-height:1.7;">Upul Sanjeewa Gamage is a visionary technologist and global AI e-commerce architect, blending Sri Lankan heritage with Melbourne artistry. Alba Privé is his latest creation—a sensory ritual brand designed to elevate daily living and inspire transformation. Explore the journey, values, and story behind Alba Privé and Upul's global impact.</p>
                <a href="/about" style="color:#c6a87d;font-weight:600;text-decoration:none;font-size:1.1rem;border-bottom: 2px solid #c6a87d;padding-bottom: 4px;transition: all 0.2s ease;">Read the full story →</a>
            </div>
        </section>
            <section class="sensory-ritual-teaser" style="background: linear-gradient(135deg, #f8fafc 0%, #f0f4f8 100%);padding:80px 0 64px 0;text-align:left;position: relative;">
                <div class="container" style="display:flex;flex-wrap:wrap;align-items:center;gap:60px;max-width: 1200px;">
                    <div style="flex:1;min-width:320px;">
                        <h2 style="font-size:2.4rem;font-weight:600;color:#1a202c;margin-bottom:20px;border-bottom: 3px solid #c6a87d;padding-bottom: 12px;">Experience the Sensory Ritual</h2>
                        <p style="font-size:1.2rem;color:#374151;max-width:650px;margin-bottom:28px;line-height:1.7;">Discover Alba Privé's curated Sensory Ritual Experience Box—a transformative journey through scent, sound, and mindful design. Elevate your daily rituals, unlock creativity, and reconnect with your senses. Limited pre-launch edition available.</p>
                        <a href="/alba-prive" style="color:#fff;background: linear-gradient(135deg, #c6a87d 0%, #a8906d 100%);padding:16px 36px;border-radius:12px;font-weight:600;text-decoration:none;font-size:1.15rem;display:inline-block;box-shadow: 0 4px 16px rgba(198,168,125,0.3);transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(198,168,125,0.4)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 16px rgba(198,168,125,0.3)'">Explore Alba Privé</a>
                    </div>
                    <div style="flex:1;min-width:320px;text-align:center;">
                        <div style="background: #fff;border-radius: 16px;padding: 32px;box-shadow: 0 8px 32px rgba(0,0,0,0.1);border: 1px solid #e5e7eb;">
                            <img src="/wp-content/themes/generatepress-child/assets/images/Logo SVG Files/For Light Backgrounds/ap_LightB_The Primary Logo with Tagline (The Full Signature Lockup).svg" alt="Alba Privé Primary Logo with Tagline" style="max-width:240px;width:100%;margin-bottom:20px;" />
                            <div style="font-size:1.1rem;color:#6b7280;font-weight:500;margin-bottom: 12px;">Sri Lankan Heritage. Melbourne Artistry.</div>
                            <div style="font-size:0.95rem;color:#9ca3af;font-style:italic;">✨ Sensory Ritual Experience Box<br><em>Pre-launch edition • Limited availability</em></div>
                        </div>
                    </div>
                </div>
            </section>
                <section class="freelance-cta" style="background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);padding:80px 0 64px 0;text-align:left;position: relative;">
                    <div class="container" style="max-width:1000px;margin:auto;color:#fff;">
                        <h2 style="font-size:2.4rem;font-weight:600;color:#fff;margin-bottom:20px;border-bottom: 3px solid #c6a87d;padding-bottom: 12px;">Work With Upul — Freelance & Contract Opportunities</h2>
                        <p style="font-size:1.2rem;color:#e2e8f0;max-width:750px;margin-bottom:32px;line-height:1.7;">Partner with a global expert in AI-powered e-commerce, digital transformation, and sensory brand innovation. Upul Sanjeewa Gamage offers freelance and contract services for select brands, agencies, and founders seeking breakthrough results in strategy, technology, and creative direction.</p>
                        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;margin-bottom:32px;">
                            <div style="background: rgba(255,255,255,0.05);padding:24px;border-radius:12px;border:1px solid rgba(198,168,125,0.2);">
                                <h3 style="font-size:1.1rem;color:#c6a87d;font-weight:600;margin-bottom:12px;">AI E-commerce Architecture</h3>
                                <p style="font-size:0.95rem;color:#cbd5e0;">Automation, personalization, and intelligent commerce solutions</p>
                            </div>
                            <div style="background: rgba(255,255,255,0.05);padding:24px;border-radius:12px;border:1px solid rgba(198,168,125,0.2);">
                                <h3 style="font-size:1.1rem;color:#c6a87d;font-weight:600;margin-bottom:12px;">Brand Strategy & Transformation</h3>
                                <p style="font-size:0.95rem;color:#cbd5e0;">Digital strategy, sensory brand development, and market positioning</p>
                            </div>
                            <div style="background: rgba(255,255,255,0.05);padding:24px;border-radius:12px;border:1px solid rgba(198,168,125,0.2);">
                                <h3 style="font-size:1.1rem;color:#c6a87d;font-weight:600;margin-bottom:12px;">Technical Implementation</h3>
                                <p style="font-size:0.95rem;color:#cbd5e0;">Shopify, WordPress, custom solutions, and platform integration</p>
                            </div>
                        </div>
                        <a href="/contact" style="color:#1a202c;background: linear-gradient(135deg, #c6a87d 0%, #a8906d 100%);padding:18px 44px;border-radius:12px;font-weight:600;text-decoration:none;font-size:1.2rem;display:inline-block;box-shadow: 0 4px 16px rgba(198,168,125,0.3);transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(198,168,125,0.4)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 16px rgba(198,168,125,0.3)'">Request a Consultation</a>
                    </div>
                </section>
        <?php
    }
});
