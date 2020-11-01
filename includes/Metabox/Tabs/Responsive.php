<?php
/**
 * Responsive Metabox class.
 *
 * This class is responsible for creating metaboxes under responsive tab.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Metabox\Tabs;

use Carbon_Fields\Field;

/**
 * Responsive Class.
 *
 * @since  1.0.0
 */
class Responsive {

	/**
	 * Accumulates metabox fields.
	 *
	 * @access private
	 * @since  1.0.0
	 * @static
	 *
	 * @var array
	 */
	private static $fields;

	/**
	 * Method to add metabox fields under responsive tab.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::responsive();

		return self::$fields;
	}

	/**
	 * Method to add slider responsive metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function responsive() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_slider_res_sep',
			esc_html__( 'Responsive', 'aurora-slider' )
		);

		return new static();
	}
}
