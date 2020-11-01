<?php
/**
 * Scripts Enqueue Class for Admin pages.
 *
 * This class enqueues required styles & scripts in the admin pages.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Admin;

use AuroraSlider\Base\Enqueue;

/**
 * Admin Enqueue Class.
 *
 * @since  1.0.0
 */
class AdminEnqueue extends Enqueue {

	/**
	 * Method to register admin scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->scripts_list();

		if ( empty( $this->scripts_list() ) ) {
			return;
		}

		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Method to build up scripts & styles list.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return mixed
	 */
	private function scripts_list() {
		$this->enqueues = array(
			'style'  => array(
				array(
					'handle'    => 'aurora-admin-styles',
					'asset_uri' => $this->plugin_url . 'assets/css/admin' . $this->suffix . '.css',
				),
			),

			'script' => array(
				array(
					'handle'    => 'aurora-admin-scripts',
					'asset_uri' => $this->plugin_url . 'assets/js/admin' . $this->suffix . '.js',
				),
			),
		);

		return $this->enqueues;
	}

	/**
	 * Method to enqueue scripts only on Aurora Slider pages.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @param  mixed $hook list of admin pages.
	 * @return void
	 */
	public function enqueue( $hook ) {
		global $post;

		if ( 'post-new.php' === $hook || 'post.php' === $hook ) {
			if ( 'aurora_slider' === $post->post_type ) {
				$this->register_scripts()->enqueue_scripts();
			}
		}

		if ( 'aurora_slider_page_aurora-slider-settings' === $hook ) {
			$this->register_scripts()->enqueue_scripts();
		}
	}
}
