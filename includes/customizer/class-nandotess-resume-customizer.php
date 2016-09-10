<?php
/**
 * nandotess's resume Customizer Class
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
			add_action( 'after_setup_theme',    array( $this, 'remove_custom_background' ) );
			add_action( 'wp_enqueue_scripts',   array( $this, 'add_inline_css' ), 130 );
			add_action( 'customize_register',   array( $this, 'customize_register' ) );
			
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
		 * Add CSS in <head> for styles handled by the theme customizer
		 * If the Customizer is active pull in the raw css. Otherwise pull in the prepared theme_mods if they exist
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function add_inline_css() {
			$nandotess_resume_styles = get_theme_mod( 'nandotess_resume_styles' );
			
			if ( is_customize_preview() || ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) || false === $nandotess_resume_styles ) {
				wp_add_inline_style( 'nandotess-resume-style', $this->get_css() );
			} else {
				wp_add_inline_style( 'nandotess-resume-style', $nandotess_resume_styles );
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
				'selector'              => '.section.about .section-title',
				'render_callback'       => function() {
					bloginfo( 'name' );
				},
			) );

			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector'              => '.section.about .section-description',
				'render_callback'       => function() {
					bloginfo( 'description' );
				},
			) );

			/**
			 * Background
			 */
			$wp_customize->add_section( 'nandotess_resume_background' , array(
				'title'      			=> __( 'Background', 'nandotess-resume' ),
				'priority'   			=> 25,
			) );

			/**
			 * Background: Background Color
			 */
			$wp_customize->add_setting( 'nandotess_resume_background_color', array(
				'default'           	=> '#e3e3e3',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nandotess_resume_background_color', array(
				'label'	   				=> __( 'Background color', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_background',
				'settings' 				=> 'nandotess_resume_background_color',
				'priority' 				=> 1,
			) ) );

			/**
			 * Contact details
			 */
			$wp_customize->add_section( 'nandotess_resume_contact_details' , array(
				'title'      			=> __( 'Contact Details', 'nandotess-resume' ),
				'priority'   			=> 26,
			) );

			/**
			 * Contact details: Background Color
			 */
			$wp_customize->add_setting( 'nandotess_resume_contact_details_background_color', array(
				'default'           	=> '#1e88e5',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nandotess_resume_contact_details_background_color', array(
				'label'	   				=> __( 'Background color', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_contact_details',
				'settings' 				=> 'nandotess_resume_contact_details_background_color',
				'priority' 				=> 1,
			) ) );

			/**
			 * Contact details: Text Color
			 */
			$wp_customize->add_setting( 'nandotess_resume_contact_details_text_color', array(
				'default'           	=> '#000000',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nandotess_resume_contact_details_text_color', array(
				'label'	   				=> __( 'Text color', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_contact_details',
				'settings' 				=> 'nandotess_resume_contact_details_text_color',
				'priority' 				=> 2,
			) ) );

			/**
			 * Contact details: Phone
			 */
			$wp_customize->add_setting( 'nandotess_resume_phone', array(
				'default'           	=> '+0000 0000 0000',
				'transport'          	=> 'postMessage',
			) );

			$wp_customize->add_control( 'nandotess_resume_phone', array(
				'label'	   				=> __( 'Phone', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_contact_details',
				'settings' 				=> 'nandotess_resume_phone',
				'priority' 				=> 3,
			) );

			$wp_customize->selective_refresh->add_partial( 'nandotess_resume_phone', array(
				'selector'              => '.navbar-contact-details .phone .text',
				'render_callback'       => function() {
					echo get_theme_mod( 'nandotess_resume_phone', '+0000 0000 0000' );
				},
			) );

			/**
			 * Contact details: Mail
			 */
			$wp_customize->add_setting( 'nandotess_resume_mail', array(
				'default'           	=> 'mail@mail.com',
				'transport'          	=> 'postMessage',
			) );

			$wp_customize->add_control( 'nandotess_resume_mail', array(
				'label'	   				=> __( 'Mail', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_contact_details',
				'settings' 				=> 'nandotess_resume_mail',
				'priority' 				=> 4,
			) );

			$wp_customize->selective_refresh->add_partial( 'nandotess_resume_mail', array(
				'selector'              => '.navbar-contact-details .mail .text',
				'render_callback'       => function() {
					echo get_theme_mod( 'nandotess_resume_mail', 'mail@mail.com' );
				},
			) );

			/**
			 * Main menu
			 */
			$wp_customize->add_section( 'nandotess_resume_main_menu' , array(
				'title'      			=> __( 'Main Menu', 'nandotess-resume' ),
				'priority'   			=> 27,
			) );

			/**
			 * Main menu: Background Color
			 */
			$wp_customize->add_setting( 'nandotess_resume_main_menu_background_color', array(
				'default'           	=> '#2196f3',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nandotess_resume_main_menu_background_color', array(
				'label'	   				=> __( 'Background color', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_main_menu',
				'settings' 				=> 'nandotess_resume_main_menu_background_color',
				'priority' 				=> 1,
			) ) );

			/**
			 * Main menu: Text Color
			 */
			$wp_customize->add_setting( 'nandotess_resume_main_menu_text_color', array(
				'default'           	=> '#ffffff',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nandotess_resume_main_menu_text_color', array(
				'label'	   				=> __( 'Text color', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_main_menu',
				'settings' 				=> 'nandotess_resume_main_menu_text_color',
				'priority' 				=> 2,
			) ) );

			/**
			 * Section About
			 */
			$wp_customize->add_section( 'nandotess_resume_section_about' , array(
				'title'      			=> __( 'Section About', 'nandotess-resume' ),
				'priority'   			=> 28,
			) );

			/**
			 * Section About: Background Color
			 */
			$wp_customize->add_setting( 'nandotess_resume_section_about_background_color', array(
				'default'           	=> '#ffffff',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nandotess_resume_section_about_background_color', array(
				'label'	   				=> __( 'Background color', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_section_about',
				'settings' 				=> 'nandotess_resume_section_about_background_color',
				'priority' 				=> 1,
			) ) );

			/**
			 * Section About: Text Color
			 */
			$wp_customize->add_setting( 'nandotess_resume_section_about_text_color', array(
				'default'           	=> '#646464',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nandotess_resume_section_about_text_color', array(
				'label'	   				=> __( 'Text color', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_section_about',
				'settings' 				=> 'nandotess_resume_section_about_text_color',
				'priority' 				=> 2,
			) ) );

			/**
			 * Section About: Link Color
			 */
			$wp_customize->add_setting( 'nandotess_resume_section_about_link_color', array(
				'default'           	=> '#2196f3',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nandotess_resume_section_about_link_color', array(
				'label'	   				=> __( 'Link color', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_section_about',
				'settings' 				=> 'nandotess_resume_section_about_link_color',
				'priority' 				=> 3,
			) ) );

			/**
			 * Social menu
			 */
			$wp_customize->add_section( 'nandotess_resume_social_men' , array(
				'title'      			=> __( 'Social Menu', 'nandotess-resume' ),
				'priority'   			=> 29,
			) );

			/**
			 * Social menu: Background Color
			 */
			$wp_customize->add_setting( 'nandotess_resume_social_menu_background_color', array(
				'default'           	=> '#ffffff',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nandotess_resume_social_menu_background_color', array(
				'label'	   				=> __( 'Background color', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_social_men',
				'settings' 				=> 'nandotess_resume_social_menu_background_color',
				'priority' 				=> 1,
			) ) );

			/**
			 * Social menu: Link Color
			 */
			$wp_customize->add_setting( 'nandotess_resume_social_menu_link_color', array(
				'default'           	=> '#2196f3',
				'sanitize_callback' 	=> 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nandotess_resume_social_menu_link_color', array(
				'label'	   				=> __( 'Link color', 'nandotess-resume' ),
				'section'  				=> 'nandotess_resume_social_men',
				'settings' 				=> 'nandotess_resume_social_menu_link_color',
				'priority' 				=> 2,
			) ) );
		}
		
		/**
		 * Assign styles to individual theme mods
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function set_theme_mod_style() {
			set_theme_mod( 'nandotess_resume_styles', $this->get_css() );
		}
		
		/**
		 * Get all of the theme mods
		 *
		 * @since  1.0.0
		 * @return array $theme_mods theme mods
		 */
		public function get_theme_mods() {
			return apply_filters( 'nandotess_resume_sass_variables', array(
				'screen-sm-min'                    => '768px',
				'screen-md-min'                    => '992px',
				'screen-lg-min'                    => '1200px',
				'background_color'                 => get_theme_mod( 'nandotess_resume_background_color' ),
				'contact_details_background_color' => get_theme_mod( 'nandotess_resume_contact_details_background_color' ),
				'contact_details_text_color'       => get_theme_mod( 'nandotess_resume_contact_details_text_color' ),
				'main_menu_background_color'       => get_theme_mod( 'nandotess_resume_main_menu_background_color' ),
				'main_menu_text_color'             => get_theme_mod( 'nandotess_resume_main_menu_text_color' ),
				'section_about_background_color'   => get_theme_mod( 'nandotess_resume_section_about_background_color' ),
				'section_about_text_color'         => get_theme_mod( 'nandotess_resume_section_about_text_color' ),
				'section_about_link_color'         => get_theme_mod( 'nandotess_resume_section_about_link_color' ),
				'social_menu_background_color'     => get_theme_mod( 'nandotess_resume_social_menu_background_color' ),
				'social_menu_link_color'           => get_theme_mod( 'nandotess_resume_social_menu_link_color' ),
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
			$scss_file = get_template_directory() .'/assets/css/scss/nandotess-resume-customizer.scss';
			$css = '';

			if ( file_exists( $scss_file ) ) {
				if ( empty( $wp_filesystem ) ) {
					require_once( ABSPATH .'/wp-admin/includes/file.php' );
					WP_Filesystem();
				}

				if ( $wp_filesystem ) {
					$scss = apply_filters( 'nandotess_resume_sass_content', $wp_filesystem->get_contents( $scss_file ) );
					$scssphp_file = get_template_directory() .'/vendor/leafo/scssphp/scss.inc.php';

					if ( ! empty( $scss ) && file_exists( $scssphp_file ) ) {
						require_once $scssphp_file;
			
						$compiler = new \Leafo\ScssPhp\Compiler();
						$compiler->setFormatter( 'Leafo\ScssPhp\Formatter\Compact' );
						$compiler->setVariables( $theme_mods );

						try {
							$css = $compiler->compile( $scss );
						} catch ( Exception $e ) {
							$error = $e->getMessage();
							return "/* {$error} */";
						}
					}
				}
			}

			return $css;
		}

	}

endif;

return new NandotessResume_Customizer();
