<?php
/**
 * Functions
 *
 * @author   Fernando Tessmann
 * @since    1.0.0
 * @package  nandotess-resume
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'nr_header_skip_links' ) ) {
	/**
	 * Skip links
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function nr_header_skip_links() {
		?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nandotess-resume' ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'nr_header_nav_contact_details' ) ) {
	/**
	 * Contact details menu
	 *
	 * @param string $device Device.
	 * @since  1.0.0
	 * @return void
	 */
	function nr_header_nav_contact_details( $device ) {
		$mail          = get_theme_mod( 'nr_mail', 'mail@mail.com' );
		$phone         = get_theme_mod( 'nr_phone', '+0000 0000 0000' );
		$phone_numbers = preg_replace( '/\D/', '', $phone );

		if ( $mail || $phone_numbers || is_customize_preview() ) :
			if ( 'mobile' === $device ) :
				?>
				<ul class="nav navbar-nav hidden visible-xs">
					<?php if ( $phone_numbers || is_customize_preview() ) : ?>
						<li><a class="phone" href="tel:<?php echo esc_attr( $phone_numbers ); ?>"><span class="fa fa-phone" aria-hidden="true"></span></a></li>
					<?php endif; ?>

					<?php if ( $mail || is_customize_preview() ) : ?>
						<li><a class="mail" href="mailto:<?php echo esc_attr( $mail ); ?>"><span class="fa fa-envelope" aria-hidden="true"></span></a></li>
					<?php endif; ?>
				</ul>
				<?php
			else :
				?>
				<nav class="navbar navbar-contact-details hidden-xs">
					<div class="container-fluid">
						<ul class="nav navbar-nav">
							<?php if ( $phone_numbers || is_customize_preview() ) : ?>
								<li><a class="phone" href="tel:<?php echo esc_attr( $phone_numbers ); ?>"><span class="fa fa-phone" aria-hidden="true"></span> <span class="text"><?php echo esc_html( $phone ); ?></span></a></li>
							<?php endif; ?>

							<?php if ( $mail || is_customize_preview() ) : ?>
								<li><a class="mail" href="mailto:<?php echo esc_attr( $mail ); ?>"><span class="fa fa-envelope" aria-hidden="true"></span> <span class="text"><?php echo esc_html( $mail ); ?></span></a></li>
							<?php endif; ?>
						</ul>
					</div>
				</nav>
				<?php
			endif;
		endif;
	}
}

if ( ! function_exists( 'nr_header_nav_main' ) ) {
	/**
	 * Main menu
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function nr_header_nav_main() {
		?>
		<nav class="navbar navbar-main">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main" aria-expanded="false">
						<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'nandotess-resume' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<?php nr_header_nav_contact_details( 'mobile' ); ?>
				</div>

				<div class="collapse navbar-collapse" id="navbar-main">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'nav navbar-nav',
							'container'      => false,
						) );
					?>
				</div>
			</div>
		</nav>
		<?php
	}
}

if ( ! function_exists( 'nr_homepage_section_about' ) ) {
	/**
	 * Homepage section about
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function nr_homepage_section_about() {
		?>
		<section id="about" class="section about">
			<div class="container">
				<div class="row">
					<div class="box">
						<div class="col-md-12">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium', array( 'class' => 'image img-responsive img-circle' ) ); ?>
							<?php else : ?>
								<img width="300" height="300" src="http://placehold.it/300x300" class="image img-responsive img-circle wp-post-image" alt="placeholder">
							<?php endif; ?>

							<h1 class="title"><?php bloginfo( 'name' ); ?></h1>

							<?php
								$description = get_bloginfo( 'description', 'display' );

								if ( $description || is_customize_preview() ) : ?>
									<h2 class="description"><?php echo wp_kses_post( $description ); ?></h2>
								<?php endif;
							?>

							<div class="full-description">
								<?php the_content(); ?>
							</div>

							<?php do_action( 'nr_section_about_bottom' ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}

if ( ! function_exists( 'nr_footer_nav_social' ) ) {
	/**
	 * Social menu
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function nr_footer_nav_social() {
		wp_nav_menu( array(
			'theme_location' => 'social',
			'menu_class'     => 'nav navbar-nav',
			'container'      => false,
			'link_before'    => '<span>',
			'link_after'    => '</span>',
		) );
	}
}
