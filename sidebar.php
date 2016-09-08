<?php
/**
 * The sidebar containing the homepage widget area.
 *
 * @package nandotess-resume
 */

if ( ! is_active_sidebar( 'homepage-sidebar' ) ) {
	return;
}
?>

<div class="widget-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php dynamic_sidebar( 'homepage-sidebar' ); ?>
			</div>
		</div>
	</div>
</div>
