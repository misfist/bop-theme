<?php
/**
 * Template part for displaying guest author.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package quincy/bop
 */
use function Quincy_Institute\get_author_avatar;
use function Quincy_Institute\get_author_url;
use function Quincy_Institute\get_author_website_url;
use function Quincy_Institute\print_author_website_link;
use function Quincy_Institute\print_author_link;
use function Quincy_Institute\print_author_social_network_links;
use function Quincy_Institute\print_author_title;
use function Quincy_Institute\print_author_excerpt;
$post_id = ( $args && isset( $args['post_id'] ) ) ? (int) $args['post_id'] : get_the_ID();
$link    = ( $args && isset( $args['link_name'] ) ) ? esc_attr( $args['link_name'] ) : null;
$url     = ( 'website' === $link ) ? get_author_website_url( $post_id ) : get_author_url( $post_id );
?>

<article <?php post_class( 'type-user type-guest-author post' ); ?>>
	<div class="post-top">
		<?php
		$size = 262;
		if ( $avatar = get_author_avatar( $post_id, $size ) ) :
			?>
			<figure class="post-image">
				<?php
				if ( ( 'website' === $link || 'profile' === $link ) && $url ) :
					printf(
						'<a href="%1$s" title="%2$s" class="%3$s" rel="%4$s" %5$s>',
						esc_url( $url ),
						esc_attr( sprintf( __( 'Visit %s&#8217;s website', 'bop' ), esc_attr( esc_html( get_the_author() ) ) ) ),
						esc_attr( 'author url fn' ),
						esc_attr( 'author' ),
						( 'website' === $link ) ? ' target="_blank" rel="noopener"' : ''
					);
					?>
					<?php
				endif;
				?>
					<?php echo $avatar; ?>
					<?php
					if ( 'website' === $link || 'profile' === $link ) :
						?>
					</a>
						<?php
				endif;
					?>
			</figure>
			<?php
		endif;
		?>

		<header class="post-header <?php echo get_post_type( $post_id ) . '-header'; ?>">

			<?php do_action( 'post_title_before' ); ?>
	
			<h2 class="post-title expert-name no-embellishment">
				<?php
				if( 'profile' === $link && $url ) {
					print_author_link( $post_id );
				}elseif ( 'website' === $link && $url ) {
					print_author_website_link( $post_id );
				} else {
					the_title();
				}
				?>
			</h2>

			<?php
			$title = get_post_meta( $post_id, 'expert_title', true );
			if( $title ) :
				?>
				<div class="post-author-title author-type"><?php echo esc_html( $title ); ?></div>
				<?php
			endif;
			?>
			
		</header><!-- .post-header -->

	</div><!-- .post-top -->
	
	<div class="post-social">
		<?php print_author_social_network_links( $post_id ); ?>
	</div><!-- .post-social" -->

	<?php print_author_excerpt( $post_id ); ?>

</article><!-- #post-## -->
