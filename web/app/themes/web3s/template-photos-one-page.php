<?php
/* Template Name: Photos Page One Page */
get_header();
?>

<div class="column column--2 column--content column--submenu <?php if (is_page()) echo 'column--page--nav--full'; ?>">
	<?php get_template_part( 'templates/submenu/submenu', 'photos' ); ?>
</div>

<div class="column--content--full--container">
	
	<?php
	$days = array('monday','tuesday','wednesday');
	$i = 0;
	foreach ($days as $day) {
		$i++;
		?>
		<div class="column column--<?php echo $i; ?> column--content column--content--full">
			<div class="photos-column">
				<?php echo web3s_get_photos_one_page('photos/'.$post->post_name,$i); ?>
			</div>
		</div>

	<?php } ?>

</div>

<?php get_footer(); ?>
