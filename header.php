<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quincy
 */
use function Quincy_Institute\get_svg;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>

</head>

<body <?php body_class( 'site-wrapper' ); ?>>

	<?php
	wp_body_open();
	?>

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'quincy' ); ?></a>

	<header class="site-header">

		<div class="site-header__content">

			<div class="site-branding">

				<?php the_custom_logo(); ?>

				<div class="site-header__utilities">

					<?php if ( is_active_sidebar( 'header' ) ) : ?>
						<div class="header-widgets widget">
							<?php dynamic_sidebar( 'header' ); ?>
						</div>
					<?php endif; ?>
					
					<div class="site-utilities">
						<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'mobile' ) ) : ?>
							<button type="button" class="icon-button off-canvas-open" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open Menu', 'quincy' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2" viewBox="0 0 18 12" height="100%" width="100%">
									<path d="M0 0h18v2.016H0V0Zm0 6.984V5.016h18v1.968H0ZM0 12V9.984h18V12H0Z" style="fill:#fff;fill-rule:nonzero"/>
								</svg>
							</button>
						<?php endif; ?>
					</div><!-- .site-utilities -->

				</div>



			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation navigation-menu site-navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'quincy' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'fallback_cb'    => false,
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'menu dropdown main-navigation__content',
						'container'      => false,
						'depth'          => 2,
					)
				);
				?>
			</nav><!-- #site-navigation-->

		</div><!-- .site-header-content -->

		<?php do_action( 'site_header_before_end' ); ?>

	</header><!-- .site-header-->

	<?php do_action( 'site_header_after' ); ?>