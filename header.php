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
				<?php
					$mail  = get_theme_mod( 'nandotess_resume_mail', 'mail@mail.com' );
					$phone = get_theme_mod( 'nandotess_resume_phone', '+0000 0000 0000' );
					$phone_numbers = preg_replace( '/\D/', '', $phone );
				?>

				<nav class="navbar navbar-contact-details hidden-xs">
					<div class="container">
						<ul class="nav navbar-nav navbar-right">
							<li><a class="phone" href="tel:<?php echo $phone_numbers; /* WPCS: xss ok. */ ?>"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <span class="text"><?php echo $phone; /* WPCS: xss ok. */ ?></span></a></li>
							<li><a class="mail" href="mailto:<?php echo $mail; /* WPCS: xss ok. */ ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="text"><?php echo $mail; /* WPCS: xss ok. */ ?></span></a></li>
						</ul>
					</div>
				</nav>

				<nav class="navbar navbar-main">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

							<ul class="nav navbar-nav hidden visible-xs">
								<li><a class="phone" href="tel:<?php echo $phone_numbers; /* WPCS: xss ok. */ ?>"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></a></li>
								<li><a class="mail" href="mailto:<?php echo $mail; /* WPCS: xss ok. */ ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></li>
							</ul>
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
				<section id="about" class="section about">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
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
				</section>
