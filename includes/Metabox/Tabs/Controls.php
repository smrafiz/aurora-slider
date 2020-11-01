<?php
/**
 * Controls Metabox class.
 *
 * This class is responsible for creating metaboxes under controls tab.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Metabox\Tabs;

use Carbon_Fields\Field;

/**
 * Controls Class.
 *
 * @since  1.0.0
 */
class Controls {

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
	 * Method to add metabox fields under controls tab.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::controls()->transition();

		return self::$fields;
	}

	/**
	 * Method to add slider controls metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function controls() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_slider_controls_sep',
			esc_html__( 'Slider Controls', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'switch',
			'aurora_slider_hover_pause',
			esc_html__( 'Pause on Hover', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'switch',
			'aurora_slider_loop',
			esc_html__( 'Infinite Loop', 'aurora-slider' )
		);

		return new static();
	}

	/**
	 * Method to add slider transition metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function transition() {
		self::$fields[] = Field::make(
			'select',
			'aurora_slide_transition',
			esc_html__( 'Slide Transition Animation', 'aurora-slider' )
		)
		->set_options(
			array(
				'slide'     => esc_html__( 'Slide', 'aurora-slider' ),
				'fade'      => esc_html__( 'Fade', 'aurora-slider' ),
				'parallax'  => esc_html__( 'Slide Parallax', 'aurora-slider' ),
				'coverflow' => esc_html__( 'Coverflow', 'aurora-slider' ),
				'flip'      => esc_html__( 'Flip', 'aurora-slider' ),
				'cube'      => esc_html__( 'Cube', 'aurora-slider' ),
			)
		);

		return new static();
	}
}
