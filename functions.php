<?php
/**
 * Better Order Project Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package quincy/bop
 */
namespace Quincy\bop;

use function Quincy_Institute\get_root_ancestor_id;
use function Quincy_Institute\get_page_list;
use function Quincy_Institute\print_section_navigation;
use function Quincy_Institute\get_author_excerpt;
use function Quincy_Institute\get_post_content;

require_once get_stylesheet_directory() . '/inc/customizer/customizer.php';

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

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 88,
			'width'       => 198,
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
	// wp_enqueue_style( 'quincy-institute-style', get_template_directory_uri() . '/build/index.css' );

	wp_enqueue_style(
		'bop-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'quincy-styles' )
	);
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_styles' );

/**
 * Register Styles
 *
 * @return void
 */
function register_block_styles() {
	register_block_style(
		'core/table',
		array(
			'name'  => 'diagram',
			'label' => __( 'Diagram', 'quincy' ),
		)
	);
	register_block_style(
		'core/columns',
		array(
			'name'  => 'diagram',
			'label' => __( 'Diagram', 'quincy' ),
		)
	);
	register_block_style(
		'core/separator',
		array(
			'name'  => 'red',
			'label' => __( 'Wide Red', 'quincy' ),
		)
	);
	register_block_style(
		'core/list',
		array(
			'name'  => 'alpha',
			'label' => __( 'Alpha Bullets', 'quincy' ),
		)
	);
	register_block_style(
		'core/heading',
		array(
			'name'  => 'chart-heading',
			'label' => __( 'Chart Heading', 'quincy' ),
		)
	);
}
add_action( 'init', __NAMESPACE__ . '\register_block_styles', 99 );

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

	$instance = \WP_Block_Patterns_Registry::get_instance();

	foreach ( $patterns as $pattern ) {
		if ( $instance->is_registered( $pattern ) ) {
			unregister_block_pattern( $pattern );
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\unregister_patterns' );

/**
 * Unregister content types
 *
 * @return void
 */
function unregister_content_types() {
	$disabled_post_types = array(
		'research',
		'program',
		'book',
		'theme',
		'collection',
	);
	$disabled_taxonomies = array(
		'entitiy',
		'article_type',
		'research_type',
		'people',
		'region',
	);
	foreach ( $disabled_post_types as $post_type ) {
		unregister_post_type( $post_type );
	}

	foreach ( $disabled_taxonomies as $taxonomy ) {
		unregister_taxonomy( $taxonomy );
	}
}

/**
 * Disable parent actions
 *
 * @return void
 */
function disable_features() {
	remove_action( 'site_header_after', 'Quincy_Institute\section_navigation', 10 );
	remove_filter( 'the_title', 'Quincy_Institute\filter_page_list_label', 10 );
	unregister_content_types();
}
add_action( 'init', __NAMESPACE__ . '\disable_features', 10 );

/**
 * Override menu label
 *
 * @param  string $default_label
 * @param  int    $post_id
 * @return void
 */
function get_menu_label( $default_label, $post_id ) {
	$default_label            = get_post_field( 'post_title', $post_id );
	$section_navigation_label = get_post_meta( $post_id, 'section_navigation_label', true );
	return $section_navigation_label ? $section_navigation_label : $default_label;
}
add_filter( 'Quincy_Institute/get_menu_label', __NAMESPACE__ . '\get_menu_label', 10, 2 );

/**
 * Override author expert length
 *
 * @param  string $excerpt
 * @param  string $raw_bio
 * @param  int    $post_id
 * @return string
 */
function author_excerpt( $excerpt, $raw_bio, $post_id ) {
	$excerpt = wp_trim_words( $raw_bio, 150 );
	return $excerpt;
}
add_filter( 'Quincy_Institute/author_excerpt', __NAMESPACE__ . '\author_excerpt', 10, 3 );

/**
 * Render User Excerpt
 *
 * @param  int $post_id
 * @return void
 */
function print_author_excerpt( $post_id = 0 ) : void {
	global $post;
	$post_id = ( $post_id ) ? (int) $post_id : get_the_ID();
	if ( ( $bio = get_author_excerpt( $post_id ) ) && ! is_wp_error( $bio ) && 'string' == gettype( $bio ) ) :
		?>
		<div class="post-excerpt">
			<?php echo apply_filters( 'the_excerpt', $bio ); ?>
		</div><!-- .post-excerpt -->
		<?php
	endif;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @link https://developer.wordpress.org/reference/hooks/body_class/
 *
 * @param array $classes Classes for the body element.
 * @return array Body classes.
 */
function body_classes( $classes ) {
	$classes[] = 'bop better-order-project';

	if ( is_page_template( 'page-templates/category-page.php' ) ) {
		$classes[] = 'single-research';
	}

	$display = get_post_meta( get_the_ID(), 'display_section_navigation', true );
	if ( ! $display ) {
		unset( $classes[ array_search( 'has-section-navigation', $classes ) ] );
	}

	return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\body_classes' );

/**
 * Add section navigation
 *
 * @return void
 */
function sub_navigation(): void {
	if ( is_front_page() || is_home() ) {
		return;
	}

	$display = get_post_meta( get_the_ID(), 'display_section_navigation', true );
	if ( ! $display ) {
		return;
	}
	?>
	<div id="site-utilities" class="site-utilities-container">
		<?php print_section_navigation(); ?>
	</div>
	<!-- site-utilities-container -->
	<?php
}
add_action( 'site_header_after', __NAMESPACE__ . '\sub_navigation', 10 );

/**
 * Print the site footer
 *
 * @return void
 */
function print_copyright_text(): void {
	$copyright_text = get_theme_mod( 'copyright_text' );

	if ( $copyright_text ) {
		echo get_post_content( do_shortcode( $copyright_text ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- XSS OK.
	} else {
		echo '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' );
	}
}
