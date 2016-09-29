<?php
/**
 * Customizer Class
 *
 * @author   Fernando Tessmann
 * @since    1.0.0
 * @package  nandotess-resume
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'NandotessResume_Customizer' ) ) :

	/**
	 * The nandotess's resume Customizer class
	 */
	class NandotessResume_Customizer {

		/**
		 * Setup class
		 */
		public function __construct() {
			add_action( 'after_setup_theme',  array( $this, 'remove_custom_background' ) );
			add_action( 'wp_footer',          array( $this, 'add_inline_css' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );

			add_action( 'after_switch_theme',   array( $this, 'set_theme_mod_style' ) );
			add_action( 'customize_save_after', array( $this, 'set_theme_mod_style' ) );
		}

		/**
		 * Remove custom WordPress background
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function remove_custom_background() {
			remove_custom_background();
		}

		/**
		 * Add CSS in footer for styles handled by the theme customizer
		 * If the Customizer is active pull in the raw css. Otherwise pull in the prepared theme_mods if they exist
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function add_inline_css() {
			wp_enqueue_style( 'nandotess-resume-customizer', get_stylesheet_uri() );
			$styles = get_theme_mod( 'nr_styles' );

			if ( is_customize_preview() || ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) || false === $styles ) {
				wp_add_inline_style( 'nandotess-resume-customizer', $this->get_css() );
			} else {
				wp_add_inline_style( 'nandotess-resume-customizer', $styles );
			}
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer along with several other settings
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object
		 * @since  1.0.0
		 * @return void
		 */
		public function customize_register( $wp_customize ) {
			/**
			 * Title and Description
			 */
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector'          => '.section.about .title',
				'render_callback'   => function() {
					bloginfo( 'name' );
				},
			) );

			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector'          => '.section.about .description',
				'render_callback'   => function() {
					bloginfo( 'description' );
				},
			) );

			/**
			 * Background
			 */
			$wp_customize->add_section( 'nr_background' , array(
				'title'             => esc_html__( 'Background', 'nandotess-resume' ),
				'priority'          => 25,
			) );

			/**
			 * Background: Background Color
			 */
			$wp_customize->add_setting( 'nr_background_color', array(
				'default'           => '#e3e3e3',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_background_color', array(
				'label'             => esc_html__( 'Background color', 'nandotess-resume' ),
				'section'           => 'nr_background',
				'settings'          => 'nr_background_color',
				'priority'          => 1,
			) ) );

			/**
			 * Contact Details
			 */
			$wp_customize->add_section( 'nr_contact_details' , array(
				'title'             => esc_html__( 'Contact Details', 'nandotess-resume' ),
				'priority'          => 26,
			) );

			/**
			 * Contact Details: Background Color
			 */
			$wp_customize->add_setting( 'nr_contact_details_background_color', array(
				'default'           => '#1e88e5',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_contact_details_background_color', array(
				'label'             => esc_html__( 'Background color', 'nandotess-resume' ),
				'section'           => 'nr_contact_details',
				'settings'          => 'nr_contact_details_background_color',
				'priority'          => 1,
			) ) );

			/**
			 * Contact Details: Text Color
			 */
			$wp_customize->add_setting( 'nr_contact_details_text_color', array(
				'default'           => '#000000',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_contact_details_text_color', array(
				'label'             => esc_html__( 'Text color', 'nandotess-resume' ),
				'section'           => 'nr_contact_details',
				'settings'          => 'nr_contact_details_text_color',
				'priority'          => 2,
			) ) );

			/**
			 * Contact Details: Phone
			 */
			$wp_customize->add_setting( 'nr_phone', array(
				'default'           => '+0000 0000 0000',
				'transport'         => 'postMessage',
			) );

			$wp_customize->add_control( 'nr_phone', array(
				'label'             => esc_html__( 'Phone', 'nandotess-resume' ),
				'section'           => 'nr_contact_details',
				'settings'          => 'nr_phone',
				'priority'          => 3,
			) );

			$wp_customize->selective_refresh->add_partial( 'nr_phone', array(
				'selector'          => '.navbar-contact-details .phone .text',
				'render_callback'   => function() {
					echo esc_html( get_theme_mod( 'nr_phone', '+0000 0000 0000' ) );
				},
			) );

			/**
			 * Contact Details: Mail
			 */
			$wp_customize->add_setting( 'nr_mail', array(
				'default'           => 'mail@mail.com',
				'transport'         => 'postMessage',
			) );

			$wp_customize->add_control( 'nr_mail', array(
				'label'             => esc_html__( 'Mail', 'nandotess-resume' ),
				'section'           => 'nr_contact_details',
				'settings'          => 'nr_mail',
				'priority'          => 4,
			) );

			$wp_customize->selective_refresh->add_partial( 'nr_mail', array(
				'selector'          => '.navbar-contact-details .mail .text',
				'render_callback'   => function() {
					echo esc_html( get_theme_mod( 'nr_mail', 'mail@mail.com' ) );
				},
			) );

			/**
			 * Main Menu
			 */
			$wp_customize->add_section( 'nr_main_menu' , array(
				'title'             => esc_html__( 'Main Menu', 'nandotess-resume' ),
				'priority'          => 27,
			) );

			/**
			 * Main Menu: Background Color
			 */
			$wp_customize->add_setting( 'nr_main_menu_background_color', array(
				'default'           => '#2196f3',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_main_menu_background_color', array(
				'label'             => esc_html__( 'Background color', 'nandotess-resume' ),
				'section'           => 'nr_main_menu',
				'settings'          => 'nr_main_menu_background_color',
				'priority'          => 1,
			) ) );

			/**
			 * Main Menu: Text Color
			 */
			$wp_customize->add_setting( 'nr_main_menu_text_color', array(
				'default'           => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_main_menu_text_color', array(
				'label'             => esc_html__( 'Text color', 'nandotess-resume' ),
				'section'           => 'nr_main_menu',
				'settings'          => 'nr_main_menu_text_color',
				'priority'          => 2,
			) ) );

			/**
			 * Section About
			 */
			$wp_customize->add_section( 'nr_section_about' , array(
				'title'             => esc_html__( 'Section About', 'nandotess-resume' ),
				'priority'          => 28,
			) );

			/**
			 * Section About: Background Color
			 */
			$wp_customize->add_setting( 'nr_section_about_background_color', array(
				'default'           => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_section_about_background_color', array(
				'label'             => esc_html__( 'Background color', 'nandotess-resume' ),
				'section'           => 'nr_section_about',
				'settings'          => 'nr_section_about_background_color',
				'priority'          => 1,
			) ) );

			/**
			 * Section About: Title Color
			 */
			$wp_customize->add_setting( 'nr_section_about_title_color', array(
				'default'           => '#5f5f5f',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_section_about_title_color', array(
				'label'             => esc_html__( 'Title color', 'nandotess-resume' ),
				'section'           => 'nr_section_about',
				'settings'          => 'nr_section_about_title_color',
				'priority'          => 2,
			) ) );

			/**
			 * Section About: Text Color
			 */
			$wp_customize->add_setting( 'nr_section_about_text_color', array(
				'default'           => '#727272',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_section_about_text_color', array(
				'label'             => esc_html__( 'Text color', 'nandotess-resume' ),
				'section'           => 'nr_section_about',
				'settings'          => 'nr_section_about_text_color',
				'priority'          => 3,
			) ) );

			/**
			 * Section About: Link Color
			 */
			$wp_customize->add_setting( 'nr_section_about_link_color', array(
				'default'           => '#2196f3',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_section_about_link_color', array(
				'label'             => esc_html__( 'Link color', 'nandotess-resume' ),
				'section'           => 'nr_section_about',
				'settings'          => 'nr_section_about_link_color',
				'priority'          => 4,
			) ) );

			/**
			 * Social Menu
			 */
			$wp_customize->add_section( 'nr_social_men' , array(
				'title'             => esc_html__( 'Social Menu', 'nandotess-resume' ),
				'priority'          => 29,
			) );

			/**
			 * Social Menu: Background Color
			 */
			$wp_customize->add_setting( 'nr_social_menu_background_color', array(
				'default'           => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_social_menu_background_color', array(
				'label'             => esc_html__( 'Background color', 'nandotess-resume' ),
				'section'           => 'nr_social_men',
				'settings'          => 'nr_social_menu_background_color',
				'priority'          => 1,
			) ) );

			/**
			 * Social Menu: Link Color
			 */
			$wp_customize->add_setting( 'nr_social_menu_link_color', array(
				'default'           => '#2196f3',
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nr_social_menu_link_color', array(
				'label'             => esc_html__( 'Link color', 'nandotess-resume' ),
				'section'           => 'nr_social_men',
				'settings'          => 'nr_social_menu_link_color',
				'priority'          => 2,
			) ) );
		}

		/**
		 * Assign styles to individual theme mods
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function set_theme_mod_style() {
			set_theme_mod( 'nr_styles', $this->get_css() );
		}

		/**
		 * Get all of the theme mods
		 *
		 * @since  1.0.0
		 * @return array $theme_mods theme mods
		 */
		public function get_theme_mods() {
			return apply_filters( 'nr_sass_variables', array(
				'screen-sm-min'                    => '768px',
				'screen-md-min'                    => '992px',
				'screen-lg-min'                    => '1200px',

				'background_color'                 => get_theme_mod( 'nr_background_color', '#e3e3e3' ),

				'contact_details_background_color' => get_theme_mod( 'nr_contact_details_background_color', '#1e88e5' ),
				'contact_details_text_color'       => get_theme_mod( 'nr_contact_details_text_color', '#000000' ),

				'main_menu_background_color'       => get_theme_mod( 'nr_main_menu_background_color', '#2196f3' ),
				'main_menu_text_color'             => get_theme_mod( 'nr_main_menu_text_color', '#ffffff' ),

				'section_about_background_color'   => get_theme_mod( 'nr_section_about_background_color', '#ffffff' ),
				'section_about_title_color'        => get_theme_mod( 'nr_section_about_title_color', '#5f5f5f' ),
				'section_about_text_color'         => get_theme_mod( 'nr_section_about_text_color', '#727272' ),
				'section_about_link_color'         => get_theme_mod( 'nr_section_about_link_color', '#2196f3' ),

				'social_menu_background_color'     => get_theme_mod( 'nr_social_menu_background_color', '#ffffff' ),
				'social_menu_link_color'           => get_theme_mod( 'nr_social_menu_link_color', '#2196f3' ),
			) );
		}

		/**
		 * Get Customizer css
		 *
		 * @since  1.0.0
		 * @see get_theme_mods()
		 * @return string $css the css
		 */
		public function get_css() {
			global $wp_filesystem;

			$theme_mods = $this->get_theme_mods();
			$scss_file = get_template_directory() . '/assets/css/scss/nandotess-resume-customizer.scss';
			$css = '';

			if ( file_exists( $scss_file ) ) {
				if ( empty( $wp_filesystem ) ) {
					require_once( ABSPATH . '/wp-admin/includes/file.php' );
					WP_Filesystem();
				}

				if ( $wp_filesystem ) {
					$scss = apply_filters( 'nr_sass_content', $wp_filesystem->get_contents( $scss_file ) );
					$scssphp_file = get_template_directory() . '/vendor/leafo/scssphp/scss.inc.php';

					if ( ! empty( $scss ) && file_exists( $scssphp_file ) ) {
						require_once $scssphp_file;

						$compiler = new \Leafo\ScssPhp\Compiler();
						$compiler->setFormatter( 'Leafo\ScssPhp\Formatter\Compact' );
						$compiler->setVariables( $theme_mods );

						try {
							$css = $compiler->compile( $scss );
						} catch ( Exception $e ) {
							$error = $e->getMessage();
							return "/*\n\n\$error:\n\n{$error}\n\n\$theme_mods:\n\n" . var_export( $theme_mods, true ) . "\n\n\$scss:\n\n{$scss} */";
						}
					}
				}
			}

			return $css;
		}

	}

endif;

return new NandotessResume_Customizer();
