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
		 * Functions hooked in to nandotess_resume_homepage add_action
		 *
		 * @hooked nandotess_resume_homepage_content - 10
		 * @hooked nandotess_resume_homepage_widgets - 20
		 */
		do_action( 'nandotess_resume_homepage' );
	?>
</div>
