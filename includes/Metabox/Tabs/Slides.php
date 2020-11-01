<?php
/**
 * Slides Metabox class.
 *
 * This class is responsible for creating metaboxes under slides tab.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Metabox\Tabs;

use Carbon_Fields\Field;
use AuroraSlider\Metabox\Sections\Slides as SlidesSection;

/**
 * Slides Class.
 *
 * @since  1.0.0
 */
class Slides {

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
	 * Method to add metabox fields under slides tab.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::image()->image_with_texts();

		return self::$fields;
	}

	/**
	 * Method to add image slider metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function image() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_slides_sep',
			esc_html__( 'Slides', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'media_gallery',
			'aurora_slider_image',
			esc_html__( 'Add Images', 'aurora-slider' )
		)
		->set_edit_inline( false )
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'aurora_content_type',
					'value'   => 'image',
					'compare' => '=',
				),
			)
		)
		->set_duplicates_allowed( false );

		return new static();
	}

	/**
	 * Method to add image with texts slider metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function image_with_texts() {
		self::$fields[] = Field::make(
			'complex',
			'aurora_image_text_slider',
			''
		)
		->set_layout( 'tabbed-vertical' )
		->setup_labels(
			array(
				'singular_name' => esc_html__( 'Slide', 'aurora-slider' ),
				'plural_name'   => esc_html__( 'Sliders', 'aurora-slider' ),
			)
		)
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'aurora_content_type',
					'value'   => 'image-text',
					'compare' => '=',
				),
			)
		)
		->add_fields(
			SlidesSection::register()
		);

		return new static();
	}
}
