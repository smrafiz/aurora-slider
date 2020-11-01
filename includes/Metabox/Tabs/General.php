<?php
/**
 * General Metabox class.
 *
 * This class is responsible for creating metaboxes under general tab.
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
class General {

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
	 * Method to add metabox fields under general tab.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::type()->layout()->content();

		return self::$fields;
	}

	/**
	 * Method to add slider type metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function type() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_slider_type_sep',
			esc_html__( 'Slider Type', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'radio_image',
			'aurora_slider_type',
			''
		)
		->set_options(
			array(
				'standard' => 'https://source.unsplash.com/X1UTzW8e7Q4/800x600',
				'carousel' => 'https://source.unsplash.com/5c8fczgvar0/800x600',
			)
		)
		->set_help_text(
			esc_html__( 'Please choose what type of slider you need', 'aurora-slider' )
		)
		->set_default_value( 'standard' );

		return new static();
	}

	/**
	 * Method to add slider layout metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function layout() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_slider_layout_sep',
			esc_html__( 'Slider Layout', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'radio_image',
			'aurora_slider_layout',
			''
		)
		->set_options(
			array(
				'standard'   => 'https://source.unsplash.com/X1UTzW8e7Q4/800x600',
				'fullwidth'  => 'https://source.unsplash.com/5c8fczgvar0/800x600',
				'fullscreen' => 'https://source.unsplash.com/ioJVccFmWxE/800x600',
			)
		)
		->set_help_text(
			esc_html__( 'Please choose what type of layout you need', 'aurora-slider' )
		)
		->set_default_value( 'standard' );

		return new static();
	}


	/**
	 * Method to add slider content metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function content() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_content_type_sep',
			esc_html__( 'Content Type', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'radio_image',
			'aurora_content_type',
			''
		)
		->set_options(
			array(
				'image'      => 'https://source.unsplash.com/X1UTzW8e7Q4/800x600',
				'image-text' => 'https://source.unsplash.com/ioJVccFmWxE/800x600',
			)
		)
		->set_help_text(
			esc_html__( 'Please choose content type', 'aurora-slider' )
		)
		->set_default_value( 'image-text' );

		return new static();
	}
}
