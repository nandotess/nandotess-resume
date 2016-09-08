<?php
/**
 * Template Name: Homepage
 *
 * The homepage template file
 *
 * @package nandotess-resume
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'partials/content', 'front-page' ); ?>
			<?php endwhile; ?>
		</main>
	</div>

<?php
get_footer();
