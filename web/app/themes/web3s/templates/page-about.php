<?php 
$post = get_page_by_path('about');
?>

<div class="column column--2 column--content">
	<main role="main">
		<section class="page--column--content">

			<h1><?php echo $post->post_title; ?></h1>

			<article>

				<?php 
				echo apply_filters( 'the_content', $post->post_content );
				?>

			</article>

		</section>
	</main>
</div>

<div class="column column--3 column--static column--blocks column--wheight">
	<div id="blocks--container" class="blocks blocks--page"></div>
	<div class="block--fill block--available"></div>
</div>
