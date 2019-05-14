<?php
get_header();
?>

<div class="column column--2 column--content">
	<main role="main">
		<section class="page--column--content">

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<h1 class="video-single-title"><?php the_title(); ?></h1>
				<div class="video-single-subtitle"><?php echo rwmb_meta( 'web3s_rwmb_video_subtitle', '', $post->ID ); ?></div>
				<div class="video-single-embed">
					<?php echo rwmb_meta( 'web3s_rwmb_video_url', '', $post->ID ); ?>
				</div>

			<?php endwhile; ?>

			<?php else: ?>
			<?php endif; ?>

		</section>
	</main>
</div>

<div class="column column--3 column--static column--blocks column--wheight">
	<div id="blocks--container" class="blocks blocks--page"></div>
	<div class="block--fill block--available"></div>
</div>

<?php get_footer(); ?>