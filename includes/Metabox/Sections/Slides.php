<?php
/**
 * Slides Section Metabox class.
 *
 * This class is responsible for creating complex section metaboxes under
 * slides tab.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Metabox\Sections;

use Carbon_Fields\Field;
use AuroraSlider\Metabox\Sections\TextContent as TextContentSection;

/**
 * Slides Section Class.
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
	 * Method to add metabox section fields under slides tab.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::layer()->image()->texts();

		return self::$fields;
	}

	/**
	 * Method to add layer settings metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function layer() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_image_text_slider_sep',
			esc_html__( 'Layer', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'radio',
			'aurora_layer_position',
			esc_html__( 'Layer Alignment', 'aurora-slider' )
		)
		->set_options(
			array(
				'left'   => esc_html__( 'Left', 'aurora-slider' ),
				'center' => esc_html__( 'Center', 'aurora-slider' ),
				'right'  => esc_html__( 'Right', 'aurora-slider' ),
			)
		);

		self::$fields[] = Field::make(
			'text',
			'aurora_layer_width',
			esc_html__( 'Layer Max Width', 'aurora-slider' )
		)
		->set_default_value( '50%' );

		self::$fields[] = Field::make(
			'switch',
			'aurora_layer_bg_enable',
			esc_html__( 'Enable Layer Background Color?', 'aurora-slider' )
		)
		->set_default_value( false );

		self::$fields[] = Field::make(
			'color',
			'aurora_layer_bg_color',
			esc_html__( 'Layer Bakground Color', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'aurora_layer_bg_enable',
					'value'   => true,
					'compare' => '=',
				),
			)
		)
		->set_palette( array( '#FFFFFF', '#FF0000', '#00FF00', '#0000FF' ) )
		->set_alpha_enabled( true );

		return new static();
	}

	/**
	 * Method to add image settings metabox.
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
			'aurora_layer_slider_image_sep',
			esc_html__( 'Slide Image', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'image',
			'aurora_layer_slider_image',
			esc_html__( 'Slide Background Image', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'select',
			'aurora_layer_slider_image_position',
			esc_html__( 'Background Image Position', 'aurora-slider' )
		)
		->set_options(
			array(
				'left'   => esc_html__( 'Left', 'aurora-slider' ),
				'center' => esc_html__( 'Center', 'aurora-slider' ),
				'right'  => esc_html__( 'Right', 'aurora-slider' ),
			)
		)
		->set_default_value( 'center' )
		->set_width( 33.33 );

		self::$fields[] = Field::make(
			'select',
			'aurora_layer_slider_image_repeat',
			esc_html__( 'Background Image Repeat', 'aurora-slider' )
		)
		->set_options(
			array(
				'repeat'    => esc_html__( 'Repeat', 'aurora-slider' ),
				'no-repeat' => esc_html__( 'No Repeat', 'aurora-slider' ),
			)
		)
		->set_default_value( 'no-repeat' )
		->set_width( 33.33 );

		self::$fields[] = Field::make(
			'select',
			'aurora_layer_slider_image_size',
			esc_html__( 'Background Image Size', 'aurora-slider' )
		)
		->set_options(
			array(
				'auto'    => esc_html__( 'Auto', 'aurora-slider' ),
				'contain' => esc_html__( 'Contain', 'aurora-slider' ),
				'cover'   => esc_html__( 'Cover', 'aurora-slider' ),
			)
		)
		->set_default_value( 'cover' )
		->set_width( 33.33 );

		return new static();
	}

	/**
	 * Method to add image settings metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function texts() {
		self::$fields[] = Field::make(
			'complex',
			'aurora_layer_slider_texts',
			esc_html__( 'Slider Contents', 'aurora-slider' )
		)
		->set_layout( 'tabbed-horizontal' )
		->setup_labels(
			array(
				'singular_name' => esc_html__( 'Content', 'aurora-slider' ),
				'plural_name'   => esc_html__( 'Contents', 'aurora-slider' ),
			)
		)
		->add_fields(
			'slider_text',
			TextContentSection::register()
		)
		->add_fields(
			'slider_button',
			array(
				Field::make(
					'text',
					'btn_text',
					esc_html__( 'Button Text', 'aurora-slider' )
				),
			)
		);

		return new static();
	}
}
