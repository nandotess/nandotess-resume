<?php
/**
 * nandotess's resume Class
 *
 * @package nandotess-resume
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NandotessResume' ) ) :
	
	/**
	 * The main NandotessResume class
	 */
	class NandotessResume {
		
		private static $structured_data;
		
		/**
		 * Setup class.
		 */
		public function __construct() {
			add_action( 'after_setup_theme',  array( $this, 'setup' ) );
			add_action( 'widgets_init',       array( $this, 'widgets_init' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ),       10 );
			//add_action( 'wp_footer',                  array( $this, 'get_structured_data' ) );
		}
		
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 */
		public function setup() {
			load_theme_textdomain( 'nandotess-resume', get_template_directory() . '/languages' );

			add_theme_support( 'title-tag' );
			add_theme_support( 'post-thumbnails' );
			
			register_nav_menus( array(
				'primary' => __( 'Primary', 'nandotess-resume' ),
			) );
		}

		/**
		 * Register widget area.
		 */
		public function widgets_init() {
			$sidebar_args['homepage'] = array(
				'name'        => __( 'Homepage', 'nandotess-resume' ),
				'id'          => 'homepage-sidebar',
				'description' => __( 'Add homepage widgets here.', 'nandotess-resume' ),
			);

			foreach ( $sidebar_args as $sidebar => $args ) {
				$widget_tags = array(
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<span class="gamma widget-title">',
					'after_title'   => '</span>'
				);

				register_sidebar( $args + $widget_tags );
			}
		}

		/**
		 * Enqueue scripts and styles.
		 */
		public function scripts() {
			wp_enqueue_style( 'nandotess-resume-style', get_template_directory_uri() . '/assets/css/style.css', array(), NANDOTESS_RESUME_VERSION );
			wp_style_add_data( 'nandotess-resume-style', 'rtl', 'replace' );
			
			wp_enqueue_script( 'nandotess-resume-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array(), NANDOTESS_RESUME_VERSION, true );
			wp_enqueue_script( 'nandotess-resume-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), NANDOTESS_RESUME_VERSION, true );
		}

		/**
		 * Check if the passed $json variable is an array and store it into the property...
		 */
		/*public static function set_structured_data( $json ) {
			if ( ! is_array( $json ) ) {
				return;
			}

			self::$structured_data[] = $json;
		}*/

		/**
		 * If self::$structured_data is set, wrap and echo it...
		 * Hooked into the `wp_footer` action.
		 */
		/*public function get_structured_data() {
			if ( ! self::$structured_data ) {
				return;
			}
			
			$structured_data['@context'] = 'http://schema.org/';
			
			if ( count( self::$structured_data ) > 1 ) {
				$structured_data['@graph'] = self::$structured_data;
			} else {
				$structured_data = $structured_data + self::$structured_data[0];
			}

			$structured_data = $this->sanitize_structured_data( $structured_data );
			echo '<script type="application/ld+json">' . wp_json_encode( $structured_data ) . '</script>';
		}*/

		/**
		 * Sanitize structured data.
		 *
		 * @param  array $data
		 * @return array
		 */
		/*public function sanitize_structured_data( $data ) {
			$sanitized = array();
			
			foreach ( $data as $key => $value ) {
				if ( is_array( $value ) ) {
					$sanitized_value = $this->sanitize_structured_data( $value );
				} else {
					$sanitized_value = sanitize_text_field( $value );
				}

				$sanitized[ sanitize_text_field( $key ) ] = $sanitized_value;
			}

			return $sanitized;
		}*/

	}

endif;

return new NandotessResume();
