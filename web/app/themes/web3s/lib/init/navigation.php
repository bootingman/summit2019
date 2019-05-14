<?php

function web3s_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

function web3s_register_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => 'Header Menu', // Main Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function web3s_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function web3s_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

add_action('init', 'web3s_register_menu'); // Add Blank Menu
add_filter('wp_nav_menu_args', 'web3s_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation

// add_filter('nav_menu_css_class', 'web3s_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
add_filter('nav_menu_item_id', 'web3s_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
add_filter('page_css_class', 'web3s_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)