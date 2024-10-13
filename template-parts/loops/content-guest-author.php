<?php
/**
 * Template part for displaying guest author.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package quincy/bop
 */
use function Quincy_Institute\get_author_avatar;
use function Quincy_Institute\get_author_link;
use function Quincy_Institute\print_author_website_link;
use function Quincy_Institute\print_author_link;
use function Quincy_Institute\print_author_social_network_links;
use function Quincy_Institute\print_author_title;
use function Quincy_Institute\print_author_excerpt;
$post_id = ( $args && isset( $args['post_id'] ) ) ? (int) $args['post_id'] : get_the_ID();
$link    = ( $args && isset( $args['link_name'] ) ) ? esc_attr( $args['link_name'] ) : null;
?>

<article <?php post_class( 'type-user type-guest-author post' ); ?>>
	<div class="post-top">
		<?php
		$size = 262;
		if ( $avatar = get_author_avatar( $post_id, $size ) ) :
			?>
			<figure class="post-image">
				<a href="<?php echo esc_url( get_author_link( $post_id ) ); ?>" rel="bookmark">
					<?php echo $avatar; ?>
				</a>
			</figure>
			<?php
		endif;
		?>

		<header class="post-header <?php echo get_post_type( $post_id ) . '-header'; ?>">

			<?php do_action( 'post_title_before' ); ?>
	
			<h2 class="post-title expert-name no-embellishment">
				<?php
				if ( 'website' === $link ) {
					print_author_website_link( $post_id );
				} elseif( 'none' === $link ) {
					the_title();
				} else {
					print_author_link( $post_id );
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
