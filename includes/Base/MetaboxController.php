<?php
/**
 * The admin controller class.
 *
 * The class is responsible for initializing all the modules of Admin Pages.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Base;

use AuroraSlider\Base\BaseController;
use AuroraSlider\Metabox\Metaboxes;

/**
 * Admin Controller Class.
 *
 * @since 1.0.0
 */
class MetaboxController extends BaseController {

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
			Metaboxes::class,
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
		if ( ! in_array( 'metabox_manager', $this->managers, true ) ) {
			return;
		}

		foreach ( self::get_services() as $class ) {
			$service = BaseController::instance( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}
}
