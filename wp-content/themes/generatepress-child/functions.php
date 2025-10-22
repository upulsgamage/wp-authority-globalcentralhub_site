<?php
/*
 * Custom homepage hero section for Alba Privé & Upul Sanjeewa Gamage
 * Place customizations for the homepage hero here.
 */

add_action('wp_head', function() {
    if (is_front_page()) {
        echo '<style>
            .custom-home-hero {
                background: linear-gradient(135deg, #f8fafc 0%, #e0e7ef 100%);
                padding: 80px 0 60px 0;
                text-align: left;
            }
            .custom-home-hero h1 {
                font-size: 3rem;
                font-weight: 700;
                color: #1a202c;
                margin-bottom: 24px;
            }
            .custom-home-hero p {
                font-size: 1.5rem;
                color: #374151;
                margin-bottom: 32px;
                max-width: 700px;
            }
            .custom-home-hero .cta-btn {
                background: #1a202c;
                color: #fff;
                padding: 16px 40px;
                border-radius: 8px;
                font-size: 1.25rem;
                text-decoration: none;
                font-weight: 600;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                transition: background 0.2s;
            }
            .custom-home-hero .cta-btn:hover {
                background: #374151;
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
                <a href="#contact" class="cta-btn">Work With Upul</a>
            </div>
        </section>
        <section class="about-snapshot" style="background:#fff;padding:48px 0 32px 0;text-align:left;">
            <div class="container">
                <h2 style="font-size:2rem;font-weight:600;color:#1a202c;margin-bottom:16px;">About Upul & Alba Privé</h2>
                <p style="font-size:1.15rem;color:#374151;max-width:700px;margin-bottom:20px;">Upul Sanjeewa Gamage is a visionary technologist and global AI e-commerce architect, blending Sri Lankan heritage with Melbourne artistry. Alba Privé is his latest creation—a sensory ritual brand designed to elevate daily living and inspire transformation. Explore the journey, values, and story behind Alba Privé and Upul’s global impact.</p>
                <a href="/about" style="color:#1a202c;font-weight:600;text-decoration:underline;font-size:1.1rem;">Read the full story</a>
            </div>
        </section>
            <section class="sensory-ritual-teaser" style="background:#f8fafc;padding:48px 0 32px 0;text-align:left;">
                <div class="container" style="display:flex;flex-wrap:wrap;align-items:center;gap:40px;">
                    <div style="flex:1;min-width:280px;">
                        <h2 style="font-size:2rem;font-weight:600;color:#1a202c;margin-bottom:16px;">Experience the Sensory Ritual</h2>
                        <p style="font-size:1.15rem;color:#374151;max-width:600px;margin-bottom:20px;">Discover Alba Privé’s curated Sensory Ritual Experience Box—a transformative journey through scent, sound, and mindful design. Elevate your daily rituals, unlock creativity, and reconnect with your senses. Limited pre-launch edition available.</p>
                        <a href="/alba-prive" style="color:#fff;background:#1a202c;padding:14px 32px;border-radius:6px;font-weight:600;text-decoration:none;font-size:1.1rem;display:inline-block;">Explore Alba Privé</a>
                    </div>
                    <div style="flex:1;min-width:280px;text-align:center;">
                        <img src="/wp-content/themes/generatepress-child/assets/images/Logo SVG Files/For Light Backgrounds/ap-lb-primary-logo-tagline-full-signature-lockup.svg" alt="Alba Privé Primary Logo with Tagline" style="max-width:220px;width:100%;margin-bottom:18px;box-shadow:0 4px 24px rgba(30,30,30,0.07);border-radius:8px;background:#fff;padding:18px 0;" />
                        <div style="font-size:1rem;color:#6b7280;">Sri Lankan Heritage. Melbourne Artistry.<br><em>Product image coming soon</em></div>
                    </div>
                </div>
            </section>
                <section class="freelance-cta" style="background:#fff;padding:48px 0 32px 0;text-align:left;">
                    <div class="container" style="max-width:900px;margin:auto;">
                        <h2 style="font-size:2rem;font-weight:600;color:#1a202c;margin-bottom:16px;">Work With Upul — Freelance & Contract Opportunities</h2>
                        <p style="font-size:1.15rem;color:#374151;max-width:700px;margin-bottom:20px;">Partner with a global expert in AI-powered e-commerce, digital transformation, and sensory brand innovation. Upul Sanjeewa Gamage offers freelance and contract services for select brands, agencies, and founders seeking breakthrough results in strategy, technology, and creative direction.</p>
                        <ul style="font-size:1.1rem;color:#374151;margin-bottom:24px;line-height:1.7;">
                            <li>AI e-commerce architecture & automation</li>
                            <li>Brand strategy & digital transformation</li>
                            <li>Sensory product development & launch</li>
                            <li>Shopify, WordPress, and custom solutions</li>
                            <li>Workshops, consulting, and creative direction</li>
                        </ul>
                        <a href="/contact" style="color:#fff;background:#1a202c;padding:16px 40px;border-radius:8px;font-weight:600;text-decoration:none;font-size:1.2rem;display:inline-block;">Request a Consultation</a>
                    </div>
                </section>
        <?php
    }
});
