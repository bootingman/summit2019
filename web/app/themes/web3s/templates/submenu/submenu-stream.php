<?php
	$args = array(
		'sort_column' => 'menu_order',
		'child_of' => get_page_by_path('stream')->ID,
		'parent' => get_page_by_path('stream')->ID,
	);
	$subpages = get_pages($args);
	$page_object = get_queried_object();
	$page_id     = get_queried_object_id();
?>

<ul class="page--submenu">
	<?php foreach ($subpages as $subpage) {
		echo '<li class="menu-item menu-item-type-post_type menu-item-object-page '.(($page_id === $subpage->ID)?'current_page_item':'').'">';
			echo '<a href="'.get_permalink($subpage->ID).'">'.$subpage->post_title.'</a>';
		echo '</li>';
	} ?>
</ul>