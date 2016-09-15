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
$theme         = wp_get_theme( 'nandotess-resume' );
$theme_version = $theme['Version'];

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
	'version'    => $theme_version,
	'main'       => require 'includes/class-nr.php',
	'customizer' => require 'includes/customizer/class-nr-customizer.php',
);

require 'includes/nr-template-hooks.php';
require 'includes/nr-template-functions.php';
