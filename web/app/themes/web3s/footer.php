		</div>
		<!-- /body-container -->
		<footer class="footer">
			<?php
			if (is_page_template('template-photos-w-subpages.php') || is_page_template('template-photos-one-page.php') || is_page_template('template-photos-one-page-no-submenu.php')) {
				$post = get_page_by_path('photos');
				echo apply_filters( 'the_content', $post->post_content );
			}
			?>
			<?php
			if (is_page_template('template-video-cat-front.php')) {
				$post = get_page_by_path('videos');
				echo apply_filters( 'the_content', $post->post_content );
			}
			?>
			<a href="/imprint" class="footer--link">Imprint</a>
		</footer>
		
		<?php //if(is_home()) echo '<div id="blocks--touch"></div>'; ?>
		<?php wp_footer(); ?>

	</body>
</html>
