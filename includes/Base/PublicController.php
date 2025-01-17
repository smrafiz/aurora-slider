<?php
/**
 * The public controller class.
 *
 * The class is responsible for initializing all the modules for frontend view.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Base;

use AuroraSlider\Frontend\Shortcodes;
use AuroraSlider\Frontend\PublicEnqueue;
use AuroraSlider\Base\BaseController;

/**
 * Public Controller Class.
 *
 * @since 1.0.0
 */
class PublicController extends BaseController {

	/**
	 * Stores all the classes inside an array.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array Full list of classes
	 */
	private static function get_services() {
		return array(
			Shortcodes::class,
			PublicEnqueue::class,
		);
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public function register() {
		foreach ( self::get_services() as $class ) {
			$service = BaseController::instance( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}
}
