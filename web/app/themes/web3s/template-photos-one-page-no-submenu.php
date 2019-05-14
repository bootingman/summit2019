<?php
/* Template Name: Photos 1 page no submenu */
get_header();
$photos = new WzhPhotos;
?>

<div class="column--content--full--container">
	
	<div class="gallery-rows">
		<?php echo $photos->gallery(get_page_by_path('photos')->ID); ?>		
	</div>

</div>

<?php get_footer(); ?>
