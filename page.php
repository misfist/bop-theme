<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package quincy
 */

use function Quincy_Institute\main_classes;

get_header(); ?>

	<main id="main" class="<?php echo esc_attr( main_classes( array() ) ); ?>">

		<?php do_action( 'main_open_after' ); ?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php get_footer(); ?>
