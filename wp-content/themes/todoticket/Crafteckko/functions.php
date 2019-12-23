<?php
/**
 * Child functions and definitions.
 */
add_filter( 'kava-theme/assets-depends/styles', 'crafteckko_styles_depends' );
add_action( 'jet-theme-core/register-config', 'crafteckko_core_config' );
add_action( 'init', 'crafteckko_plugins_wizard_config', 9 );
add_action( 'init', 'crafteckko_data_importer_config', 9 );
add_action( 'tgmpa_register', 'crafteckko_register_required_plugins' );
/**
 * Enqueue styles.
 */
function crafteckko_styles_depends( $deps ) {
	$parent_handle = 'kava-parent-theme-style';
	wp_register_style(
		$parent_handle,
		get_template_directory_uri() . '/style.css',
		array(),
		kava_theme()->version()
	);
	$deps[] = $parent_handle;
	return $deps;
}
/**
 * Register JetThemeCore config
 *
 * @param  [type] $manager [description]
 * @return [type]          [description]
 */
function crafteckko_core_config( $manager ) {
	$manager->register_config(
		array(
			'dashboard_page_name' => esc_html__( 'Crafteckko', 'crafteckko' ),
			'library_button'      => false,
			'menu_icon'           => 'dashicons-admin-generic',
			'api'                 => array( 'enabled' => false ),
			'guide'               => array(
				'title'   => __( 'Learn More About Your Theme', 'jet-theme-core' ),
				'links'   => array(
					'documentation' => array(
						'label'  => __('Check documentation', 'jet-theme-core'),
						'type'   => 'primary',
						'target' => '_blank',
						'icon'   => 'dashicons-welcome-learn-more',
						'desc'   => __( 'Get more info from documentation', 'jet-theme-core' ),
						'url'    => 'http://documentation.zemez.io/wordpress/index.php?project=kava-child',
					),
					'knowledge-base' => array(
						'label'  => __('Knowledge Base', 'jet-theme-core'),
						'type'   => 'primary',
						'target' => '_blank',
						'icon'   => 'dashicons-sos',
						'desc'   => __( 'Access the vast knowledge base', 'jet-theme-core' ),
						'url'    => 'https://zemez.io/wordpress/support/knowledge-base',
					),
				),
			)
		)
	);
}

/**
 * Register Jet Plugins Wizards config
 * @return [type] [description]
 */
