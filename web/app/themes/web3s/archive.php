<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<h1>Archive</h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
