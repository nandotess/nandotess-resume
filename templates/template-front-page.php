<?php
/**
 * The template for displaying the homepage
 *
 * Template Name: Homepage
 *
 * @package nandotess-resume
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'partials/content', 'front-page' );
				}
			?>

		</main>
	</div>

<?php
get_footer();
