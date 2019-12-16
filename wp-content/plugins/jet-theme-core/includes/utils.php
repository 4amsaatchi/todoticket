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

if ( ! class_exists( 'Jet_Theme_Core_Utils' ) ) {

	/**
	 * Define Jet_Theme_Core_Utils class
	 */
	class Jet_Theme_Core_Utils {

		/**
		 * Get post types options list
		 *
		 * @return array
		 */
		public static function get_post_types() {

			$post_types = get_post_types( array( 'public' => true ), 'objects' );

			$deprecated = apply_filters(
				'jet-theme-core/post-types-list/deprecated',
				array(
					'attachment',
					'elementor_library',
					jet_theme_core()->templates->post_type,
				)
			);

			$result = array();

			if ( empty( $post_types ) ) {
				return $result;
			}

			foreach ( $post_types as $slug => $post_type ) {

				if ( in_array( $slug, $deprecated ) ) {
					continue;
				}

				$result[ $slug ] = $post_type->label;

			}

			return $result;

		}

		public static function search_posts_by_type( $type, $query ) {

			add_filter( 'posts_where', array( __CLASS__, 'force_search_by_title' ), 10, 2 );

			$posts = get_posts( array(
				'post_type'           => $type,
				'ignore_sticky_posts' => true,
				'posts_per_page'      => -1,
				'suppress_filters'    => false,
				's_title'             => $query,
			) );

			remove_filter( 'posts_where', array( __CLASS__, 'force_search_by_title' ), 10, 2 );

			$result = array();

			if ( ! empty( $posts ) ) {
				foreach ( $posts as $post ) {
					$result[] = array(
						'id'   => $post->ID,
						'text' => $post->post_title,
					);
				}
			}

			return $result;
		}

		/**
		 * Force query to look in post title while searching
		 * @return [type] [description]
		 */
		public static function force_search_by_title( $where, $query ) {

			$args = $query->query;

			if ( ! isset( $args['s_title'] ) ) {
				return $where;
			} else {
				global $wpdb;

				$searh = esc_sql( $wpdb->esc_like( $args['s_title'] ) );
				$where .= " AND {$wpdb->posts}.post_title LIKE '%$searh%'";

			}

			return $where;
		}

		public static function search_terms_by_tax( $tax, $query ) {

			$terms = get_terms( array(
				'taxonomy'   => $tax,
				'hide_empty' => false,
				'name__like' => $query,
			) );

			$result = array();

			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					$result[] = array(
						'id'   => $term->term_id,
						'text' => $term->name,
					);
				}
			}

			return $result;

		}

	}

}
