<?php get_header(); ?>

<div class="column column--2 column--content">
	<main role="main">
		<section class="page--column--content">

			<?php get_template_part( 'templates/submenu/submenu', 'program' ); ?>

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile; ?>
			<?php else: ?>
			<?php endif; ?>

			<?php 
			foreach (web3s_get_nodes() as $node) { ?>
				<a href="<?php echo get_permalink($node->ID); ?>" class="node-list-link">
					<span class="node-list-name"><?php echo $node->post_title; ?></span>
					<span class="node-list-description"><?php echo rwmb_meta( 'web3s_rwmb_node_description', '', $node->ID ); ?></span>
				</a>
			<?php } ?>

		</section>
	</main>
</div>

<div class="column column--3 column--static column--blocks column--wheight">
	<div id="blocks--container" class="blocks blocks--page"></div>
	<div class="block--fill block--available"></div>
</div>

<?php get_footer(); ?>