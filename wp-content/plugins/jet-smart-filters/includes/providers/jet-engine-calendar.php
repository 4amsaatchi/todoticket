<?php
/**
 * Class: Jet_Smart_Filters_Provider_Jet_Engine_Calendar
 * Name: JetEngine Calendar
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Smart_Filters_Provider_Jet_Engine_Calendar' ) ) {

	/**
	 * Define Jet_Smart_Filters_Provider_Jet_Engine_Calendar class
	 */
	class Jet_Smart_Filters_Provider_Jet_Engine_Calendar extends Jet_Smart_Filters_Provider_Base {

		/**
		 * Watch for default query
		 */
		public function __construct() {

			if ( ! jet_smart_filters()->query->is_ajax_filter() && ! $this->is_month_request() ) {
				add_filter('jet-engine/listing/grid/posts-query-args', array( $this, 'store_default_query' ), 0, 2 );
			}

			if ( $this->is_month_request() ) {
				add_filter( 'jet-smart-filters/query/allowed-ajax-actions', array( $this, 'allow_month_action' ) );
				add_filter( 'jet-engine/listing/grid/custom-settings', array( $this, 'add_month_settings' ), 10, 2 );
				add_filter( 'jet-engine/listing/grid/posts-query-args', array( $this, 'add_query_args' ), 10, 2 );
			}

		}

		/**
		 * Allow month action
		 *
		 * @return array
		 */
		public function allow_month_action( $allowed_actions = array() ) {

			$allowed_actions[] = 'jet_engine_calendar_get_month';
			return $allowed_actions;

		}

		/**
		 * Check if get month request is processed
		 *
		 * @return boolean [description]
		 */
		public function is_month_request() {

			if ( ! wp_doing_ajax() ) {
				return false;
			}

			if ( ! isset( $_REQUEST['action'] ) || 'jet_engine_calendar_get_month' !== $_REQUEST['action'] ) {
				return false;
			}

			return true;

		}

		/**
		 * Add widget settings
		 *
		 * @return array
		 */
		public function add_month_settings( $settings, $widget ) {

			if ( 'jet-listing-calendar' !== $widget->get_name() ) {
				return $settings;
			}

			if ( ! empty( $_REQUEST['settings'] ) ) {
				return $_REQUEST['settings'];
			} else {
				return $settings;
			}

		}

		/**
		 * Store default query args
		 *
		 * @param  [type] $args [description]
		 * @return [type]       [description]
		 */
		public function store_default_query( $args, $widget ) {

			if ( 'jet-listing-calendar' !== $widget->get_name() ) {
				return $args;
			}

			$settings = $widget->get_settings();

			if ( empty( $settings['_element_id'] ) ) {
				$query_id = false;
			} else {
				$query_id = $settings['_element_id'];
			}

			jet_smart_filters()->query->store_provider_default_query( $this->get_id(), $args, $query_id );

			jet_smart_filters()->providers->store_provider_settings( $this->get_id(), array(
				'lisitng_id'          => isset( $settings['lisitng_id'] ) ? $settings['lisitng_id'] : false,
				'group_by'            => isset( $settings['group_by'] ) ? $settings['group_by'] : false,
				'group_by_key'        => isset( $settings['group_by_key'] ) ? $settings['group_by_key'] : false,
				'posts_query'         => isset( $settings['posts_query'] ) ? $settings['posts_query'] : array(),
				'meta_query_relation' => isset( $settings['meta_query_relation'] ) ? $settings['meta_query_relation'] : false,
				'tax_query_relation'  => isset( $settings['tax_query_relation'] ) ? $settings['tax_query_relation'] : false,
				'tax_query_relation'  => isset( $settings['tax_query_relation'] ) ? $settings['tax_query_relation'] : false,
				'hide_widget_if'      => isset( $settings['hide_widget_if'] ) ? $settings['hide_widget_if'] : false,
				'caption_layout'      => isset( $settings['caption_layout'] ) ? $settings['caption_layout'] : 'layout-1',
			), $query_id );

			$args['suppress_filters']  = false;
			$args['jet_smart_filters'] = jet_smart_filters()->query->encode_provider_data(
				$this->get_id(),
				$query_id
			);

			return $args;
		}

		/**
		 * Get provider name
		 *
		 * @return string
		 */
		public function get_name() {
			return __( 'JetEngine Calendar', 'jet-smart-filters' );
		}

		/**
		 * Get provider ID
		 *
		 * @return string
		 */
		public function get_id() {
			return 'jet-engine-calendar';
		}

		/**
		 * Get filtered provider content
		 *
		 * @return string
		 */
		public function ajax_get_content() {

			if ( ! function_exists( 'jet_engine' ) ) {
				return;
			}

			add_filter( 'jet-engine/listing/grid/posts-query-args', array( $this, 'add_query_args' ), 10, 2 );
			add_filter( 'jet-engine/listing/grid/custom-settings', array( $this, 'add_settings' ), 10, 2 );

			if ( ! class_exists( 'Elementor\Jet_Listing_Grid_Widget' ) ) {
				require_once jet_engine()->plugin_path( 'includes/listings/static-widgets/grid.php' );
			}

			if ( ! class_exists( 'Elementor\Jet_Listing_Calendar_Widget' ) ) {
				require_once jet_engine()->modules->modules_path( 'calendar/calendar.php' );
			}

			Elementor\Plugin::instance()->frontend->start_excerpt_flag( null );

			$widget = new Elementor\Jet_Listing_Calendar_Widget();
			$widget->render_posts();

		}

		/**
		 * Get provider wrapper selector
		 *
		 * @return string
		 */
		public function get_wrapper_selector() {
			return '.elementor-widget-jet-listing-calendar > .elementor-widget-container';
		}

		/**
		 * Add custom settings for AJAX request
		 */
		public function add_settings( $settings, $widget ) {

			if ( 'jet-listing-calendar' !== $widget->get_name() ) {
				return $settings;
			}

			return jet_smart_filters()->query->get_query_settings();
		}

		/**
		 * Pass args from reuest to provider
		 */
		public function apply_filters_in_request() {

			$args = jet_smart_filters()->query->get_query_args();

			if ( ! $args ) {
				return;
			}

			add_filter( 'jet-engine/listing/grid/posts-query-args', array( $this, 'add_query_args' ), 10, 2 );

		}

		/**
		 * Add custom query arguments
		 *
		 * @param array $args [description]
		 */
		public function add_query_args( $args = array(), $widget ) {

			if ( 'jet-listing-calendar' !== $widget->get_name() ) {
				return $args;
			}

			if ( ! jet_smart_filters()->query->is_ajax_filter() && ! $this->is_month_request() ) {

				$settings = $widget->get_settings();

				if ( empty( $settings['_element_id'] ) ) {
					$query_id = 'default';
				} else {
					$query_id = $settings['_element_id'];
				}

				$request_query_id = jet_smart_filters()->query->get_current_provider( 'query_id' );

				if ( $query_id !== $request_query_id ) {
					return $args;
				}

			}

			if ( $this->is_month_request() ) {
				jet_smart_filters()->query->get_query_from_request();
			}

			return array_merge( $args, jet_smart_filters()->query->get_query_args() );
		}
	}

}
