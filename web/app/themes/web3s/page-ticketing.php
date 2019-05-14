<?php get_header(); ?>

<div class="column column--23 column--content">
	<main role="main">
		<section class="page--column--content page--ticketing">

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<article <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>

			<?php endwhile; ?>

			<?php else: ?>
			<?php endif; ?>

			<pretix-widget event="https://pretix.eu/web3foundation/web3summit/"></pretix-widget>
			<noscript><div class="pretix-widget"><div class="pretix-widget-info-message">JavaScript ist in Ihrem Browser deaktiviert. Um unseren Ticket-Shop ohne JavaScript aufzurufen, klicken Sie bitte <a target="_blank" rel="noopener" href="https://pretix.eu/web3foundation/web3summit/">hier</a>.</div></div></noscript>

		</section>
	</main>
</div>

<?php get_footer(); ?>