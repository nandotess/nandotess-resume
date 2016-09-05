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
	<div class="grid">
		<div class="col-1-1">
			<?php dynamic_sidebar( 'homepage-sidebar' ); ?>
		</div>
	</div>
</div><!-- .widget-area -->
