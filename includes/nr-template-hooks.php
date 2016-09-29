<?php
/**
 * Hooks
 *
 * @author   Fernando Tessmann
 * @since    1.0.0
 * @package  nandotess-resume
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header
 *
 * @see  nr_header_skip_links()
 * @see  nr_header_nav_contact_details()
 * @see  nr_header_nav_main()
 */
add_action( 'nr_before_header', 'nr_header_skip_links',          0 );
add_action( 'nr_header',        'nr_header_nav_contact_details', 10 );
add_action( 'nr_header',        'nr_header_nav_main',            20 );

/**
 * Homepage
 *
 * @see  nr_homepage_section_about()
 */
add_action( 'nr_homepage', 'nr_homepage_section_about', 10 );

/**
 * Footer
 *
 * @see  nr_footer_nav_social()
 */
add_action( 'nr_footer', 'nr_footer_nav_social', 10 );
