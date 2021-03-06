<?php
/**
 * Class description
 *
 * @package   package_name
 * @author    Cherry Team
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Woo_Product_Gallery_Settings' ) ) {

	/**
	 * Define Jet_Woo_Product_Gallery_Settings class
	 */
	class Jet_Woo_Product_Gallery_Settings {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * [$key description]
		 * @var string
		 */
		public $key = 'jet-woo-product-gallery-settings';

		/**
		 * [$builder description]
		 * @var null
		 */
		public $builder  = null;

		/**
		 * [$settings description]
		 * @var null
		 */
		public $settings = null;

		/**
		 * Global Available Widgets array
		 *
		 * @var array
		 */
		public $product_gallery_available_widgets = array();


		/**
		 * Init page
		 */
		public function init() {

			add_action( 'admin_enqueue_scripts', array( $this, 'init_builder' ), 0 );
			add_action( 'admin_menu', array( $this, 'register_page' ), 99 );
			add_action( 'init', array( $this, 'save' ), 40 );
			add_action( 'admin_notices', array( $this, 'saved_notice' ) );

			foreach ( glob( jet_woo_product_gallery()->plugin_path( 'includes/widgets/' ) . '*.php' ) as $file ) {
				$data = get_file_data( $file, array( 'class'=>'Class', 'name' => 'Name', 'slug'=>'Slug' ) );

				$slug = basename( $file, '.php' );
				$this->product_gallery_available_widgets[ $slug] = $data['name'];
			}

		}

		/**
		 * Initialize page builder module if reqired
		 *
		 * @return [type] [description]
		 */
		public function init_builder() {

			if ( ! isset( $_REQUEST['page'] ) || $this->key !== $_REQUEST['page'] ) {
				return;
			}

			$builder_data = jet_woo_product_gallery()->framework->get_included_module_data( 'cherry-x-interface-builder.php' );

			$this->builder = new CX_Interface_Builder(
				array(
					'path' => $builder_data['path'],
					'url'  => $builder_data['url'],
				)
			);

		}

		/**
		 * Show saved notice
		 *
		 * @return bool
		 */
		public function saved_notice() {

			if ( ! isset( $_GET['settings-saved'] ) ) {
				return false;
			}

			$message = esc_html__( 'Settings saved', 'jet-woo-product-gallery' );

			printf( '<div class="notice notice-success is-dismissible"><p>%s</p></div>', $message );

			return true;

		}

		/**
		 * Save settings
		 *
		 * @return void
		 */
		public function save() {

			if ( ! isset( $_REQUEST['page'] ) || $this->key !== $_REQUEST['page'] ) {
				return;
			}

			if ( ! isset( $_REQUEST['action'] ) || 'save-settings' !== $_REQUEST['action'] ) {
				return;
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$current = get_option( $this->key, array() );
			$data    = $_REQUEST;

			unset( $data['action'] );

			foreach ( $data as $key => $value ) {
				$current[ $key ] = is_array( $value ) ? $value : esc_attr( $value );
			}

			update_option( $this->key, $current );

			$redirect = add_query_arg(
				array( 'dialog-saved' => true ),
				$this->get_settings_page_link()
			);

			wp_redirect( $redirect );
			die();

		}

		/**
		 * Return settings page URL
		 *
		 * @return string
		 */
		public function get_settings_page_link() {

			return add_query_arg(
				array(
					'page' => $this->key,
				),
				esc_url( admin_url( 'admin.php' ) )
			);

		}

		public function get( $setting, $default = false ) {

			if ( null === $this->settings ) {
				$this->settings = get_option( $this->key, array() );
			}

			return isset( $this->settings[ $setting ] ) ? $this->settings[ $setting ] : $default;

		}

		/**
		 * Register add/edit page
		 *
		 * @return void
		 */
		public function register_page() {

			add_submenu_page(
				'elementor',
				esc_html__( 'Jet Product Gallery Settings', 'jet-woo-product-gallery' ),
				esc_html__( 'Jet Product Gallery Settings', 'jet-woo-product-gallery' ),
				'manage_options',
				$this->key,
				array( $this, 'render_page' )
			);

		}

		/**
		 * Render settings page
		 *
		 * @return void
		 */
		public function render_page() {

			foreach ( $this->product_gallery_available_widgets as $key => $value ) {
				$default_product_gallery_available_widgets[ $key ] = 'true';
			}

			$this->builder->register_section(
				array(
					'jet_woo_product_gallery_settings' => array(
						'type'   => 'section',
						'scroll' => false,
						'title'  => esc_html__( 'Jet Product Gallery Settings', 'jet-woo-product-gallery' ),
					),
				)
			);

			$this->builder->register_form(
				array(
					'jet_woo_product_gallery_settings_form' => array(
						'type'   => 'form',
						'parent' => 'jet_woo_product_gallery_settings',
						'action' => add_query_arg(
							array( 'page' => $this->key, 'action' => 'save-settings' ),
							esc_url( admin_url( 'admin.php' ) )
						),
					),
				)
			);

			$this->builder->register_settings(
				array(
					'settings_top' => array(
						'type'   => 'settings',
						'parent' => 'jet_woo_product_gallery_settings_form',
					),
					'settings_bottom' => array(
						'type'   => 'settings',
						'parent' => 'jet_woo_product_gallery_settings_form',
					),
				)
			);

			$this->builder->register_component(
				array(
					'jet_woo_product_gallery_tab_vertical' => array(
						'type'   => 'component-tab-vertical',
						'parent' => 'settings_top',
					),
				)
			);

			$this->builder->register_settings(
				array(
					'available_widgets_options' => array(
						'parent'      => 'jet_woo_product_gallery_tab_vertical',
						'title'       => esc_html__( 'Available Widgets', 'jet-woo-product-gallery' ),
					),
				)
			);

			$this->builder->register_control(
				array(
					'product_gallery_available_widgets' => array(
						'type'        => 'checkbox',
						'id'          => 'product_gallery_available_widgets',
						'name'        => 'product_gallery_available_widgets',
						'parent'      => 'available_widgets_options',
						'value'       => $this->get( 'product_gallery_available_widgets', $default_product_gallery_available_widgets ),
						'options'     => $this->product_gallery_available_widgets,
						'title'       => esc_html__( 'Global Available Widgets', 'jet-woo-product-gallery' ),
						'description' => esc_html__( 'List of widgets that will be available when editing the page', 'jet-woo-product-gallery' ),
						'class'       => 'jet_woo_product_gallery_settings_form__checkbox-group'
					),
				)
			);

			$this->builder->register_html(
				array(
					'save_button' => array(
						'type'   => 'html',
						'parent' => 'settings_bottom',
						'class'  => 'cx-component dialog-save',
						'html'   => '<button type="submit" class="button button-primary">' . esc_html__( 'Save', 'jet-woo-product-gallery' ) . '</button>',
					),
				)
			);

			echo '<div class="jet-woo-product-gallery-settings-page">';
				$this->builder->render();
			echo '</div>';
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

/**
 * Returns instance of Jet_Woo_Product_Gallery_Settings
 *
 * @return object
 */
function jet_woo_product_gallery_settings() {
	return Jet_Woo_Product_Gallery_Settings::get_instance();
}
