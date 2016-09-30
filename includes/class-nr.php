<?php
/**
 * Main Class
 *
 * @author   Fernando Tessmann
 * @since    1.0.0
 * @package  nandotess-resume
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NandotessResume' ) ) :

	/**
	 * Main Class
	 */
	class NandotessResume {

		/**
		 * Setup class
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function __construct() {
			add_action( 'after_setup_theme',  array( $this, 'setup' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 10 );
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function setup() {
			load_theme_textdomain( 'nandotess-resume', get_template_directory() . '/languages' );

			//add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'title-tag' );

			register_nav_menus( array(
				'primary' => esc_html__( 'Primary', 'nandotess-resume' ),
				'social'  => esc_html__( 'Social', 'nandotess-resume' ),
			) );
		}

		/**
		 * Enqueue scripts and styles
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function scripts() {
			global $theme_version;

			wp_enqueue_style( 'nandotess-resume-style', get_template_directory_uri() . '/assets/css/nandotess-resume.css', array(), $theme_version, 'all' );
			wp_enqueue_script( 'nandotess-resume-script', get_template_directory_uri() . '/assets/js/nandotess-resume.min.js', array( 'jquery' ), $theme_version, true );
		}

	}

endif;

return new NandotessResume();
