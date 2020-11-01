<?php
/**
 * The core plugin class.
 *
 * The main handler class is responsible for initializing Aurora Slider.
 * This class registers all the core modules required to run the plugin.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider;

/**
 * Plugin Initialization Class.
 *
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Stores all the core classes inside an array.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array Full list of classes
	 */
	private static function get_services() {
		return array(
			Base\Locale::class,
			Base\SettingsLinks::class,
			Base\AdminController::class,
			Base\PublicController::class,
			Base\MetaboxController::class,
			Base\CarbonFieldsController::class,
			Base\CustomPostTypesController::class,
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
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instance( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Method to initialize the class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @param  class $class class from the services array.
	 * @return class new instance of the class
	 */
	private static function instance( $class ) {
		$service = new $class();

		return $service;
	}
}
