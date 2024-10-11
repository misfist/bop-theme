<?php
/**
 * The sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quincy
 */
use function Quincy_Institute\render_toc;
use function Quincy_Institute\print_download_button;
use function Quincy_Institute\print_post_utilties;

?>
<aside class="sidebar content-sidebar secondary">
	<?php
	if( 'page' === get_post_type() ) :
		print_post_utilties();
	endif;
	?>

	<?php
	if ( has_block( 'simpletoc/toc', get_the_ID() ) ) :
		render_toc( get_the_content() );
	else :
		block_template_part( 'sidebar' );
	endif;
	?>
</aside><!-- .secondary -->
