<?php
function web3s_get_speakers($limit=-1)
{
    $args = array(
        'posts_per_page'   => $limit,
        'offset'           => 0,
        'category'         => '',
        'category_name'    => '',
        'include'          => '',
        'exclude'          => '',
        'orderby'          => 'post_title',
        'order'            => 'ASC',
        'post_type'        => 'web3s_speaker',
        'post_mime_type'   => '',
        'post_parent'      => '',
        'author'           => '',
        'author_name'      => '',
        'post_status'      => 'publish',
        'suppress_filters' => true 
    );
    $speakers = get_posts( $args );
    return $speakers;
}