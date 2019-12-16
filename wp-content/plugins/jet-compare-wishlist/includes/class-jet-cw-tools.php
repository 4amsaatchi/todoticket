<?php
/**
 * Cherry addons tools class
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_CW_Tools' ) ) {

	/**
	 * Define Jet_CW_Tools class
	 */
	class Jet_CW_Tools {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Returns columns classes string
		 *
		 * @param  [type] $columns [description]
		 *
		 * @return [type]          [description]
		 */
		public function col_classes( $columns = array() ) {

			$columns = wp_parse_args( $columns, array(
				'desk' => 1,
				'tab'  => 1,
				'mob'  => 1,
			) );

			$classes = array();

			foreach ( $columns as $device => $cols ) {
				if ( ! empty( $cols ) ) {
					$classes[] = sprintf( 'cw-col-%1$s-%2$s', $device, $cols );
				}
			}

			return implode( ' ', $classes );
		}

		/**
		 * Returns disable columns gap nad rows gap classes string
		 *
		 * @param  string $use_cols_gap [description]
		 * @param  string $use_rows_gap [description]
		 *
		 * @return [type]               [description]
		 */
		public function gap_classes( $use_cols_gap = 'yes', $use_rows_gap = 'yes' ) {

			$result = array();

			foreach ( array( 'cols' => $use_cols_gap, 'rows' => $use_rows_gap ) as $element => $value ) {
				if ( 'yes' !== $value ) {
					$result[] = sprintf( 'disable-%s-gap', $element );
				}
			}

			return implode( ' ', $result );

		}

		/**
		 * Returns image size array in slug => name format
		 *
		 * @return  array
		 */
		public function get_image_sizes() {

			global $_wp_additional_image_sizes;

			$sizes  = get_intermediate_image_sizes();
			$result = array();

			foreach ( $sizes as $size ) {
				if ( in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
					$result[ $size ] = ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) );
				} else {
					$result[ $size ] = sprintf(
						'%1$s (%2$sx%3$s)',
						ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) ),
						$_wp_additional_image_sizes[ $size ]['width'],
						$_wp_additional_image_sizes[ $size ]['height']
					);
				}
			}

			return array_merge( array( 'full' => esc_html__( 'Full', 'jet-cw' ), ), $result );
		}

		/**
		 * Get categories list.
		 *
		 * @return array
		 */
		public function get_categories() {

			$categories = get_categories();

			if ( empty( $categories ) || ! is_array( $categories ) ) {
				return array();
			}

			return wp_list_pluck( $categories, 'name', 'term_id' );

		}

		/**
		 * Returns icons data list.
		 *
		 * @return array
		 */
		public function get_theme_icons_data() {

			$default = array(
				'icons'  => false,
				'format' => 'fa %s',
				'file'   => false,
			);

			/**
			 * Filter default icon data before useing
			 *
			 * @var array
			 */
			$icon_data = apply_filters( 'jet-cw/controls/icon/data', $default );
			$icon_data = array_merge( $default, $icon_data );

			return $icon_data;
		}


		/**
		 * Return availbale rating icon list
		 * @return [type] [description]
		 */
		public function get_available_rating_icons_list() {

			return apply_filters(
				'jet-cw/tools/rating/available-icons',
				array(
					'jetcomparewishlist-icon-rating-1'  => __( 'Rating 1', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-2'  => __( 'Rating 2', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-3'  => __( 'Rating 3', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-4'  => __( 'Rating 4', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-5'  => __( 'Rating 5', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-6'  => __( 'Rating 6', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-7'  => __( 'Rating 7', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-8'  => __( 'Rating 8', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-9'  => __( 'Rating 9', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-10' => __( 'Rating 10', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-11' => __( 'Rating 11', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-12' => __( 'Rating 12', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-13' => __( 'Rating 13', 'jet-cw' ),
					'jetcomparewishlist-icon-rating-14' => __( 'Rating 14', 'jet-cw' ),
				)
			);

		}

		/**
		 * Returns allowed order by fields for options
		 *
		 * @return array
		 */
		public function compare_table_data_list() {
			return array(
				'compare_remove_button' => esc_html__( 'Remove Button', 'jet-cw' ),
				'title'                 => esc_html__( 'Title', 'jet-cw' ),
				'thumbnail'             => esc_html__( 'Thumbnail', 'jet-cw' ),
				'price'                 => esc_html__( 'Price', 'jet-cw' ),
				'rating'                => esc_html__( 'Rating', 'jet-cw' ),
				'add_to_cart_button'    => esc_html__( 'Add To Cart', 'jet-cw' ),
				'description'           => esc_html__( 'Description', 'jet-cw' ),
				'excerpt'               => esc_html__( 'Short Description', 'jet-cw' ),
				'sku'                   => esc_html__( 'SKU', 'jet-cw' ),
				'stock_status'          => esc_html__( 'Stock Status', 'jet-cw' ),
				'weight'                => esc_html__( 'Weight', 'jet-cw' ),
				'dimensions'            => esc_html__( 'Dimensions', 'jet-cw' ),
				'attributes'            => esc_html__( 'Attributes', 'jet-cw' ),
				'categories'            => esc_html__( 'Categories', 'jet-cw' ),
				'tags'                  => esc_html__( 'Tags', 'jet-cw' ),
			);
		}

		/**
		 * Returns allowed order by fields for options
		 *
		 * @return array
		 */
		public function orderby_arr() {
			return array(
				'none'          => esc_html__( 'None', 'jet-cw' ),
				'ID'            => esc_html__( 'ID', 'jet-cw' ),
				'author'        => esc_html__( 'Author', 'jet-cw' ),
				'title'         => esc_html__( 'Title', 'jet-cw' ),
				'name'          => esc_html__( 'Name (slug)', 'jet-cw' ),
				'date'          => esc_html__( 'Date', 'jet-cw' ),
				'modified'      => esc_html__( 'Modified', 'jet-cw' ),
				'rand'          => esc_html__( 'Rand', 'jet-cw' ),
				'comment_count' => esc_html__( 'Comment Count', 'jet-cw' ),
				'menu_order'    => esc_html__( 'Menu Order', 'jet-cw' ),
			);
		}

		/**
		 * Returns allowed order fields for options
		 *
		 * @return array
		 */
		public function order_arr() {

			return array(
				'desc' => esc_html__( 'Descending', 'jet-cw' ),
				'asc'  => esc_html__( 'Ascending', 'jet-cw' ),
			);

		}

		/**
		 * Returns allowed order by fields for options
		 *
		 * @return array
		 */
		public function verrtical_align_attr() {
			return array(
				'baseline'    => esc_html__( 'Baseline', 'jet-cw' ),
				'top'         => esc_html__( 'Top', 'jet-cw' ),
				'middle'      => esc_html__( 'Middle', 'jet-cw' ),
				'bottom'      => esc_html__( 'Bottom', 'jet-cw' ),
				'sub'         => esc_html__( 'Sub', 'jet-cw' ),
				'super'       => esc_html__( 'Super', 'jet-cw' ),
				'text-top'    => esc_html__( 'Text Top', 'jet-cw' ),
				'text-bottom' => esc_html__( 'Text Bottom', 'jet-cw' ),
			);
		}

		/**
		 * Returns array with numbers in $index => $name format for numeric selects
		 *
		 * @param  integer $to Max numbers
		 *
		 * @return array
		 */
		public function get_select_range( $to = 10 ) {
			$range = range( 1, $to );

			return array_combine( $range, $range );
		}

		/**
		 * Rturns image tag or raw SVG
		 *
		 * @param  string $url image URL.
		 * @param  array $attr [description]
		 *
		 * @return string
		 */
		public function get_image_by_url( $url = null, $attr = array() ) {

			$url = esc_url( $url );

			if ( empty( $url ) ) {
				return;
			}

			$ext  = pathinfo( $url, PATHINFO_EXTENSION );
			$attr = array_merge( array( 'alt' => '' ), $attr );

			if ( 'svg' !== $ext ) {
				return sprintf( '<img src="%1$s"%2$s>', $url, $this->get_attr_string( $attr ) );
			}

			$base_url = network_site_url( '/' );
			$svg_path = str_replace( $base_url, ABSPATH, $url );
			$key      = md5( $svg_path );
			$svg      = get_transient( $key );

			if ( ! $svg ) {
				$svg = file_get_contents( $svg_path );
			}

			if ( ! $svg ) {
				return sprintf( '<img src="%1$s"%2$s>', $url, $this->get_attr_string( $attr ) );
			}

			set_transient( $key, $svg, DAY_IN_SECONDS );

			unset( $attr['alt'] );

			return sprintf( '<div%2$s>%1$s</div>', $svg, $this->get_attr_string( $attr ) );;
		}

		/**
		 * Return attributes string from attributes array.
		 *
		 * @param  array $attr Attributes string.
		 *
		 * @return string
		 */
		public function get_attr_string( $attr = array() ) {

			if ( empty( $attr ) || ! is_array( $attr ) ) {
				return;
			}

			$result = '';

			foreach ( $attr as $key => $value ) {
				$result .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
			}

			return $result;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance( $shortcodes = array() ) {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self( $shortcodes );
			}

			return self::$instance;
		}
	}

}

/**
 * Returns instance of Jet_CW_Tools
 *
 * @return object
 */
function jet_cw_tools() {
	return Jet_CW_Tools::get_instance();
}
