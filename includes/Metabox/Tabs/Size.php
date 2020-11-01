<?php
/**
 * Size Metabox class.
 *
 * This class is responsible for creating metaboxes under size tab.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Metabox\Tabs;

use Carbon_Fields\Field;

/**
 * Size Class.
 *
 * @since  1.0.0
 */
class Size {

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
		self::dimension()->responsive();

		return self::$fields;
	}

	/**
	 * Method to add slider dimension metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function dimension() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_slider_dimen_sep',
			esc_html__( 'Slider Dimension', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'text',
			'aurora_slider_width_std',
			esc_html__( 'Slider Width', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_layout',
					'value'   => 'standard',
					'compare' => '=',
				),
			)
		)
		->set_default_value( '100%' )
		->set_width( 50 );

		self::$fields[] = Field::make(
			'switch',
			'aurora_slider_width_fw',
			esc_html__( 'Force Full Width', 'aurora-slider' )
		)
			->set_conditional_logic(
				array(
					array(
						'field'   => 'aurora_slider_layout',
						'value'   => 'standard',
						'compare' => '!=',
					),
				)
			)
			->set_default_value( true )
			->set_width( 50 );

		self::$fields[] = Field::make(
			'text',
			'aurora_slider_height',
			esc_html__( 'Slider Height', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_layout',
					'value'   => 'fullscreen',
					'compare' => '!=',
				),
			)
		)
		->set_default_value( '500px' )
		->set_width( 50 );

		self::$fields[] = Field::make(
			'select',
			'aurora_slider_height_fs',
			esc_html__( 'Slider Height Based On', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_layout',
					'value'   => 'fullscreen',
					'compare' => '=',
				),
			)
		)
		->set_options(
			array(
				'real-height' => esc_html__( 'Real Height', 'aurora-slider' ),
				'css'         => esc_html__( 'CSS 100vh', 'aurora-slider' ),
			)
		)
		->set_width( 50 );

		return new static();
	}

	/**
	 * Method to add slider responsive dimension metabox.
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
			'aurora_slider_resp_sep',
			esc_html__( 'Slider Responsive Height', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'text',
			'aurora_slider_height_tablet',
			esc_html__( 'Slider Height On Tablet', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_layout',
					'value'   => array( 'standard', 'fullwidth' ),
					'compare' => 'IN',
				),
			)
		)
		->set_width( 50 );

		self::$fields[] = Field::make(
			'text',
			'aurora_slider_height_mobile',
			esc_html__( 'Slider Height On Mobile', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_layout',
					'value'   => array( 'standard', 'fullwidth' ),
					'compare' => 'IN',
				),
			)
		)
		->set_width( 50 );

		self::$fields[] = Field::make(
			'switch',
			'aurora_slider_height_tablet_fs_fixed',
			esc_html__( 'Fixed Slider Height On Tablet?', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_layout',
					'value'   => 'fullscreen',
					'compare' => '=',
				),
			)
		)
		->set_width( 50 );

		self::$fields[] = Field::make(
			'text',
			'aurora_slider_height_tablet_fs',
			esc_html__( 'Slider Height On Tablet', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_height_tablet_fs_fixed',
					'value'   => true,
					'compare' => '=',
				),
			)
		)
		->set_width( 50 );

		self::$fields[] = Field::make(
			'switch',
			'aurora_slider_height_mobile_fs_fixed',
			esc_html__( 'Fixed Slider Height On Mobile?', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_layout',
					'value'   => 'fullscreen',
					'compare' => '=',
				),
			)
		)
		->set_width( 50 );

		self::$fields[] = Field::make(
			'text',
			'aurora_slider_height_mobile_fs',
			esc_html__( 'Slider Height On Mobile', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_height_mobile_fs_fixed',
					'value'   => true,
					'compare' => '=',
				),
			)
		)
		->set_width( 50 );

		return new static();
	}
}
