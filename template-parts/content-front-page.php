<?php
/**
 * Template part for displaying page content in front-page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package quincy/bop
 */

?>

<div class="front-page-content">

	<div class="front-page-content__inner">
		<header class="page-header print-only">
			
			<?php do_action( 'post_title_before' ); ?>

			<?php the_title( '<h1 class="page-title front-page-title">', '</h1>' ); ?>

			<?php do_action( 'post_title_after' ); ?>

		</header><!-- .post-header -->

		<?php the_content(); ?>
	</div><!-- .post-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="post-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'quincy' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .post-footer -->
	<?php endif; ?>

</div><!-- #post-## -->
