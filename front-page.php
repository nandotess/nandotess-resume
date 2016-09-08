<?php
/**
 * The homepage template file.
 *
 * @package nandotess-resume
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
				get_template_part( 'partials/content', 'front-page' );
			?>

		</main>
	</div>

<?php
get_footer();
