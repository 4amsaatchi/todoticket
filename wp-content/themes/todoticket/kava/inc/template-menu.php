<?php
/**
 * Menu Template Functions.
 *
 * @package Kava
 */

/**
 * Show main menu.
 *
 * @since  1.0.0
 * @return void
 */
function kava_main_menu() {

	$classes[] = 'main-navigation';

	?>
	<nav id="site-navigation" class="<?php echo join( ' ', $classes ); ?>" role="navigation">
		<div class="main-navigation-inner">
			<div class="mobile-logo">
				<?php kava_header_logo(); ?>
			</div>
		<?php
			$args = apply_filters( 'kava-theme/menu/main-menu-args', array(
				'theme_location'   => 'main',
				'container'        => '',
				'menu_id'          => 'main-menu',
				'fallback_cb'      => 'kava_set_nav_menu',
				'fallback_message' => esc_html__( 'Set main menu', 'kava' ),
			) );

			wp_nav_menu( $args );
		?>
		<?php if ( has_nav_menu( 'social' ) ) :?>
			<div class="socialheadermenu inner-mobile">
				<?php $items = wp_get_nav_menu_items(61);
				foreach ($items as $item) :?>
					<div class="singlesocialheader txtcenter">
						<a href="<?= $item->url ?>" target="_blank">
							<img class="logos-inner" src="<?php echo get_home_url(); ?>/wp-content/uploads/2020/01/<?= $item->classes[0] ?>-ico.png" alt="<?= $item->classes[0] ?>">
						</a>
					</div>
				<?php 					
				endforeach;	?>
			</div>
			<?php
		endif;
		?>
		</div>
	</nav><!-- #site-navigation -->
	<?php
}

/**
 * Show footer menu.
 *
 * @since  1.0.0
 * @return void
 */
function kava_footer_menu() { ?>
	<nav id="footer-navigation" class="footer-menu" role="navigation">
	<?php
		$args = apply_filters( 'kava-theme/menu/footer-menu-args', array(
			'theme_location'   => 'footer',
			'container'        => '',
			'menu_id'          => 'footer-menu-items',
			'menu_class'       => 'footer-menu__items',
			'depth'            => 1,
			'fallback_cb'      => '__return_empty_string',
			'fallback_message' => esc_html__( 'Set footer menu', 'kava' ),
			'items' => array(
						'link_yelp',
						'link_facebook',
						'link_twitter',
						'link_instagram',
						'link_email',
					),
		) );

		wp_nav_menu( $args );
	?>
	</nav><!-- #footer-navigation -->
	<?php
}

/**
 * Get social nav menu.
 *
 * @since  1.0.0
 * @since  1.0.1  Added arguments to the filter.
 * @param  string $context Current post context - 'single' or 'loop'.
 * @param  string $type    Content type - icon, text or both.
 * @return string
 */
function kava_get_social_list( $context, $type = 'icon' ) {
	static $instance = 0;
	$instance++;

	$container_class = array( 'social-list' );

	if ( ! empty( $context ) ) {
		$container_class[] = sprintf( 'social-list--%s', sanitize_html_class( $context ) );
	}

	$container_class[] = sprintf( 'social-list--%s', sanitize_html_class( $type ) );

	$args = apply_filters( 'kava-theme/menu/main-menu-args', array(
		'theme_location'   => 'social',
		'container'        => 'div',
		'container_class'  => join( ' ', $container_class ),
		'menu_id'          => "social-list-{$instance}",
		'menu_class'       => 'social-list__items inline-list',
		'depth'            => 1,
		'link_before'      => ( 'icon' == $type ) ? '<span class="screen-reader-text">' : '',
		'link_after'       => ( 'icon' == $type ) ? '</span>' : '',
		'echo'             => false,
		'fallback_cb'      => 'kava_set_nav_menu',
		'fallback_message' => esc_html__( 'Set social menu', 'kava' ),
	), $context, $type );

	return wp_nav_menu( $args );
}

/**
 * Set callback function for nav menu.
 *
 * @param  array $args Nav menu arguments.
 * @return void
 */
function kava_set_nav_menu( $args ) {

	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return null;
	}

	$format = '<div class="set-menu %3$s"><a href="%2$s" target="_blank" class="set-menu_link">%1$s</a></div>';
	$label  = $args['fallback_message'];
	$url    = esc_url( admin_url( 'nav-menus.php' ) );

	printf( $format, $label, $url, $args['container_class'] );
}

//añadir clases al <li> del menu
	function kava_set_nav_menu_clases($clases, $item, $args) {
		if ($args -> theme_location == 'footer') {
		$clases[] = 'opaciti';
		}
		return $clases;
	}
	add_filter('nav_menu_css_class', 'kava_set_nav_menu_clases', 1, 3);