<?php
/**
 * The main template file.
 *
 * @package nandotess-resume
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php
				get_template_part( 'partials/content', 'none' );
			?>

		</main>
	</div>

<?php
get_footer();
