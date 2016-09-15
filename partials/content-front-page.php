<?php
/**
 * The template used for displaying page content in template-front-page.php
 *
 * @author   Fernando Tessmann
 * @since    1.0.0
 * @package  nandotess-resume
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		/**
		 * Functions hooked in to nr_homepage add_action
		 *
		 * @hooked nr_homepage_section_about - 10
		 */
		do_action( 'nr_homepage' );
	?>
</div>
