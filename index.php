<?php
/**
 * The main template file.
 *
 * @package nandotess-resume
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			
			<?php
				get_template_part( 'partials/content', 'none' );
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
