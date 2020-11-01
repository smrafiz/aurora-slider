<?php
/**
 * Carbon Fields Controller Class.
 *
 * This class initializes Carbon Fields.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Base;

/**
 * Plugin Carbon Fields Controller Class.
 *
 * @since  1.0.0
 */
class CarbonFieldsController {

	/**
	 * Method to initialize Carbon Fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		if ( ! class_exists( '\Carbon_Fields\Carbon_Fields' ) ) {
			return;
		}

		\add_action( 'after_setup_theme', array( $this, 'boot' ), 99 );
	}

	/**
	 * Method to boot Carbon Fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function boot() {
		\Carbon_Fields\Carbon_Fields::boot();
	}
}
