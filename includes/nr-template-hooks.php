<?php
/**
 * nandotess's resume hooks
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
 * @see  nr_homepage_content()
 * @see  nr_homepage_widgets()
 */
add_action( 'nr_homepage', 'nr_homepage_content', 10 );
add_action( 'nr_homepage', 'nr_homepage_widgets', 20 );

/**
 * Footer
 *
 * @see  nr_footer_nav_social()
 */
add_action( 'nr_footer', 'nr_footer_nav_social', 10 );
