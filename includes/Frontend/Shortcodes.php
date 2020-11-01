<?php
/**
 * Main Shortcodes Class.
 *
 * This class registers necessary shortcodes to render in the frontend.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Frontend;

use AuroraSlider\Base\PublicController;

/**
 * Shortcodes Class.
 *
 * @since  1.0.0
 */
class Shortcodes extends PublicController {

	/**
	 * Method to register all shortcodes.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		if ( ! in_array( 'shortcode_manager', $this->managers, true ) ) {
			return;
		}

		\add_action( 'init', array( $this, 'register_shortcodes' ) );
	}

	/**
	 * Stores all the shortcode classes inside an array.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array Full list of classes
	 */
	private static function get_shortcodes() {
		return array(
			Shortcodes\Slider::class,
			Shortcodes\Carousel::class,
		);
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_shortcodes() {
		foreach ( self::get_shortcodes() as $class ) {
			$shortcode = PublicController::instance( $class );

			if ( method_exists( $shortcode, 'register' ) ) {
				$shortcode->register();
			}
		}
	}
}
