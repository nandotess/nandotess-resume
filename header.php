<?php
/**
 * The header
 *
 * @package nandotess-resume
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div class="page">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nandotess-resume' ); ?></a>

			<header id="header" class="header">
				<?php get_template_part( 'partials/content', 'header-contact-details-desktop' ); ?>

				<nav class="navbar navbar-main">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

							<?php get_template_part( 'partials/content', 'header-contact-details-mobile' ); ?>
						</div>

						<div class="collapse navbar-collapse" id="navbar-main">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_class' => 'nav navbar-nav',
									'container' => false,
								) );
							?>
						</div>
					</div>
				</nav>
			</header>

			<div id="content" class="content">
