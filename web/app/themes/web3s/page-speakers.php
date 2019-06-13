<?php get_header(); ?>

<div class="column column--2 column--content">
	<main role="main">
		<section class="page--column--content">
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<h1><?php the_title(); ?></h1>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>

			<?php endwhile; ?>
			<?php else: ?>
			<?php endif; ?>

			<?php 
			foreach (web3s_get_speakers() as $speaker) { ?>
				<?php
				$content = $speaker->post_content;
				if ($content) { ?>
					<a href="<?php echo get_permalink($speaker->ID); ?>" class="speaker-list-link">
					<?php } else { ?>
						<div class="speaker-list-link">
						<?php } ?>

						<span class="speaker-list-name"><?php echo $speaker->post_title; ?></span>
						<span class="speaker-list-company"><?php echo rwmb_meta( 'web3s_rwmb_speaker_company', '', $speaker->ID ); ?></span>
						<?php if ($content) { ?>
						</a>
					<?php } else { ?>
					</div>
				<?php } ?>
			<?php } ?>

		</section>
	</main>
</div>

<div class="column column--3 column--static column--blocks column--wheight">
	<div id="blocks--container" class="blocks blocks--page"></div>
	<div class="block--fill block--available"></div>
</div>

<?php get_footer(); ?>
