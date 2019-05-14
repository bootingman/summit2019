<?php

function web3s_create_post_type()
{
    register_post_type('web3s_speaker',
        array(
        'labels' => array(
            'name'               => 'Speakers',
            'singular_name'      => 'Speaker',
            'menu_name'          => 'Speakers',
            'name_admin_bar'     => 'web3s_speaker_admin_bar',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New',
            'new_item'           => 'New Speaker',
            'edit_item'          => 'Edit Speaker',
            'view_item'          => 'View Speaker',
            'all_items'          => 'All Speakers',
            'search_items'       => 'Search Speakers',
            'parent_item_colon'  => '',
            'not_found'          => 'No Speaker found',
            'not_found_in_trash' => 'No Speaker in trash'
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
        ),
        'rewrite' => array(
            'slug' => 'speaker',
        ),
        'query_var' => 'speaker',
        'can_export' => true,
    ));

    register_post_type('web3s_node',
        array(
        'labels' => array(
            'name'               => 'Nodes',
            'singular_name'      => 'Node',
            'menu_name'          => 'Nodes',
            'name_admin_bar'     => 'web3s_node_admin_bar',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New',
            'new_item'           => 'New Node',
            'edit_item'          => 'Edit Node',
            'view_item'          => 'View Node',
            'all_items'          => 'All Nodes',
            'search_items'       => 'Search Nodes',
            'parent_item_colon'  => '',
            'not_found'          => 'No Node found',
            'not_found_in_trash' => 'No Node in trash'
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
        ),
        'rewrite' => array(
            'slug' => 'node',
        ),
        'query_var' => 'node',
        'can_export' => true,
    ));

    register_post_type('web3s_video',
        array(
        'labels' => array(
            'name'               => 'Videos',
            'singular_name'      => 'Video',
            'menu_name'          => 'Videos',
            'name_admin_bar'     => 'web3s_video_admin_bar',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New',
            'new_item'           => 'New Video',
            'edit_item'          => 'Edit Video',
            'view_item'          => 'View Video',
            'all_items'          => 'All Videos',
            'search_items'       => 'Search Videos',
            'parent_item_colon'  => '',
            'not_found'          => 'No Video found',
            'not_found_in_trash' => 'No Video in trash'
        ),
        'public' => true,
        'hierarchical' => false,
        'has_archive' => false,
        'supports' => array(
            'title',
        ),
        'rewrite' => array(
            'slug' => 'video',
        ),
        'query_var' => 'video',
        'can_export' => true,
    ));
}

add_action('init', 'web3s_create_post_type');