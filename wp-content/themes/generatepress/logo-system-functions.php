// Advanced Logo System Functions
// Add to your child theme's functions.php

/**
 * Enhanced Logo System with Multiple Sizes and Formats
 */
class GP_Advanced_Logo_System {

    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_logo_scripts'));
        add_action('wp_head', array($this, 'add_logo_css_variables'));
        add_filter('generate_logo_output', array($this, 'custom_logo_output'), 10, 2);
        add_action('customize_register', array($this, 'add_logo_customizer_options'));
    }

    /**
     * Enqueue logo-related scripts and styles
     */
    public function enqueue_logo_scripts() {
        wp_enqueue_script(
            'gp-logo-system',
            get_stylesheet_directory_uri() . '/js/logo-system.js',
            array('jquery'),
            filemtime(get_stylesheet_directory() . '/js/logo-system.js'),
            true
        );

        wp_enqueue_style(
            'gp-logo-styles',
            get_stylesheet_directory_uri() . '/css/logo-system.css',
            array(),
            filemtime(get_stylesheet_directory() . '/css/logo-system.css')
        );
    }

    /**
     * Add CSS custom properties for logo theming
     */
    public function add_logo_css_variables() {
        $logo_max_width = get_theme_mod('logo_max_width', '200');
        $logo_max_height = get_theme_mod('logo_max_height', '60');

        echo '<style>:root {
            --logo-max-width: ' . esc_attr($logo_max_width) . 'px;
            --logo-max-height: ' . esc_attr($logo_max_height) . 'px;
            --logo-transition: all 0.3s ease;
        }</style>';
    }

    /**
     * Custom logo output with enhanced features
     */
    public function custom_logo_output($output, $logo_url) {
        if (!$logo_url) return $output;

        $custom_logo_id = get_theme_mod('custom_logo');
        $logo_alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
        $logo_title = get_the_title($custom_logo_id);

        // Get different logo sizes
        $logo_sizes = $this->get_logo_sizes($custom_logo_id);

        ob_start();
        ?>
        <div class="gp-advanced-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>"
               class="gp-logo-link"
               aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">

                <picture class="gp-logo-picture">
                    <?php if (isset($logo_sizes['webp'])): ?>
                        <source srcset="<?php echo esc_url($logo_sizes['webp']); ?>" type="image/webp">
                    <?php endif; ?>

                    <img src="<?php echo esc_url($logo_url); ?>"
                         alt="<?php echo esc_attr($logo_alt ?: get_bloginfo('name')); ?>"
                         class="gp-logo-image"
                         width="<?php echo esc_attr($logo_sizes['width']); ?>"
                         height="<?php echo esc_attr($logo_sizes['height']); ?>"
                         loading="eager">
                </picture>

                <?php if (get_theme_mod('logo_show_text', true)): ?>
                    <div class="gp-logo-text">
                        <span class="gp-site-title"><?php echo esc_html(get_bloginfo('name')); ?></span>
                        <?php if (get_bloginfo('description')): ?>
                            <span class="gp-site-description"><?php echo esc_html(get_bloginfo('description')); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </a>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Get optimized logo sizes
     */
    private function get_logo_sizes($logo_id) {
        $sizes = array();

        // Get WebP version if available
        if (function_exists('wp_get_attachment_image_srcset')) {
            $webp_url = wp_get_attachment_image_url($logo_id, 'full', false);
            if ($webp_url) {
                $webp_path = str_replace('.jpg', '.webp', $webp_url);
                $webp_path = str_replace('.jpeg', '.webp', $webp_path);
                $webp_path = str_replace('.png', '.webp', $webp_path);

                if ($this->webp_exists($webp_path)) {
                    $sizes['webp'] = $webp_path;
                }
            }
        }

        // Get original dimensions
        $image_data = wp_get_attachment_image_src($logo_id, 'full');
        if ($image_data) {
            $sizes['width'] = $image_data[1];
            $sizes['height'] = $image_data[2];
        }

        return $sizes;
    }

    /**
     * Check if WebP version exists
     */
    private function webp_exists($webp_url) {
        $response = wp_remote_head($webp_url);
        return !is_wp_error($response) && $response['response']['code'] === 200;
    }

    /**
     * Add customizer options for logo
     */
    public function add_logo_customizer_options($wp_customize) {
        // Logo Max Width
        $wp_customize->add_setting('logo_max_width', array(
            'default' => '200',
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control('logo_max_width', array(
            'label' => __('Logo Max Width (px)', 'generatepress'),
            'section' => 'title_tagline',
            'type' => 'number',
            'priority' => 9,
        ));

        // Logo Max Height
        $wp_customize->add_setting('logo_max_height', array(
            'default' => '60',
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control('logo_max_height', array(
            'label' => __('Logo Max Height (px)', 'generatepress'),
            'section' => 'title_tagline',
            'type' => 'number',
            'priority' => 10,
        ));

        // Show Logo Text
        $wp_customize->add_setting('logo_show_text', array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ));

        $wp_customize->add_control('logo_show_text', array(
            'label' => __('Show Logo Text', 'generatepress'),
            'section' => 'title_tagline',
            'type' => 'checkbox',
            'priority' => 11,
        ));
    }
}

// Initialize the advanced logo system
new GP_Advanced_Logo_System();