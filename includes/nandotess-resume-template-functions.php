<?php
/**
 * nandotess's resume functions
 *
 * @package nandotess-resume
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'nandotess_resume_header_skip_links' ) ) {
	/**
	 * Display the skip to content link
	 *
	 * @since  1.0.0
	 */
	function nandotess_resume_header_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nandotess-resume' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'nandotess_resume_header_nav_contact_details' ) ) {
	/**
	 * Display the contact details menu
	 *
	 * @since  1.0.0
	 */
	function nandotess_resume_header_nav_contact_details( $device ) {
		$mail  = get_theme_mod( 'nandotess_resume_mail', 'mail@mail.com' );
		$phone = get_theme_mod( 'nandotess_resume_phone', '+0000 0000 0000' );
		$phone_numbers = preg_replace( '/\D/', '', $phone );

		if ( $mail || $phone_numbers || is_customize_preview() ) :
			if ( $device === 'mobile' ) :
				?>
				<ul class="nav navbar-nav hidden visible-xs">
					<?php if ( $phone_numbers || is_customize_preview() ) : ?>
						<li><a class="phone" href="tel:<?php echo $phone_numbers; /* WPCS: xss ok. */ ?>"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></a></li>
					<?php endif; ?>

					<?php if ( $mail || is_customize_preview() ) : ?>
						<li><a class="mail" href="mailto:<?php echo $mail; /* WPCS: xss ok. */ ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></li>
					<?php endif; ?>
				</ul>
				<?php
			else :
				?>
				<nav class="navbar navbar-contact-details hidden-xs">
					<div class="container">
						<ul class="nav navbar-nav">
							<?php if ( $phone_numbers || is_customize_preview() ) : ?>
								<li><a class="phone" href="tel:<?php echo $phone_numbers; /* WPCS: xss ok. */ ?>"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <span class="text"><?php echo $phone; /* WPCS: xss ok. */ ?></span></a></li>
							<?php endif; ?>

							<?php if ( $mail || is_customize_preview() ) : ?>
								<li><a class="mail" href="mailto:<?php echo $mail; /* WPCS: xss ok. */ ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="text"><?php echo $mail; /* WPCS: xss ok. */ ?></span></a></li>
							<?php endif; ?>
						</ul>
					</div>
				</nav>
				<?php
			endif;
		endif;
	}
}

if ( ! function_exists( 'nandotess_resume_header_nav_main' ) ) {
	/**
	 * Display the main menu
	 *
	 * @since  1.0.0
	 */
	function nandotess_resume_header_nav_main() {
		?>
		<nav class="navbar navbar-main">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<?php nandotess_resume_header_nav_contact_details( 'mobile' ); ?>
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
		<?php
	}
}

if ( ! function_exists( 'nandotess_resume_homepage_content' ) ) {
	/**
	 * Display the homepage content
	 *
	 * @since  1.0.0
	 */
	function nandotess_resume_homepage_content() {
		?>
		<section id="about" class="section about">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="thumbnail">
								<?php the_post_thumbnail( 'medium', array( 'class' => 'img-responsive' ) ); ?>
							</div>
						<?php endif; ?>

						<h1 class="section-title"><?php bloginfo( 'name' ); ?></h1>

						<?php
							$description = get_bloginfo( 'description', 'display' );

							if ( $description || is_customize_preview() ) : ?>
								<h2 class="section-description"><?php echo $description; /* WPCS: xss ok. */ ?></h2>
							<?php endif;
						?>

						<div class="section-full-description">
							<?php the_content(); ?>
						</div>

						<?php
							/**
							 * Functions hooked in to nandotess_resume_section_about_bottom add_action
							 *
							 * @hooked nandotess_resume_homepage_content - 10
							 */
							do_action( 'nandotess_resume_section_about_bottom' );
						?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}

if ( ! function_exists( 'nandotess_resume_homepage_widgets' ) ) {
	/**
	 * Display the homepage widgets sidebar
	 *
	 * @since  1.0.0
	 */
	function nandotess_resume_homepage_widgets() {
		?>
		<div class="homepage-sidebar">
			<?php
				if ( is_active_sidebar( 'homepage-sidebar' ) ) {
					dynamic_sidebar( 'homepage-sidebar' );
				}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'nandotess_resume_footer_nav_social' ) ) {
	/**
	 * Display the social menu
	 *
	 * @since  1.0.0
	 */
	function nandotess_resume_footer_nav_social() {
		wp_nav_menu( array(
			'theme_location' => 'social',
			'menu_class' => 'nav navbar-nav',
			'container' => false,
		) );
	}
}
