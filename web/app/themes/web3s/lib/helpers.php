<?php

function web3s_wp_index($lenght)
{
    return 40;
}

// Create the Custom Excerpts callback
function web3s_wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

function web3s_get_content_by_path($path)
{
    $post = get_page_by_path($path);
    return apply_filters( 'the_content', $post->post_content );
}

function web3s_get_subpages_by_path($path)
{
    $post = get_page_by_path($path);
    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'hierarchical' => 0,
        'exclude' => '',
        'include' => '',
        'meta_key' => '',
        'meta_value' => '',
        'authors' => '',
        'child_of' => $post->ID,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'page',
        'post_status' => 'publish'
    ); 
    return get_pages($args); 
}

function web3s_get_photo_subpages_by_path($path)
{
    $post = get_page_by_path($path);
    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'hierarchical' => 0,
        'exclude' => '',
        'include' => '',
        'meta_key' => '',
        'meta_value' => '',
        'authors' => '',
        'child_of' => $post->ID,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => 'page',
        'post_status' => 'publish'
    ); 
    return get_pages($args); 
}

function web3s_get_program_columns($path)
{
    $pages = web3s_get_subpages_by_path($path);
    foreach ($pages as $page) {
        echo '<div class="program-row"><div class="program-row--inner">'.apply_filters( 'the_content', $page->post_content ).'</div></div>';
    }
}

function web3s_get_photos_columns($path)
{
    $post = get_page_by_path($path);
    $photos = new WzhPhotos;
    echo $photos->gallery($post->ID);
}

function web3s_get_photos_one_page($path,$index)
{
    $post = get_page_by_path($path);
    $photos = new WzhPhotos;
    return $photos->galleryColumns($post->ID)[$index];
}

function web3s_isPage()
{
    if ( is_singular('web3s_speaker') || is_singular('web3s_video') || is_singular('web3s_node')) {
        return true;
    } else {
        return false;
    }
    
}