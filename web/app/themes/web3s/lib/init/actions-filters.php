<?php
// ACTIONS

function web3s_remove_admin_menus()
{
    remove_menu_page( 'edit-comments.php' );
}

function web3s_remove_comment_support()
{
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}

function web3s_admin_bar_render()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}

function web3s_wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

function web3s_remove_menus(){
  remove_menu_page( 'index.php' ); //Dashboard
}

// redirect from dashboard to page
function web3s_dashboard_redirect(){
    wp_redirect(admin_url('edit.php?post_type=page'));
}

// COMMENTS
add_action('admin_menu', 'web3s_remove_admin_menus' ); // Removes comments from post and pages
add_action('init', 'web3s_remove_comment_support', 100); // Removes comments from post and pages
add_action('wp_before_admin_bar_render', 'web3s_admin_bar_render' ); // Removes comments from admin bar

// Add custom Pagination
add_action('init', 'web3s_wp_pagination');

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles' );
add_action( 'admin_menu', 'web3s_remove_menus' ); //remove dashboard menu
add_action('load-index.php','web3s_dashboard_redirect'); //redirect to admin pages





// FILTERS

// Remove invalid rel attribute values in the categorylist
function web3s_remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class
function web3s_add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Custom View Article link to Post
function web3s_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">View Article</a>';
}

// Remove Admin bar
function web3s_remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function web3s_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function web3s_remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// remove wp generated meta tags
function web3s_no_generator()
{
    return '';
}

// unset default media sizes
function web3s_add_image_insert_override($sizes)
{
    unset( $sizes['thumbnail']);
    unset( $sizes['medium']);
    unset( $sizes['large']);
    return $sizes;
}

// redirect from dashboard to page
function web3s_login_redirect( $redirect_to, $request, $user ){
    return admin_url('edit.php?post_type=page');
}

add_filter('the_category', 'web3s_remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('body_class', 'web3s_add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('excerpt_more', 'web3s_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'web3s_remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'web3s_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'web3s_remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'web3s_remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter( 'the_generator', 'web3s_no_generator' ); // remove wp generated meta tags
// add_filter('intermediate_image_sizes_advanced', 'web3s_add_image_insert_override' ); // unset default media sizes
add_filter('login_redirect','web3s_login_redirect',10,3); // redirect from dashboard to page


// Add Filters
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
