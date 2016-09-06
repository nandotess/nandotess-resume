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
		<div class="page">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nandotess-resume' ); ?></a>

			<header id="header" class="header">
				<div class="grid contact-details">
					<div class="row">
						<div class="col-1-1">
							<?php
								$mail  = get_theme_mod( 'nandotess_resume_mail', 'mail@mail.com' );
								$phone = get_theme_mod( 'nandotess_resume_phone', '+0000 0000 0000' );
								$phone_numbers = preg_replace( '/\D/', '', $phone );
							?>

							<a class="mail" href="mailto:<?php echo $mail; /* WPCS: xss ok. */ ?>"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $mail; /* WPCS: xss ok. */ ?></a>
							<a class="phone" href="tel:<?php echo $phone_numbers; /* WPCS: xss ok. */ ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $phone; /* WPCS: xss ok. */ ?></a>
						</div>
					</div>
				</div><!-- .contact-details -->

				<nav class="grid main-navigation">
					<div class="row">
						<div class="col-1-1">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i></button>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						</div>
					</div>
				</nav><!-- .main-navigation -->
			</header><!-- .header -->

			<div id="content" class="content">
				<section id="about" class="section about">
					<div class="grid">
						<div class="row">
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
					</div>
				</section><!-- .section.about -->
