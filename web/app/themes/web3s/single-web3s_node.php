<?php get_header(); ?>

<div class="column column--2 column--content">
	<main role="main">
		<section class="page--column--content">

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<h1 class="node-single-name"><?php the_title(); ?></h1>
				<div class="node-single-company"><?php echo rwmb_meta( 'web3s_rwmb_node_description', '', $post->ID ); ?></div>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>

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