<?php
	$subpages = array(
		get_page_by_path('imprint'),
		get_page_by_path('terms-and-conditions'),
		get_page_by_path('privacy-policy'),
	);
	$page_object = get_queried_object();
	$page_id     = get_queried_object_id();
?>

<ul class="footer--submenu">
	<?php foreach ($subpages as $subpage) {
		echo '<li class="menu-item menu-item-type-post_type menu-item-object-page '.(($page_id === $subpage->ID)?'current_page_item':'').'">';
			echo '<a href="'.get_permalink($subpage->ID).'">'.$subpage->post_title.'</a>';
		echo '</li>';
	} ?>
</ul>