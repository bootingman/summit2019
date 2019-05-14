<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<?php wp_head(); ?>
	<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
        	assets: '<?php echo get_template_directory_uri(); ?>',
        	tests: {}
        });
    </script>
</head>

<body 
<?php if(is_home()) echo 'class="page@home jsBody"';
else body_class(( (web3s_isPage()) ? 'page':'' )); ?>
>

<?php if(is_home()) get_template_part( 'templates/intro'); ?>

<div class="body-container jsBodyContainer">

	<?php //if (!is_home()) { ?>

		<?php if (is_page('main-space') || is_page('workshop') || is_page('studio1') || is_page('studio4') || is_page('videos') || is_page_template('template-photos-w-subpages.php') || is_page_template('template-photos-one-page.php') || is_page_template('template-photos-one-page-no-submenu.php')) { ?>

			<div class="column column--1 column--content <?php if (is_page()) echo 'column--page--nav column--page--nav--full'; ?>">
			<?php } else { ?>
				<div class="column column--1 column--static <?php if (is_page()) echo 'column--page--nav'; ?>">
				<?php } ?>

				<?php //if(is_home()) echo '<div id="blocks--container" class="blocks blocks--front"></div><div class="block--fill block--available"></div>';?>

				<header id="header-main" class="header" role="banner">

					<h1 class="headline">
						<a href="<?php bloginfo('url'); ?>">
							<?php bloginfo('name'); ?>
						</a>
					</h1>

					<div class="description">
						<p>Funkhaus Berlin</p>
						<p>August 19-21</p>
					</div>

					<nav class="nav" role="navigation">
						<?php web3s_nav(); ?>
					</nav>

				</header>

			</div>

		<?php //} ?>
