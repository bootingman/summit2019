<?php get_header(); ?>

<div class="column column--2 column--content">
	<main role="main">
		<section class="page--column--content">

			<h1><?php the_title(); ?></h1>

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php the_content(); ?>

				</article>

			<?php endwhile; ?>

			<?php else: ?>

				<article>

					<h2>Sorry, nothing to display.</h2>

				</article>

			<?php endif; ?>

		</section>
	</main>
</div>

<div class="column column--3 column--static column--blocks column--wheight">
	<div id="blocks--container" class="blocks blocks--page"></div>
	<div class="block--fill block--available"></div>
</div>

<?php get_footer(); ?>