<?php
/**
 * Engine room
 *
 * @package nandotess-resume
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme version
 */
$theme = wp_get_theme( 'nandotess-resume' );
define( 'NANDOTESS_RESUME_VERSION', $theme['Version'] );

/**
 * Content width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1280; /* pixels */
}

/**
 * Where Dreams Come True
 */
require 'includes/class-nandotess-resume.php';
require 'includes/customizer/class-nandotess-resume-customizer.php';
//require 'includes/nandotess-resume-functions.php';
//require 'includes/nandotess-resume-template-hooks.php';
//require 'includes/nandotess-resume-template-functions.php';

//if ( is_admin() ) {
//	require 'includes/admin/class-nandotess-resume-admin.php';
//}