function crafteckko_plugins_wizard_config() {
	if ( ! is_admin() ) {
		return;
	}
	if ( ! function_exists( 'jet_plugins_wizard_register_config' ) ) {
		return;
	}
	jet_plugins_wizard_register_config( array(
		'license' => array(
			'enabled' => false,
		),
		'plugins' => array(
			'jet-data-importer' => array(
				'name'   => esc_html__( 'Jet Data Importer', 'crafteckko' ),
				'source' => 'remote',
				'path'   => 'https://github.com/ZemezLab/jet-data-importer/archive/master.zip',
				'access' => 'base',
				),			
			'elementor' => array(
				'name'   => esc_html__( 'Elementor', 'crafteckko' ),
				'access' => 'skins',
				),
			'kava-extra' => array(
				'name'   => esc_html__( 'Kava Extra', 'crafteckko' ),
				'source' => 'remote',
				'path'   => 'https://github.com/ZemezLab/kava-extra/archive/master.zip',
				'access' => 'base',
				),
			'jet-elements' => array(
				'name'   => esc_html__( 'Jet Elements addon For Elementor', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-elements.zip',
				'access' => 'skins',
				),
			'jet-compare-wishlist' => array(
				'name'   => esc_html__( 'Jet Compare Wishlist', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-compare-wishlist.zip',
				'access' => 'skins',
				),
			'jet-blocks' => array(
				'name'   => esc_html__( 'Jet Blocks', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-blocks.zip',
				'access' => 'skins',
				),
			'jet-tabs' => array(
				'name'   => esc_html__( 'Jet Tabs', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-tabs.zip',
				'access' => 'skins',
				),
			'jet-tricks' => array(
				'name'   => esc_html__( 'Jet Tricks', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-tricks.zip',
				'access' => 'skins',
				),
			'jet-theme-core' => array(
				'name'   => esc_html__( 'Jet Theme Core', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-theme-core.zip',
				'access' => 'skins',
				),
			'jet-woo-builder' => array(
				'name'   => esc_html__( 'Jet Woo Builder', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-woo-builder.zip',
				'access' => 'skins',
				),
			'jet-smart-filters' => array(
				'name'   => esc_html__( 'Jet Smart Filters', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-smart-filters.zip',
				'access' => 'skins',
				),
			'jet-menu' => array(
				'name'   => esc_html__( 'Jet Menu', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-menu.zip',
				'access' => 'skins',
				),
			'jet-popup' => array(
				'name'   => esc_html__( 'Jet Popup', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-popup.zip',
				'access' => 'skins',
				),
			'jet-woo-product-gallery' => array(
				'name'   => esc_html__( 'Jet Woo Product Gallery', 'crafteckko' ),
				'source' => 'local',
				'path'   => get_stylesheet_directory() . '/plugins/jet-woo-product-gallery.zip',
				'access' => 'skins',
				),
			'woocommerce' => array(
				'name'   => esc_html__( 'Woocommerce', 'crafteckko' ),
				'access' => 'base',
				),
			'contact-form-7' => array(
				'name'   => esc_html__( 'Contact Form 7', 'crafteckko' ),
				'access' => 'skins',
				),
			),
		'skins'   => array(
			'base' => array(
				'jet-data-importer',
				'kava-extra',
				),
			'advanced' => array(
				'default' => array(
					'full'  => array(
						'elementor',
						'jet-compare-wishlist',
						'jet-blocks',
						'jet-elements',
						'jet-tabs',
						'jet-theme-core',
						'jet-tricks',
						'contact-form-7',
						'woocommerce',
						'jet-woo-builder',
						'jet-menu',
						'jet-smart-filters',
						'jet-popup',
						'jet-woo-product-gallery',
						),
					'lite'  => false,
					'demo'  => 'https://ld-wp73.template-help.com/woocommerce/prod_598/v1/',
					'thumb' => get_stylesheet_directory_uri() . '/screenshot.png',
					'name'  => esc_html__( 'Crafteckko', 'crafteckko' ),
					),
				),
			),
		'texts'   => array(
			'theme-name' => esc_html__( 'Crafteckko', 'crafteckko' ),
		)
	) );
}
/**
 * Register Jet Data Importer config
 * @return [type] [description]
 */
function crafteckko_data_importer_config() {
	if ( ! is_admin() ) {
		return;
	}
	if ( ! function_exists( 'jet_data_importer_register_config' ) ) {
		return;
	}
	jet_data_importer_register_config( array(
		'xml' => false,
		'advanced_import' => array(
			'default' => array(
				'label'    => esc_html__( 'Crafteckko', 'crafteckko' ),
				'full'     => get_stylesheet_directory() . '/assets/demo-content/default/default-full.xml',
				'lite'     => false,
				'thumb'    => get_stylesheet_directory_uri() . '/assets/demo-content/default/default-thumb.png',
				'demo_url' => 'https://ld-wp73.template-help.com/woocommerce/prod_598/v1/',
			),
		),
		'import' => array(
			'chunk_size' => 3,
		),
		'slider' => array(
			'path' => 'https://raw.githubusercontent.com/JetImpex/wizard-slides/master/slides.json',
		),
		'export' => array(
			'options' => array(
				'woocommerce_default_country',
				'woocommerce_techguide_page_id',
				'woocommerce_shop_page_id',
				'woocommerce_default_catalog_orderby',
				'techguide_catalog_image_size',
				'techguide_single_image_size',
				'techguide_thumbnail_image_size',
				'woocommerce_cart_page_id',
				'woocommerce_checkout_page_id',
				'woocommerce_terms_page_id',
				'tm_woowishlist_page',
				'tm_woocompare_page',
				'tm_woocompare_enable',
				'tm_woocompare_show_in_catalog',
				'tm_woocompare_show_in_single',
				'tm_woocompare_compare_text',
				'tm_woocompare_remove_text',
				'tm_woocompare_page_btn_text',
				'tm_woocompare_show_in_catalog',
				'site_icon',
				'elementor_cpt_support',
				'elementor_disable_color_schemes',
				'elementor_disable_typography_schemes',
				'elementor_container_width',
				'elementor_css_print_method',
				'elementor_global_image_lightbox',
				'jet-elements-settings',
				'jet_menu_options',
				'highlight-and-share',
				'stockticker_defaults',
				'wsl_settings_social_icon_set',
				'jet_woo_builder' ,
				'jet-cw-settings',
			),
			'tables' => array(),
		),
		'success-links' => array(
			'home' => array(
				'label'  => __('View your site', 'jet-date-importer'),
				'type'   => 'primary',
				'target' => '_self',
				'icon'   => 'dashicons-welcome-view-site',
				'desc'   => __( 'Take a look at your site', 'jet-data-importer' ),
				'url'    => home_url( '/' ),
			),
			'edit' => array(
				'label'  => __('Start editing', 'jet-date-importer'),
				'type'   => 'primary',
				'target' => '_self',
				'icon'   => 'dashicons-welcome-write-blog',
				'desc'   => __( 'Proceed to editing pages', 'jet-data-importer' ),
				'url'    => admin_url( 'edit.php?post_type=page' ),
			),
			'documentation' => array(
				'label'  => __('Check documentation', 'jet-data-importer'),
				'type'   => 'primary',
				'target' => '_blank',
				'icon'   => 'dashicons-welcome-learn-more',
				'desc'   => __( 'Get more info from documentation', 'jet-data-importer' ),
				'url'    => 'http://documentation.zemez.io/wordpress/index.php?project=kava-child',
			),
			'knowledge-base' => array(
				'label'  => __('Knowledge Base', 'jet-data-importer'),
				'type'   => 'primary',
				'target' => '_blank',
				'icon'   => 'dashicons-sos',
				'desc'   => __( 'Access the vast knowledge base', 'jet-data-importer' ),
				'url'    => 'https://zemez.io/wordpress/support/knowledge-base',
			),
		),
		'slider' => array(
			'path' => 'https://raw.githubusercontent.com/ZemezLab/kava-child/master/slides.json',
		),
	) );
}
/**
 * Register Class Tgm Plugin Activation
 */
require_once('inc/classes/class-tgm-plugin-activation.php');
/**
 * Setup Jet Plugins Wizard
 */
function crafteckko_register_required_plugins() {
	$plugins = array(
		array(
			'name'         => esc_html__( 'Jet Plugin Wizard', 'crafteckko' ),
			'slug'         => 'jet-plugins-wizard',
			'source'       => 'https://github.com/ZemezLab/jet-plugins-wizard/archive/master.zip',
			'external_url' => 'https://github.com/ZemezLab/jet-plugins-wizard',
		),
	);
	$config = array(
		'id'           => 'crafteckko',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => '',
	);
	tgmpa( $plugins, $config );
}

	