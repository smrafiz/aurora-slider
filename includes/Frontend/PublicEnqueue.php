<?php
/**
 * Scripts Enqueue Class for frontend.
 *
 * This class enqueues required styles & scripts in the frontend.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Frontend;

use AuroraSlider\Base\Enqueue;

/**
 * Public Enqueue Class.
 *
 * @since  1.0.0
 */
class PublicEnqueue extends Enqueue {

	/**
	 * Method to register frontend scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		if ( ! in_array( 'enqueue_manager', $this->managers, true ) ) {
			return;
		}

		$this->scripts_list();

		if ( empty( $this->scripts_list() ) ) {
			return;
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
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
					'handle'    => 'animate',
					'asset_uri' => $this->plugin_url . 'assets/css/animate' . $this->suffix . '.css',
					'version'   => '4.1.0',
				),
				array(
					'handle'    => 'swiper',
					'asset_uri' => $this->plugin_url . 'assets/css/swiper' . $this->suffix . '.css',
					'version'   => '6.1.2',
				),
				array(
					'handle'    => 'aurora-frontend-styles',
					'asset_uri' => $this->plugin_url . 'assets/css/frontend' . $this->suffix . '.css',
				),
			),

			'script' => array(
				array(
					'handle'    => 'swiper',
					'asset_uri' => $this->plugin_url . 'assets/js/swiper' . $this->suffix . '.js',
					'version'   => '6.1.2',
				),
				array(
					'handle'     => 'swiper-animation-script',
					'asset_uri'  => $this->plugin_url . 'assets/js/swiper-animation' . $this->suffix . '.js',
					'version'    => '4.1.0',
					'dependency' => array( 'swiper' ),
				),
				array(
					'handle'     => 'aurora-frontend-script',
					'asset_uri'  => $this->plugin_url . 'assets/js/frontend' . $this->suffix . '.js',
					'dependency' => array( 'swiper', 'swiper-animation-script' ),
				),
			),
		);

		return $this->enqueues;
	}

	/**
	 * Method to enqueue only styles in the frontend.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public function enqueue() {
		$this->register_scripts()->enqueue_only_styles();
	}
}
