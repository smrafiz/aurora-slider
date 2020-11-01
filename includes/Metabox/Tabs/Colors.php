<?php
/**
 * Colors Metabox class.
 *
 * This class is responsible for creating metaboxes under color tab.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Metabox\Tabs;

use Carbon_Fields\Field;

/**
 * Colors Class.
 *
 * @since  1.0.0
 */
class Colors {

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
	 * Method to add metabox fields under size tab.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::colors();

		return self::$fields;
	}

	/**
	 * Method to add slider color metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function colors() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_slider_color_sep',
			esc_html__( 'Background Color and Overlay', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'switch',
			'aurora_slides_bg_color',
			esc_html__( 'Enable Slides Background Color?', 'aurora-slider' )
		)
		->set_width( 50 )
		->set_default_value( false );


		self::$fields[] = Field::make(
			'color',
			'aurora_bg_color',
			esc_html__( 'Slides Bakground Color', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'aurora_slides_bg_color',
					'value'   => true,
					'compare' => '=',
				),
			)
		)
		->set_width( 50 )
		->set_palette( array( '#FFFFFF', '#FF0000', '#00FF00', '#0000FF' ) )
		->set_alpha_enabled( true );

		self::$fields[] = Field::make(
			'switch',
			'aurora_slides_overlay',
			esc_html__( 'Enable Slides Overlay Color?', 'aurora-slider' )
		)
		->set_width( 50 )
		->set_default_value( false );

		self::$fields[] = Field::make(
			'color',
			'aurora_overlay_color',
			esc_html__( 'Slides Overlay Color', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'aurora_slides_overlay',
					'value'   => true,
					'compare' => '=',
				),
			)
		)
		->set_width( 50 )
		->set_palette( array( '#FFFFFF', '#FF0000', '#00FF00', '#0000FF' ) )
		->set_alpha_enabled( true );

		return new static();
	}
}
