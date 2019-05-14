<?php
add_action( 'init', 'web3s_create_video_taxonomy', 0 );

function web3s_create_video_taxonomy() {
	$labels = array(
		'name'              => 'Categories',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'public'  	        => true,
		'rewrite'           => false,
	);
    register_taxonomy('web3s_video_category','web3s_video', $args);
}
