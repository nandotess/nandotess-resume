<?php
/**
 * The header.
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
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nandotess-resume' ); ?></a>

			<div class="contact-details">
				<div class="grid">
					<div class="col-1-1">
						<?php
							$phone = get_theme_mod( 'nandotess_resume_phone', '+0000 0000 0000' );
							$phone_numbers = preg_replace( '/\D/', '', $phone );

							$mail = get_theme_mod( 'nandotess_resume_mail', 'mail@mail.com' );
						?>
						
						<a class="phone" href="tel:<?php echo $phone_numbers; /* WPCS: xss ok. */ ?>"><?php echo $phone; /* WPCS: xss ok. */ ?></a>
						<span class="sep"> | </span>
						<a class="mail" href="mailto:<?php echo $mail; /* WPCS: xss ok. */ ?>"><?php echo $mail; /* WPCS: xss ok. */ ?></a>
					</div>
				</div>
			</div>

			<nav class="main-navigation">
				<div class="grid">
					<div class="col-1-1">
						<!--<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'nandotess-resume' ); ?></button>-->
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					</div>
				</div>
			</nav><!-- .main-navigation -->

			<header id="about" class="site-header">
				<div class="grid">
					<div class="col-1-1">
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>

						<?php
							$description = get_bloginfo( 'description', 'display' );

							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php endif;
						?>
					</div>
				</div>
			</header><!-- #about -->

			<div id="content" class="site-content">
