<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Base;

/**
 * Plugin Deactivation Class.
 *
 * @since  1.0.0
 */
class Deactivate {

	/**
	 * Method to run on plugin deactivation.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public static function deactivate() {
		\flush_rewrite_rules();
	}
}
