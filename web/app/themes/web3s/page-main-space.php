<?php get_header(); ?>

<div class="column column--2 column--content column--submenu <?php if (is_page()) echo 'column--page--nav--full'; ?>">
	<?php get_template_part( 'templates/submenu/submenu', 'program' ); ?>
</div>

<div class="column--content--full--container">
	
	<?php 
	$days = array('monday','tuesday','wednesday');
	$i = 0;
	foreach ($days as $day) {
		$i++;
		?>
		<div class="column column--<?php echo $i; ?> column--content column--content--full">
			<h1 class="program-title t-uppercase"><?php echo ucfirst($day); ?></h1>
			<div class="program-column">
				<?php echo web3s_get_program_columns('program/main-space/'.$day); ?>
			</div>
		</div>

	<?php } ?>

</div>

<?php get_footer(); ?>