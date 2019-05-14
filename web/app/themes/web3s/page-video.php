<?php
get_header();
$video = new WzhVideo;
?>

<div class="column--content--full--container">
	
	<?php
	$i = 0;
	foreach ($video->getVideoByCats() as $group) {
	$i++;

		echo '<div class="column column--'.$i.' column--content column--content--full">';
		echo '<div class="video-category">';
		echo '<h1 class="t-uppercase video-cat-title">'.$group['name'].'</h1>';
		foreach ($group['entries'] as $entry) { ?>
			<a href="<?php echo get_permalink($entry->ID); ?>" class="video-list-link">
				<span class="video-list-title"><?php echo $entry->post_title; ?></span>
				<span class="video-list-subtitle"><?php echo rwmb_meta( 'web3s_rwmb_video_subtitle', '', $entry->ID ); ?></span>
			</a>
		<?php }
		echo '</div>';
		echo '</div>';
	}
	?>

</div>

<?php get_footer(); ?>
