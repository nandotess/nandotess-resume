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
	'main'       => require 'includes/class-nandotess-resume.php',
	'customizer' => require 'includes/customizer/class-nandotess-resume-customizer.php',
);

require 'includes/template-hooks.php';
require 'includes/template-functions.php';
