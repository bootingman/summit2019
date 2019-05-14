<?php get_header(); ?>
<div class="column column--2 column--content">
	<main role="main">
		<section class="page--column--content page--column--content--pretix">
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

			<pretix-widget event="https://pretix.eu/web3foundation/web3summit-2/"></pretix-widget>
			<noscript><div class="pretix-widget"><div class="pretix-widget-info-message">JavaScript ist in Ihrem Browser deaktiviert. Um unseren Ticket-Shop ohne JavaScript aufzurufen, klicken Sie bitte <a target="_blank" rel="noopener" href="https://pretix.eu/web3foundation/web3summit/">hier</a>.</div></div></noscript>
			
		</section>
	</main>
</div>
<div class="column column--3 column--static column--blocks column--wheight">
	<div id="blocks--container" class="blocks blocks--page"></div>
	<div class="block--fill block--available"></div>
</div>
<?php get_footer(); ?>
