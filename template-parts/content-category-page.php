<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package quincy/bop
 */

use function Quincy_Institute\print_subtitle;
use function Quincy_Institute\print_post_date;
use function Quincy_Institute\print_post_author;
use function Quincy_Institute\print_post_footer;
use function Quincy_Institute\print_post_taxonomies;
use function Quincy_Institute\has_toc;
use function Quincy_Institute\print_download_button;
use function Quincy_Institute\print_share_links;
use function Quincy_Institute\print_toc;
?>

<article <?php post_class( 'post-container' ); ?>>

	<?php get_template_part( 'template-parts/components/entry-header', get_post_type() ); ?>

	<div class="post-content">
		<?php get_sidebar( 'toc' ); ?>

		<div id="post-content-body" class="post-content__inner">

			<?php
			$hide_title = get_post_meta( get_the_ID(), 'hide_page_title', true );
			if( ! $hide_title ) :
				?>
				<header class="post-header <?php echo get_post_type() . '-header'; ?>">

					<?php do_action( 'post_title_before' ); ?>

					<?php the_title( '<h1 class="post-title single-title">', '</h1>' ); ?>

					<div id="mobile-sidebar" class="mobile-only mobile-sidebar">
						<?php print_download_button(); ?>
						<?php print_toc(); ?>
						<?php print_share_links(); ?>
					</div>

				</header><!-- .post-header -->
				<?php 
			endif; ?>
			
			<div class="post-body">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. */
							esc_html__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'quincy' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					)
				);
				?>
			</div><!-- .post-body -->

		</div><!-- .post-content__inner -->
	</div><!-- .post-content -->

	<footer class="post-footer">
		<?php print_post_footer(); ?>
	</footer><!-- .postfooter -->

</article><!-- #post-## -->
