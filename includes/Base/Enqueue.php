<?php
/**
 * Main enqueue Class.
 *
 * This class registers all scripts & styles required for Aurora Slider.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Base;

use AuroraSlider\Base\BaseController;

/**
 * Enqueue Class.
 *
 * @since  1.0.0
 */
class Enqueue extends BaseController {

	/**
	 * Holds script file name suffix.
	 *
	 * @access protected
	 * @since  1.0.0
	 *
	 * @var string
	 */
	protected $suffix = null;

	/**
	 * Accumulates scripts.
	 *
	 * @access protected
	 * @since  1.0.0
	 *
	 * @var array
	 */
	protected $enqueues = array();

	/**
	 * Class Constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();

		$this->suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	}

	/**
	 * Method to register scripts.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return void|class
	 */
	protected function register_scripts() {

		if ( empty( $this->enqueues ) ) {
			return;
		}

		$wp_register_function = '';

		foreach ( $this->enqueues as $type => $enqueue ) {
			$wp_register_function = '\wp_register_' . $type;

			foreach ( $enqueue as $key ) {
				$wp_register_function(
					$key['handle'],
					$key['asset_uri'],
					! empty( $key['dependency'] ) ? $key['dependency'] : array(),
					! empty( $key['version'] ) ? $key['version'] : $this->plugin_version,
					( 'style' === $type ) ? 'all' : true
				);
			}
		}

		return $this;
	}

	/**
	 * Method to enqueue scripts.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return void
	 */
	protected function enqueue_scripts() {

		if ( empty( $this->enqueues ) ) {
			return;
		}

		$wp_enqueue_function = '';

		foreach ( $this->enqueues as $type => $enqueue ) {
			$wp_enqueue_function = '\wp_enqueue_' . $type;

			foreach ( $enqueue as $key ) {
				$wp_enqueue_function( $key['handle'] );
			}
		}
	}

	/**
	 * Method to enqueue styles only.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return void
	 */
	protected function enqueue_only_styles() {

		if ( empty( $this->enqueues ) ) {
			return;
		}

		foreach ( $this->enqueues as $type => $enqueue ) {
			if ( 'style' === $type ) {
				foreach ( $enqueue as $key ) {
					\wp_enqueue_style( $key['handle'] );
				}
			}
		}
	}
}
