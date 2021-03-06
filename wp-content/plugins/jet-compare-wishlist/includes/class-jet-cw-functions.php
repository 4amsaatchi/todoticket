<?php
/**
 * Cherry addons template functions class
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_CW_Functions' ) ) {

	/**
	 * Define Jet_CW_Functions class
	 */
	class Jet_CW_Functions {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Return product title
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_title( $product, $settings ) {

			if ( ! $product ) {
				return;
			}

			$url = get_permalink( $product->get_id() );

			$title = sprintf(
				'<a class="jet-cw-product-title" href="%s">%s</a>',
				esc_url( $url ),
				$product->get_title()
			);

			return apply_filters( 'jet-cw/template-functions/title', $title );

		}

		/**
		 * Return remove button compare
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_compare_remove_button( $product, $settings ) {
			$button_text = isset( $settings['compare_table_data_remove_text'] ) ? $settings['compare_table_data_remove_text'] : '';
			$button_icon = isset( $settings['compare_table_data_remove_icon'] ) ? '<i class="icon ' . $settings['compare_table_data_remove_icon'] . '"></i>' : '';
			if ( ! $product ) {
				return;
			}

			$button = sprintf(
				'<button class="jet-cw-remove-button jet-compare-item-remove-button" data-product-id="%s">%s<span class="text">%s</span></button>',
				$product->get_id(),
				$button_icon,
				$button_text
			);

			return apply_filters( 'jet-cw/template-functions/compare-remove', $button );
		}

		/**
		 * Return remove button wishlist
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_wishlist_remove_button( $product, $settings ) {
			$button_text = isset( $settings['wishlist_remove_text'] ) ? $settings['wishlist_remove_text'] : '';
			$button_icon = isset( $settings['wishlist_remove_icon'] ) ? '<i class="icon ' . $settings['wishlist_remove_icon'] . '"></i>' : '';
			if ( ! $product ) {
				return;
			}

			$button = sprintf(
				'<button class="jet-cw-remove-button jet-wishlist-item-remove-button" data-product-id="%s">%s<span class="text">%s</span></button>',
				$product->get_id(),
				$button_icon,
				$button_text
			);

			return apply_filters( 'jet-cw/template-functions/wishlist-remove', $button );
		}

		/**
		 * Return product thumbnail
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return string
		 */
		public function get_thumbnail( $product, $settings ) {
			$size = isset( $settings['cw_thumbnail_size'] ) ? $settings['cw_thumbnail_size'] : 'thumbnail_size';

			if ( ! $product ) {
				return;
			}

			$thumbnail_id = get_post_thumbnail_id( $product->get_id() );

			if ( empty( $thumbnail_id ) ) {
				return wc_placeholder_img( $size );
			}

			$thumbnail = wp_get_attachment_image( $thumbnail_id, $size, false );

			$thumbnail = sprintf( '<div class="jet-cw-thumbnail">%s</div>', $thumbnail );

			return apply_filters( 'jet-cw/template-functions/thumbnail', $thumbnail );

		}

		/**
		 * Return product stock status
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return string
		 */
		public function get_stock_status( $product, $settings ) {

			if ( ! $product ) {
				return;
			}

			$stock_status = wc_get_stock_html( $product );

			if ( ! empty( $stock_status ) ) {

				$stock_status = sprintf(
					'<span class="jet-cw-stock-status">%s</span>',
					$stock_status
				);

				return apply_filters( 'jet-cw/template-functions/stock-status', $stock_status );

			}

		}

		/**
		 * Return product sku
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_sku( $product, $settings ) {

			if ( ! $product ) {
				return;
			}

			if ( $product->get_sku() ) {
				$sku = sprintf(
					'<span class="jet-cw-sku">%s</span>',
					$product->get_sku()
				);

				return apply_filters( 'jet-cw/template-functions/sku', $sku );

			}

		}

		/**
		 * Return product dimension
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_dimensions( $product, $settings ) {

			if ( ! $product ) {
				return;
			}

			if ( $product->has_dimensions() ) {

				$dimensions = sprintf(
					'<span class="jet-cw-dimensions">%s</span>',
					wc_format_dimensions( $product->get_dimensions( false ) )
				);

				return apply_filters( 'jet-cw/template-functions/dimension', $dimensions );

			}

		}

		/**
		 * Return product weight
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_weight( $product, $settings ) {

			if ( ! $product ) {
				return;
			}

			if ( $product->get_weight() ) {

				$weight = sprintf(
					'<span class="jet-cw-weight">%s %s</span>',
					$product->get_weight(),
					get_option( 'woocommerce_weight_unit' )
				);

				return apply_filters( 'jet-cw/template-functions/weight', $weight );

			}

		}

		/**
		 * Return product rating
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return bool|mixed|void
		 */
		public function get_rating( $product, $settings ) {

			$icon = empty( $settings['cw_rating_icon'] ) ? 'jetcomparewishlist-icon-rating-1' : $settings['cw_rating_icon'];

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
				return false;
			}

			$rating = $product->get_average_rating();

			if ( $rating > 0 ) {
				$rating_html = '<span class="jet-cw-rating-stars">';

				for ( $i = 1; $i <= 5; $i ++ ) {
					$is_active_class = ( $i <= $rating ) ? 'active' : '';
					$rating_html     .= sprintf( '<span class="product-rating__icon %s %s"></span>', $icon, $is_active_class );
				}

				$rating_html .= '</span>';

				return apply_filters( 'jet-cw/template-functions/rating', $rating_html );
			} else {
				return false;
			}

		}

		/**
		 * Return product price
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_price( $product, $settings ) {

			$price_html = $product->get_price_html();

			$price = sprintf(
				'<span class="jet-cw-price">%s</span>',
				$price_html
			);

			return apply_filters( 'jet-cw/template-functions/price', $price );

		}

		/**
		 * Return product excerpt
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_excerpt( $product, $settings ) {

			if ( ! $product->get_short_description() ) {
				return;
			}

			$excerpt = sprintf(
				'<span class="jet-cw-excerpt">%s</span>',
				get_the_excerpt( $product->get_id() )
			);

			return apply_filters( 'jet-cw/template-functions/excerpt', $excerpt );

		}

		/**
		 * Return product description
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_description( $product, $settings ) {

			if ( ! $product->get_description() ) {
				return;
			}

			$description = sprintf(
				'<span class="jet-cw-description">%s</span>',
				$product->get_description()
			);

			return apply_filters( 'jet-cw/template-functions/description', $description );
		}

		/**
		 * Return product add to cart button
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return string
		 */
		public function get_add_to_cart_button( $product, $settings ) {
			$args    = array();
			$classes = array();

			if ( $product ) {
				$defaults = apply_filters(
					'jet-cw/template-functions/add-to-cart-settings',
					array(
						'quantity'   => 1,
						'class'      => implode( ' ', array_filter( array(
							'button',
							$classes,
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
						) ) ),
						'attributes' => array(
							'data-product_id'  => $product->get_id(),
							'data-product_sku' => $product->get_sku(),
							'aria-label'       => $product->add_to_cart_description(),
							'rel'              => 'nofollow',
						),
					)
				);

				$args = wp_parse_args( $args, $defaults );

				$html = apply_filters( 'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
					sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
						esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
						isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
						esc_html( $product->add_to_cart_text() )
					),
					$product, $args );

				$html = '<div class="jet-cw-add-to-cart">' . $html . '</div>';

				return $html;
			}
		}

		/**
		 * Return product categories
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_categories( $product, $settings ) {
			$separator = '<span class="separator">&#44;&nbsp;</span></li><li>';
			$before    = '<ul><li>';
			$after     = '</li></ul>';

			$categories_list = get_the_term_list( $product->get_id(), 'product_cat', $before, $separator, $after );

			if ( ! $categories_list ) {
				return;
			}

			$categories = sprintf(
				'<span class="jet-cw-categories">%s</span>',
				$categories_list
			);

			return apply_filters( 'jet-cw/template-functions/categories', $categories );

		}

		/**
		 * Return product tags
		 *
		 * @param $product
		 * @param $settings
		 *
		 * @return mixed|void
		 */
		public function get_tags( $product, $settings ) {
			$separator = '<span class="separator">&#44;&nbsp;</span></li><li>';
			$before    = '<ul><li>';
			$after     = '</li></ul>';

			$tags_list = get_the_term_list( $product->get_id(), 'product_tag', $before, $separator, $after );

			if ( ! $tags_list ) {
				return;
			}

			$categories = sprintf(
				'<span class="jet-cw-tags">%s</span>',
				$tags_list
			);

			return apply_filters( 'jet-cw/template-functions/tags', $categories );
		}

		/**
		 * Return visible product attributes
		 *
		 * @param $products
		 *
		 * @return array
		 */
		public function get_visible_products_attributes( $products ) {

			$visible_attributes = array();

			foreach ( $products as $product ) {

				$has_attributes = $product->has_attributes();

				if ( $has_attributes ) {

					$attributes = $product->get_attributes();

					foreach ( $attributes as $key => $attribute ) {
						if ( $attribute->is_taxonomy() ) {
							$visible_attributes[ $key ] = wc_attribute_label( $key, $product );
						} else {
							$visible_attributes[ $key ] = $attribute->get_name();
						}
					}

				}

			}

			return $visible_attributes;

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
 * Returns instance of Jet_CW_Functions
 *
 * @return object
 */
function jet_cw_functions() {
	return Jet_CW_Functions::get_instance();
}
