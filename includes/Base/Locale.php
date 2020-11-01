<?php
/**
 * Internationalization Class.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Base;

use AuroraSlider\Base\BaseController;

/**
 * Locale Class.
 *
 * @since  1.0.0
 */
class Locale extends BaseController {

	/**
	 * Method to register localization.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		\add_action( 'plugins_loaded', array( $this, 'plugin_text_domain' ) );
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function plugin_text_domain() {
		\load_plugin_textdomain(
			$this->plugin_textdomain,
			false,
			$this->plugin_path . '/languages/'
		);
	}
}
