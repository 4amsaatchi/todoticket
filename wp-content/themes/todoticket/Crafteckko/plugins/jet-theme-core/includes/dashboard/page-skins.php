<?php
/**
 * Skins page
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Theme_Core_Dashboard_Skins' ) ) {

	/**
	 * Define Jet_Theme_Core_Dashboard_Skins class
	 */
	class Jet_Theme_Core_Dashboard_Skins extends Jet_Theme_Core_Dashboard_Base {

		private $has_license = null;

		/**
		 * Initialize globally
		 *
		 * @return void
		 */
		public function init_glob() {
			add_filter( 'jet-data-importer/success-buttons', array( $this, 'add_install_skin_button' ) );
		}

		public function add_install_skin_button( $buttons ) {

			$buttons['install-skin'] = array(
				'label'  => __( 'Select skin', 'jet-theme-core' ),
				'type'   => 'primary',
				'target' => '_self',
				'icon'   => 'dashicons-format-gallery',
				'desc'   => __( 'Switch the current skin to another one', 'jet-theme-core' ),
				'url'    => $this->get_current_page_link(),
			);

			return $buttons;
		}

		/**
		 * Page slug
		 *
		 * @return string
		 */
		public function get_slug() {
			return 'skins';
		}

		/**
		 * Get icon
		 *
		 * @return string
		 */
		public function get_icon() {
			return 'dashicons dashicons-format-gallery';
		}

		/**
		 * Synchronize skins library
		 *
		 * @return void
		 */
		public function synch_skins() {

			$redirect = $this->get_current_page_link();

			if ( ! function_exists( 'jet_plugins_wizard_settings' ) ) {
				wp_redirect( $redirect );
				die();
			}

			jet_plugins_wizard_settings()->clear_transient_data();

			wp_redirect( $redirect );
			die();

		}

		/**
		 * Show install new skin link
		 *
		 * @param  string $slug Slug
		 * @return [type]       [description]
		 */
		public function install_skin_link( $slug = null ) {

			if ( ! function_exists( 'jet_plugins_wizard' ) ) {
				return '';
			}

			$license = $this->manager->get( 'license' );

			if ( $license ) {

				if ( null === $this->has_license ) {
					$this->has_license = $license->get_license();
				}

				if ( empty( $this->has_license ) ) {
					return;
				}

			}

			$next_step = 'configure-plugins';
			$url       = jet_plugins_wizard()->get_page_link( array(
				'step' => $next_step,
				'skin' => $slug,
				'type' => 'full'
			) );

			printf(
				'<a href="%1$s" class="cx-button cx-button-primary-style">%2$s</a>',
				$url,
				__( 'Install', 'jet-theme-core' )
			);
		}

		/**
		 * Print synchronise skins library URL
		 *
		 * @return void
		 */
		public function synch_skins_link() {

			echo add_query_arg(
				array(
					'jet_action' => $this->get_slug(),
					'handle'     => 'synch_skins',
				),
				esc_url( admin_url( 'admin.php' ) )
			);

		}

		/**
		 * Page name
		 *
		 * @return string
		 */
		public function get_name() {
			return esc_attr__( 'Skins', 'jet-theme-core' );
		}

		/**
		 * Renderer callback
		 *
		 * @return void
		 */
		public function render_page() {

			include jet_theme_core()->get_template( 'dashboard/skins/skins-actions.php' );

			$skins = jet_plugins_wizard_settings()->get( array( 'skins', 'advanced' ) );

			if ( ! empty( $skins ) ) {
				include jet_theme_core()->get_template( 'dashboard/skins/skins-list.php' );
			}
		}

	}

}
