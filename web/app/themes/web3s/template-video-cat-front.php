<?php
/* Template Name: Video 1 page cat: front */
get_header();
$video = new WzhVideo;
?>

<div class="column--content--full--container">
	<div class="gallery-rows">
		<?php
		$i = 0;
		foreach ($video->getFrontVideo() as $vid) {
			$i++; ?>

			<div class="gallery-item">
				<div class="video-single-embed">
					<?php echo rwmb_meta( 'web3s_rwmb_video_url', '', $vid->ID ); ?>
				</div>
				<h1 class="video-single-title"><?php echo $vid->post_title; ?></h1>
				<div class="video-single-subtitle"><?php echo rwmb_meta( 'web3s_rwmb_video_subtitle', '', $vid->ID ); ?></div>
			</div>

		<?php } ?>
	</div>
</div>

<?php get_footer(); ?>
