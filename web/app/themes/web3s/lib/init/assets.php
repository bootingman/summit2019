<?php

define( 'ASSET_VERSION', '3.0.0' );

// Move jQuery to the footer
if (!is_admin())
{
    wp_scripts()->add_data( 'jquery', 'group', 1 );
    wp_scripts()->add_data( 'jquery-core', 'group', 1 );
    wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
}

function web3s_deregister_script()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_dequeue_script('jquery-masonry');
        wp_deregister_script('jquery-masonry');
        
        wp_dequeue_script('masonry');
        wp_deregister_script('masonry');

        wp_dequeue_script('wp-embed');
        wp_deregister_script('wp-embed');
    }
}

function web3s_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('conditionizr', THEME_URI . '/js/vendor/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr');
        
        wp_register_script('modernizr', THEME_URI . '/js/vendor/modernizr-2.7.1.min.js', array(), '2.8.1'); // Modernizr
        wp_enqueue_script('modernizr');

        wp_register_script('pretix', 'https://pretix.eu/widget/v1.en.js' ); // Tickets
        wp_enqueue_script('pretix');

    }
}

function web3s_footer_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('web3s-lazysizes', WP_HOME . '/app/bower_components/lazysizes/lazysizes.min.js', array('jquery'), '4.1.0', 1);
        wp_enqueue_script('web3s-lazysizes');

        wp_register_script('web3s-magnific-popup', WP_HOME . '/app/bower_components/magnific-popup/dist/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', 1);
        wp_enqueue_script('web3s-magnific-popup');
        
        wp_register_script('web3s-scripts', THEME_URI . '/js/min/scripts-min.js', array('jquery'), ASSET_VERSION, 1);
        wp_enqueue_script('web3s-scripts');
    }
}

function web3s_conditional_scripts()
{
    if (is_home() || is_page() || is_single()) {
        wp_register_script('web3s-graphicsjs', WP_HOME . '/app/bower_components/graphicsjs/dist/graphics.min.js', '', '', 1);
        wp_enqueue_script('web3s-graphicsjs');

        wp_register_script('web3s-blocks', THEME_URI . '/js/min/blocks-min.js', array('jquery','web3s-graphicsjs'), ASSET_VERSION, 1);
        wp_enqueue_script('web3s-blocks');
    }

    if(is_home()) {
        
        wp_register_script('jq-mobile-conf', THEME_URI . '/js/jqmobile-conf.js', array('jquery'), ASSET_VERSION, 1);
        wp_enqueue_script('jq-mobile-conf');

        wp_register_script('jq-mobile', WP_HOME . '/app/bower_components/jquery-mobile-bower/js/jquery.mobile-1.4.5.min.js', array('jquery','jq-mobile-conf'), '', 1);
        wp_enqueue_script('jq-mobile');
        
        wp_register_script('web3s-intro', THEME_URI . '/js/intro/min/main-min.js', array('jquery','jq-mobile'), ASSET_VERSION, 1);
        wp_enqueue_script('web3s-intro');
    }

}

function web3s_styles()
{
    wp_register_style('pretix-css', 'https://pretix.eu/web3foundation/web3summit-2/widget/v1.css', array(), '1.0', 'all');
    wp_enqueue_style('pretix-css');

    wp_register_style('web3s-magnific-popup-css', WP_HOME . '/app/bower_components/magnific-popup/dist/magnific-popup.css', array(), '1.1.0', 'all');
    wp_enqueue_style('web3s-magnific-popup-css');

    wp_register_style('web3s-style', THEME_URI . '/style.css', array(), ASSET_VERSION, 'all');
    wp_enqueue_style('web3s-style');
}


add_action( 'wp_print_scripts', 'web3s_deregister_script', 100 );
add_action('init', 'web3s_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'web3s_footer_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'web3s_conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'web3s_styles'); // Add Theme Stylesheet
