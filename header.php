<?php
/**
 * The header
 *
 * @author   Fernando Tessmann
 * @since    1.0.0
 * @package  nandotess-resume
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div id="page" class="hfeed site">
			<?php
				/**
				 * Functions hooked into nr_before_header action
				 *
				 * @hooked nr_header_skip_links - 0
				 */
				do_action( 'nr_before_header' );
			?>

			<header id="masthead" class="site-header" role="banner">
				<?php
					/**
					 * Functions hooked into nr_header action
					 *
					 * @hooked nr_header_nav_contact_details - 0
					 * @hooked nr_header_nav_main - 0
					 */
					do_action( 'nr_header' );
				?>
			</header>

			<div id="content" class="site-content" tabindex="-1">
