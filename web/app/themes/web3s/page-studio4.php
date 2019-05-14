<?php get_header(); ?>

<div class="column column--2 column--content column--submenu <?php if (is_page()) echo 'column--page--nav--full'; ?>">
	<?php get_template_part( 'templates/submenu/submenu', 'stream' ); ?>
</div>

<div class="column--content--full--container">
	<div class="videocontainersp"><iframe src="https://live.streampark.tv/web3summit2" frameborder="0" allowfullscreen></iframe></div> 
</div>

<?php get_footer(); ?>