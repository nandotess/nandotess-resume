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
 * @see  nandotess_resume_header_skip_links()
 * @see  nandotess_resume_header_nav_contact_details()
 * @see  nandotess_resume_header_nav_main()
 */
add_action( 'nandotess_resume_before_header', 'nandotess_resume_header_skip_links',          0 );
add_action( 'nandotess_resume_header',        'nandotess_resume_header_nav_contact_details', 10 );
add_action( 'nandotess_resume_header',        'nandotess_resume_header_nav_main',            20 );

/**
 * Homepage
 *
 * @see  nandotess_resume_homepage_content()
 * @see  nandotess_resume_homepage_widgets()
 */
add_action( 'nandotess_resume_homepage', 'nandotess_resume_homepage_content', 10 );
add_action( 'nandotess_resume_homepage', 'nandotess_resume_homepage_widgets', 20 );

/**
 * Footer
 *
 * @see  nandotess_resume_footer_nav_social()
 */
add_action( 'nandotess_resume_footer', 'nandotess_resume_footer_nav_social', 10 );
