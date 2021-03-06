<?php
/**
 * Class Compare Wishlist Integration
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_CW_Integration' ) ) {

	/**
	 * Define Jet_CW_Integration class
	 */
	class Jet_CW_Integration {

		/**
		 * Check if processing elementor widget
		 *
		 * @var boolean
		 */
		private $is_elementor_ajax = false;

		/**
		 * Localize data array
		 *
		 * @var array
		 */
		public $localize_data = array();

		/**
		 * Initalize integration hooks
		 *
		 * @return void
		 */
		public function __construct() {

			add_action( 'elementor/init', array( $this, 'register_category' ) );
			add_action( 'wp_ajax_elementor_render_widget', array( $this, 'set_elementor_ajax' ), 10, - 1 );

			add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_cw_widgets' ), 10 );

		}

		/**
		 * Set $this->is_elementor_ajax to true on Elementor AJAX processing
		 *
		 * @return  void
		 */
		public function set_elementor_ajax() {
			$this->is_elementor_ajax = true;
		}

		/**
		 * Check if we currently in Elementor mode
		 *
		 * @return void
		 */
		public function in_elementor() {

			$result = false;

			if ( wp_doing_ajax() ) {
				$result = $this->is_elementor_ajax;
			} elseif ( Elementor\Plugin::instance()->editor->is_edit_mode()
			           || Elementor\Plugin::instance()->preview->is_preview_mode() ) {
				$result = true;
			}

			/**
			 * Allow to filter result before return
			 *
			 * @var bool $result
			 */
			return apply_filters( 'jet-cw/in-elementor', $result );
		}


		/**
		 * Register addon by file name
		 *
		 * @param  string $file File name.
		 * @param  object $widgets_manager Widgets manager instance.
		 *
		 * @return void
		 */
		public function register_widgets( $file, $widgets_manager ) {

			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( 'Elementor\%s', $class );

			require $file;

			if ( class_exists( $class ) ) {
				$widgets_manager->register_widget_type( new $class );
			}
		}

		/**
		 * Register cherry category for elementor if not exists
		 *
		 * @return void
		 */
		public function register_category() {

			$elements_manager = Elementor\Plugin::instance()->elements_manager;
			$cherry_cat       = 'jet-cw';

			$elements_manager->add_category(
				$cherry_cat,
				array(
					'title' => esc_html__( 'Jet Compare Wishlist', 'jet-cw' ),
					'icon'  => 'font',
				),
				1
			);
		}

		/**
		 * Register plugin addons
		 *
		 * @param  object $widgets_manager Elementor widgets manager instance.
		 *
		 * @return void
		 */
		public function register_cw_widgets( $widgets_manager ) {

			$avaliable_widgets = jet_cw()->settings->get( 'avaliable_widgets' );

			require jet_cw()->plugin_path( 'includes/base/class-jet-cw-base.php' );

			if ( filter_var( jet_cw()->compare_enabled, FILTER_VALIDATE_BOOLEAN ) ) {
				foreach ( glob( jet_cw()->plugin_path( 'includes/widgets/compare/' ) . '*.php' ) as $file ) {
					$slug = basename( $file, '.php' );

					if ( filter_var( $avaliable_widgets[ $slug ], FILTER_VALIDATE_BOOLEAN ) || ! $avaliable_widgets ) {
						jet_cw()->integration->register_widgets( $file, $widgets_manager );
					}
				}
			}

			if ( filter_var( jet_cw()->wishlist_enabled, FILTER_VALIDATE_BOOLEAN ) ) {
				foreach ( glob( jet_cw()->plugin_path( 'includes/widgets/wishlist/' ) . '*.php' ) as $file ) {
					$slug = basename( $file, '.php' );

					if ( filter_var( $avaliable_widgets[ $slug ], FILTER_VALIDATE_BOOLEAN ) || ! $avaliable_widgets ) {
						jet_cw()->integration->register_widgets( $file, $widgets_manager );
					}
				}
			}
		}

	}

}