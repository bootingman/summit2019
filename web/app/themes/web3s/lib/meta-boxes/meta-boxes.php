<?php

function web3s_register_meta_boxes( $meta_boxes ) {
    
    $prefix = 'web3s_rwmb_';
    
    $meta_boxes[] = array(
        'id'         => $prefix . 'speaker_metabox',
        'title'      => 'Speaker\'s Info',
        'post_types' => array('web3s_speaker'),
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => 'Company',
                'desc'  => 'To show as headline',
                'id'    => $prefix . 'speaker_company',
                'type'  => 'text',
                'size'  => 60,
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => $prefix . 'node_metabox',
        'title'      => 'Node\'s Info',
        'post_types' => array('web3s_node'),
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => 'Description',
                'desc'  => 'To show as headline',
                'id'    => $prefix . 'node_description',
                'type'  => 'text',
                'size'  => 60,
            ),
        )
    );
    
    $meta_boxes[] = array(
        'id'         => $prefix . 'video_metabox',
        'title'      => 'Video\'s Info',
        'post_types' => array('web3s_video'),
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => 'Subtitle',
                'id'    => $prefix . 'video_subtitle',
                'type'  => 'text',
                'size'  => 60,
            ),
            array(
                'name'  => 'Video Embed',
                'id'    => $prefix . 'video_url',
                'type'  => 'text',
                'size'  => 60,
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => $prefix . 'page_gallery_box',
        'title'      => 'Page Image Gallery',
        'post_types' => 'page',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'id'               => $prefix . 'page_gallery',
                'name'             => 'Image Gallery',
                'type'             => 'image_advanced',
                'force_delete'     => false,
                'image_size'       => 'thumbnail',
            ),
        )
    );

    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'web3s_register_meta_boxes' );