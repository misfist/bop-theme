<?php
/**
 * Customizer settings.
 *
 * @package quincy
 */

namespace Quincy_Institute;

/**
 * Register copyright text setting.
 *
 * @author WebDevStudios
 *
 * @param WP_Customize_Manager $wp_customize Instance of WP_Customize_Manager.
 */
function customize_copyright_text( $wp_customize ) {
	// Register a setting.
	$wp_customize->add_setting(
		'copyright_text',
		array(
			'default'           => __( "© [copyright-year] Better Order Project, A Quincy Institute Initiative", 'bop' ),
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	// Create the setting field.
	$wp_customize->add_control(
		'copyright_text',
		array(
			'label'       => esc_attr__( 'Copyright Text', 'bop' ),
			'description' => esc_attr__( 'The copyright text will be displayed in the footer. Basic HTML tags allowed.', 'bop' ),
			'section'     => 'title_tagline',
			'type'        => 'textarea',
			'input_attrs' => array(
				'placeholder' => __( '© 2024 Better Order Project, A Quincy Institute Initiative', 'bop' ),
			),
		)
	);
}
add_action( 'customize_register', __NAMESPACE__ . '\customize_copyright_text' );
