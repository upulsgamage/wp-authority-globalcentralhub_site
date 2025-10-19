<?php
/**
 * Template Name: Landing (No Header/Footer)
 * Description: Minimal landing page without the site header and footer. Ideal for focused campaigns.
 *
 * This template outputs a full HTML document with wp_head/wp_footer hooks
 * so that styles/scripts still load while removing theme header/footer markup.
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <style>
        /* Minimal, non-invasive defaults for landing pages */
        body.landing-no-header-footer {
            margin: 0;
        }
        main.site-main {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .landing-container {
            width: 100%;
            max-width: 960px;
            padding: 40px 20px;
        }
    </style>
    
</head>
<body <?php body_class( 'landing-no-header-footer' ); ?>>
    <main id="main" class="site-main" role="main">
        <div class="landing-container">
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
        ?>
        </div>
    </main>
    <?php wp_footer(); ?>
</body>
</html>
