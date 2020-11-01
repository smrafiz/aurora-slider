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

use AuroraSlider\Admin\AdminPage;
use AuroraSlider\Admin\AdminEnqueue;
use AuroraSlider\Base\BaseController;

/**
 * Admin Controller Class.
 *
 * @since 1.0.0
 */
class AdminController extends BaseController {

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
			AdminPage::class,
			AdminEnqueue::class,
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
		if ( ! in_array( 'admin_manager', $this->managers, true ) ) {
			return;
		}

		if ( ! is_admin() ) {
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
