<?php
/**
 * Better Order Project Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bop
 */
namespace Quincy\bop;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function setup() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wd_s, refer to the
	 * README.md file in this theme to find and replace all
	 * references of wd_s
	 */
	load_theme_textdomain( 'bop', get_stylesheet_directory() . '/build/languages' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary'  => esc_html__( 'Primary Menu', 'quincy' ),
			'footer'   => esc_html__( 'Footer Menu', 'quincy' ),
			'mobile'   => esc_html__( 'Mobile Menu', 'quincy' ),
			'footer-2' => esc_html__( 'Tertiary Footer Menu', 'quincy' ),
			'privacy'  => esc_html__( 'Privacy Menu', 'quincy' ),
		)
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 72,
			'width'       => 162,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);

	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\setup' );

/**
 * Enqueue scripts and styles.
 *
 * @link https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 */
function enqueue_styles() {
	wp_enqueue_style( 'quincy-institute-style', get_template_directory_uri() . '/build/index.css' );

	wp_enqueue_style(
		'bop-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'quincy-institute-style' )
	);
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_styles' );

/**
 * Unregister block patterns.
 *
 * @link https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/#unregistering-block-patterns
 *
 * @return void
 */
function unregister_patterns() {
	$patterns = array(
		'quincy/advocacy-documents',
		'quincy/advocacy-events',
		'quincy/advocacy-documents',
		'quincy/advocacy-events',
		'quincy/book-meta',
		'quincy/donate-banner',
		'quincy/facets-events',
		'quincy/facets-pagination',
		'quincy/facets-posts',
		'quincy/facets',
		'quincy/featured-post',
		'quincy/newsletter-signup',
		'quincy/post-row',
		'quincy/posts-facets',
		'quincy/program-landing',
		'quincy/program',
		'quincy/research',
		'quincy/section-articles',
		'quincy/section-authors',
		'quincy/section-events',
		'quincy/section-research',
		// 'quincy/share-links',
		// 'quincy/social-icons',
		// 'quincy/toc',
	);
	foreach ( $patterns as $pattern ) {
		unregister_block_pattern( $pattern );
	}

	remove_action( 'site_header_after', 'Quincy_Institute\section_navigation', 10 );

}
add_action( 'init', __NAMESPACE__ . '\unregister_patterns' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @author WebDevStudios
 *
 * @param array $classes Classes for the body element.
 *
 * @return array Body classes.
 */
function body_classes( $classes ) {
	$classes[] = 'bop better-order-project';

	if ( is_page_template( 'page-templates/category-page.php' ) ) {
		$classes[] = 'single-research';
	}

	return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\body_classes' );

/**
 * Register ACF fields
 *
 * @link https://www.advancedcustomfields.com/resources/register-fields-via-php/
 *
 * @return void
 */
function register_fields(): void {
	$args = array(
		'key'                   => 'group_details',
		'title'                 => __( 'Details', 'site-functionality' ),
		'fields'                => array(
			array(
				'key'               => 'field_download_file',
				'label'             => __( 'Downloadable File', 'site-functionality' ),
				'name'              => 'download_file',
				'aria-label'        => '',
				'type'              => 'file',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'return_format'     => 'id',
				'library'           => 'all',
				'min_size'          => '',
				'max_size'          => '',
				'mime_types'        => '',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'side',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
		'show_in_rest'          => 1,
	);

	\acf_add_local_field_group( $args );
}
\add_action( 'acf/init', __NAMESPACE__ . '\register_fields' );
