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
	<?php dynamic_sidebar( 'homepage-sidebar' ); ?>
</div><!-- .widget-area -->
