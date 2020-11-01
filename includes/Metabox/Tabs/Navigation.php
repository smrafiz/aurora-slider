<?php
/**
 * Navigation Metabox class.
 *
 * This class is responsible for creating metaboxes under navigation tab.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Metabox\Tabs;

use Carbon_Fields\Field;

/**
 * General Class.
 *
 * @since  1.0.0
 */
class Navigation {

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
	 * Method to add metabox fields under navigation tab.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::navigation();

		return self::$fields;
	}

	/**
	 * Method to add slider navigation metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function navigation() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_slider_nav_sep',
			esc_html__( 'Navigation', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'switch',
			'aurora_slider_navigation',
			esc_html__( 'Enable Navigation', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'switch',
			'aurora_slider_pagination',
			esc_html__( 'Enable Pagination', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'select',
			'aurora_slider_pagination_type',
			esc_html__( 'Pagination Type', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_pagination',
					'value'   => true,
					'compare' => '=',
				),
			)
		)
		->set_options(
			array(
				'bullets'     => esc_html__( 'Bullets', 'aurora-slider' ),
				'fraction'    => esc_html__( 'Fraction', 'aurora-slider' ),
				'progressbar' => esc_html__( 'Progress Bar', 'aurora-slider' ),
			)
		);

		self::$fields[] = Field::make(
			'switch',
			'aurora_slider_dynamic_bullets',
			esc_html__( 'Enable Dynamic Bullets', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_slider_pagination_type',
					'value'   => 'bullets',
					'compare' => '=',
				),
			)
		);

		return new static();
	}
}
