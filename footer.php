<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quincy
 */

use function Quincy\bop\print_copyright_text;
use function Quincy_Institute\print_mobile_menu;
?>
	<?php do_action( 'site_footer_before' ); ?>

	<div class="site-pre-footer">
		<?php block_template_part( 'pre-footer' ); ?>
	</div><!-- .site-pre-footer -->

	<footer class="site-footer">

		<div class="site-footer__inner">

			<?php
			if ( has_nav_menu( 'footer' ) ) :
				?>
				<nav id="site-footer-navigation" class="footer-navigation navigation-menu" aria-label="<?php esc_attr_e( 'Footer Navigation', 'bop' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'fallback_cb'    => false,
							'theme_location' => 'footer',
							'menu_id'        => 'footer-menu',
							'menu_class'     => 'menu footer',
							'container'      => false,
							'depth'          => 1,
						)
					);
					?>
				</nav><!-- #site-navigation-->
				<?php
			endif;
			?>

			<?php
			if ( has_nav_menu( 'footer-2' ) ) :
				?>
				<nav id="site-footer-tertiary-navigation" class="footer-tertiary-navigation navigation-menu" aria-label="<?php esc_attr_e( 'Tertiary Footer Navigation', 'bop' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'fallback_cb'    => false,
							'theme_location' => 'footer-2',
							'menu_id'        => 'footer-tertiary-menu',
							'menu_class'     => 'menu tertiary',
							'container'      => false,
							'depth'          => 1,
						)
					);
					?>
				</nav><!-- #site-navigation-->
				<?php
			endif;
			?>

			<?php if ( is_active_sidebar( 'footer' ) ) : ?>
				<div class="footer-widgets">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div><!-- .footer -->
			<?php endif; ?>

			<div class="site-info">
				<?php if ( is_active_sidebar( 'site-info' ) ) : ?>
					<?php dynamic_sidebar( 'site-info' ); ?>
				<?php endif; ?>

				<div class="copyright">
					<?php print_copyright_text(); ?>
				</div>

				<?php
				if ( has_nav_menu( 'privacy' ) ) :
					?>
					<nav id="privacy-navigation" class="footer-privacy-navigation navigation-menu" aria-label="<?php esc_attr_e( 'Privacy Navigation', 'bop' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'fallback_cb'    => false,
								'theme_location' => 'privacy',
								'menu_id'        => 'privacy-menu',
								'menu_class'     => 'menu privacy',
								'container'      => false,
								'depth'          => 1,
							)
						);
						?>
					</nav><!-- #privacy-navigation-->
					<?php
				endif;
				?>
			</div><!-- .site-info -->

		</div><!-- .site-footer__inner -->

	</footer><!-- .site-footer-->

	<?php do_action( 'site_footer_after' ); ?>

	<?php print_mobile_menu(); ?>
	<?php wp_footer(); ?>

</body>

</html>
