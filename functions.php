<?php
/**
 * Disneyland
 *
 * @author   Fernando Tessmann
 * @since    1.0.0
 * @package  nandotess-resume
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme version
 */
$theme                    = wp_get_theme( 'nandotess-resume' );
$nandotess_resume_version = $theme['Version'];

/**
 * Content width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1280; /* pixels */
}

/**
 * Where Dreams Come True
 */
$nandotess_resume = (object) array(
	'version' => $nandotess_resume_version,
	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-nandotess-resume.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'includes/nandotess-resume-template-hooks.php';
require 'includes/nandotess-resume-template-functions.php';
