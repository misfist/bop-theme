<?php
/**
 * Template Name: Category Page
 * Template Post Type: page
 *
 * @package bop
 */

use function Quincy_Institute\main_classes;

get_header(); ?>

	<main id="main" class="<?php echo esc_attr( main_classes( array() ) ); ?>">

		<?php do_action( 'main_open_after' ); ?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'category-page' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php get_footer(); ?>
