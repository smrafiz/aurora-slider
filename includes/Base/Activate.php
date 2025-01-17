<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Base;

/**
 * Plugin Activation Class.
 *
 * @since  1.0.0
 */
class Activate {

	/**
	 * Method to run on plugin activation.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public static function activate() {
		\flush_rewrite_rules();
	}
}
