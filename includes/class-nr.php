<?php
/**
 * nandotess's resume Class
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
	 * The main nandotess's resume class
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
			add_action( 'widgets_init',       array( $this, 'widgets_init' ) );
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

			add_theme_support( 'title-tag' );
			add_theme_support( 'post-thumbnails' );
			
			register_nav_menus( array(
				'primary' => esc_html__( 'Primary', 'nandotess-resume' ),
				'social'  => esc_html__( 'Social', 'nandotess-resume' ),
			) );
		}

		/**
		 * Register widget area
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function widgets_init() {
			$sidebar_args['homepage'] = array(
				'name'        => esc_html__( 'Homepage', 'nandotess-resume' ),
				'id'          => 'homepage-sidebar',
				'description' => esc_html__( 'Add homepage widgets here.', 'nandotess-resume' ),
			);

			foreach ( $sidebar_args as $sidebar => $args ) {
				$widget_tags = array(
					'before_widget' => '<div class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h2 class="title">',
					'after_title'   => '</h2>'
				);

				register_sidebar( $args + $widget_tags );
			}
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
