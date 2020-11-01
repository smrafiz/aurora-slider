<?php
/**
 * Slides Text Content Metabox class.
 *
 * This class is responsible for creating complex section metaboxes under
 * slides tab.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Metabox\Sections;

use Carbon_Fields\Field;

/**
 * Text Content Section Class.
 *
 * @since  1.0.0
 */
class TextContent {

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
		self::text_content()->typography()->animations();

		return self::$fields;
	}

	/**
	 * Method to add text content settings metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function text_content() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_content_sep',
			esc_html__( 'Content', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'select',
			'aurora_content_text_tag',
			esc_html__( 'Choose Text Tag', 'aurora-slider' )
		)
		->set_options(
			array(
				'h1' => 'H1',
				'h2' => 'H2',
				'h3' => 'H3',
				'h4' => 'H4',
				'h5' => 'H5',
				'h5' => 'H6',
				'p'  => 'p',
			)
		);

		self::$fields[] = Field::make(
			'textarea',
			'aurora_content_text',
			esc_html__( 'Text', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'radio',
			'aurora_content_text_position',
			esc_html__( 'Text Position', 'aurora-slider' )
		)
		->set_options(
			array(
				'left'   => esc_html__( 'Left', 'aurora-slider' ),
				'center' => esc_html__( 'Center', 'aurora-slider' ),
				'right'  => esc_html__( 'Right', 'aurora-slider' ),
			)
		);

		return new static();
	}

	/**
	 * Method to add typography settings metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function typography() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_typo_sep',
			esc_html__( 'Typography', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'range',
			'aurora_content_text_font_size',
			esc_html__( 'Enter Font Size', 'aurora-slider' )
		)
		->set_width( 50 )
		->set_attribute( 'min', '1' )
		->set_attribute( 'max', '200' )
		->set_default_value( 40 );

		self::$fields[] = Field::make(
			'range',
			'aurora_content_text_line_height',
			esc_html__( 'Enter Line Height', 'aurora-slider' )
		)
		->set_width( 50 )
		->set_attribute( 'min', '0.5' )
		->set_attribute( 'max', '4.0' )
		->set_attribute( 'step', '0.05' )
		->set_default_value( 1.4 );

		return new static();
	}

	/**
	 * Method to add animations settings metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function animations() {
		self::$fields[] = Field::make(
			'separator',
			'aurora_anim_sep',
			esc_html__( 'Animation', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'switch',
			'aurora_layer_animation',
			esc_html__( 'Enable Layer Animation?', 'aurora-slider' )
		);

		self::$fields[] = Field::make(
			'select',
			'aurora_layer_animation_type',
			esc_html__( 'Choose Animation', 'aurora-slider' )
		)
		->set_options( self::animations_list() )
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_layer_animation',
					'value'   => true,
					'compare' => '=',
				),
			)
		);

		self::$fields[] = Field::make(
			'text',
			'aurora_layer_animation_duration',
			esc_html__( 'Animation Duration', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_layer_animation',
					'value'   => true,
					'compare' => '=',
				),
			)
		);

		self::$fields[] = Field::make(
			'text',
			'aurora_layer_animation_delay',
			esc_html__( 'Animation Delay', 'aurora-slider' )
		)
		->set_conditional_logic(
			array(
				array(
					'field'   => 'aurora_layer_animation',
					'value'   => true,
					'compare' => '=',
				),
			)
		);

		return new static();
	}

	/**
	 * Method to build up animations list.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function animations_list() {
		return array(
			'bounce'             => ucfirst( esc_html__( 'bounce', 'aurora-slider' ) ),
			'flash'              => ucfirst( esc_html__( 'flash', 'aurora-slider' ) ),
			'pulse'              => ucfirst( esc_html__( 'pulse', 'aurora-slider' ) ),
			'rubberBand'         => ucfirst( esc_html__( 'rubberBand', 'aurora-slider' ) ),
			'shakeX'             => ucfirst( esc_html__( 'shakeX', 'aurora-slider' ) ),
			'shakeY'             => ucfirst( esc_html__( 'shakeY', 'aurora-slider' ) ),
			'headShake'          => ucfirst( esc_html__( 'headShake', 'aurora-slider' ) ),
			'swing'              => ucfirst( esc_html__( 'swing', 'aurora-slider' ) ),
			'tada'               => ucfirst( esc_html__( 'tada', 'aurora-slider' ) ),
			'wobble'             => ucfirst( esc_html__( 'wobble', 'aurora-slider' ) ),
			'jello'              => ucfirst( esc_html__( 'jello', 'aurora-slider' ) ),
			'heartBeat'          => ucfirst( esc_html__( 'heartBeat', 'aurora-slider' ) ),
			'backInDown'         => ucfirst( esc_html__( 'backInDown', 'aurora-slider' ) ),
			'backInLeft'         => ucfirst( esc_html__( 'backInLeft', 'aurora-slider' ) ),
			'backInRight'        => ucfirst( esc_html__( 'backInRight', 'aurora-slider' ) ),
			'backInUp'           => ucfirst( esc_html__( 'backInUp', 'aurora-slider' ) ),
			'backOutDown'        => ucfirst( esc_html__( 'backOutDown', 'aurora-slider' ) ),
			'backOutLeft'        => ucfirst( esc_html__( 'backOutLeft', 'aurora-slider' ) ),
			'backOutRight'       => ucfirst( esc_html__( 'backOutRight', 'aurora-slider' ) ),
			'backOutUp'          => ucfirst( esc_html__( 'backOutUp', 'aurora-slider' ) ),
			'bounceIn'           => ucfirst( esc_html__( 'bounceIn', 'aurora-slider' ) ),
			'bounceInDown'       => ucfirst( esc_html__( 'bounceInDown', 'aurora-slider' ) ),
			'bounceInLeft'       => ucfirst( esc_html__( 'bounceInLeft', 'aurora-slider' ) ),
			'bounceInRight'      => ucfirst( esc_html__( 'bounceInRight', 'aurora-slider' ) ),
			'bounceInUp'         => ucfirst( esc_html__( 'bounceInUp', 'aurora-slider' ) ),
			'bounceOut'          => ucfirst( esc_html__( 'bounceOut', 'aurora-slider' ) ),
			'bounceOutDown'      => ucfirst( esc_html__( 'bounceOutDown', 'aurora-slider' ) ),
			'bounceOutLeft'      => ucfirst( esc_html__( 'bounceOutLeft', 'aurora-slider' ) ),
			'bounceOutRight'     => ucfirst( esc_html__( 'bounceOutRight', 'aurora-slider' ) ),
			'bounceOutUp'        => ucfirst( esc_html__( 'bounceOutUp', 'aurora-slider' ) ),
			'fadeIn'             => ucfirst( esc_html__( 'fadeIn', 'aurora-slider' ) ),
			'fadeInDown'         => ucfirst( esc_html__( 'fadeInDown', 'aurora-slider' ) ),
			'fadeInDownBig'      => ucfirst( esc_html__( 'fadeInDownBig', 'aurora-slider' ) ),
			'fadeInLeft'         => ucfirst( esc_html__( 'fadeInLeft', 'aurora-slider' ) ),
			'fadeInLeftBig'      => ucfirst( esc_html__( 'fadeInLeftBig', 'aurora-slider' ) ),
			'fadeInRight'        => ucfirst( esc_html__( 'fadeInRight', 'aurora-slider' ) ),
			'fadeInRightBig'     => ucfirst( esc_html__( 'fadeInRightBig', 'aurora-slider' ) ),
			'fadeInUp'           => ucfirst( esc_html__( 'fadeInUp', 'aurora-slider' ) ),
			'fadeInUpBig'        => ucfirst( esc_html__( 'fadeInUpBig', 'aurora-slider' ) ),
			'fadeInTopLeft'      => ucfirst( esc_html__( 'fadeInTopLeft', 'aurora-slider' ) ),
			'fadeInTopRight'     => ucfirst( esc_html__( 'fadeInTopRight', 'aurora-slider' ) ),
			'fadeInBottomLeft'   => ucfirst( esc_html__( 'fadeInBottomLeft', 'aurora-slider' ) ),
			'fadeInBottomRight'  => ucfirst( esc_html__( 'fadeInBottomRight', 'aurora-slider' ) ),
			'fadeOut'            => ucfirst( esc_html__( 'fadeOut', 'aurora-slider' ) ),
			'fadeOutDown'        => ucfirst( esc_html__( 'fadeOutDown', 'aurora-slider' ) ),
			'fadeOutDownBig'     => ucfirst( esc_html__( 'fadeOutDownBig', 'aurora-slider' ) ),
			'fadeOutLeft'        => ucfirst( esc_html__( 'fadeOutLeft', 'aurora-slider' ) ),
			'fadeOutLeftBig'     => ucfirst( esc_html__( 'fadeOutLeftBig', 'aurora-slider' ) ),
			'fadeOutRight'       => ucfirst( esc_html__( 'fadeOutRight', 'aurora-slider' ) ),
			'fadeOutRightBig'    => ucfirst( esc_html__( 'fadeOutRightBig', 'aurora-slider' ) ),
			'fadeOutUp'          => ucfirst( esc_html__( 'fadeOutUp', 'aurora-slider' ) ),
			'fadeOutUpBig'       => ucfirst( esc_html__( 'fadeOutUpBig', 'aurora-slider' ) ),
			'fadeOutTopLeft'     => ucfirst( esc_html__( 'fadeOutTopLeft', 'aurora-slider' ) ),
			'fadeOutTopRight'    => ucfirst( esc_html__( 'fadeOutTopRight', 'aurora-slider' ) ),
			'fadeOutBottomRight' => ucfirst( esc_html__( 'fadeOutBottomRight', 'aurora-slider' ) ),
			'fadeOutBottomLeft'  => ucfirst( esc_html__( 'fadeOutBottomLeft', 'aurora-slider' ) ),
			'flip'               => ucfirst( esc_html__( 'flip', 'aurora-slider' ) ),
			'flipInX'            => ucfirst( esc_html__( 'flipInX', 'aurora-slider' ) ),
			'flipInY'            => ucfirst( esc_html__( 'flipInY', 'aurora-slider' ) ),
			'flipOutX'           => ucfirst( esc_html__( 'flipOutX', 'aurora-slider' ) ),
			'flipOutY'           => ucfirst( esc_html__( 'flipOutY', 'aurora-slider' ) ),
			'Lightspeed'         => ucfirst( esc_html__( 'Lightspeed', 'aurora-slider' ) ),
			'lightSpeedInRight'  => ucfirst( esc_html__( 'lightSpeedInRight', 'aurora-slider' ) ),
			'lightSpeedInLeft'   => ucfirst( esc_html__( 'lightSpeedInLeft', 'aurora-slider' ) ),
			'lightSpeedOutRight' => ucfirst( esc_html__( 'lightSpeedOutRight', 'aurora-slider' ) ),
			'lightSpeedOutLeft'  => ucfirst( esc_html__( 'lightSpeedOutLeft', 'aurora-slider' ) ),
			'rotateIn'           => ucfirst( esc_html__( 'rotateIn', 'aurora-slider' ) ),
			'rotateInDownLeft'   => ucfirst( esc_html__( 'rotateInDownLeft', 'aurora-slider' ) ),
			'rotateInDownRight'  => ucfirst( esc_html__( 'rotateInDownRight', 'aurora-slider' ) ),
			'rotateInUpLeft'     => ucfirst( esc_html__( 'rotateInUpLeft', 'aurora-slider' ) ),
			'rotateInUpRight'    => ucfirst( esc_html__( 'rotateInUpRight', 'aurora-slider' ) ),
			'rotateOut'          => ucfirst( esc_html__( 'rotateOut', 'aurora-slider' ) ),
			'rotateOutDownLeft'  => ucfirst( esc_html__( 'rotateOutDownLeft', 'aurora-slider' ) ),
			'rotateOutDownRight' => ucfirst( esc_html__( 'rotateOutDownRight', 'aurora-slider' ) ),
			'rotateOutUpLeft'    => ucfirst( esc_html__( 'rotateOutUpLeft', 'aurora-slider' ) ),
			'rotateOutUpRight'   => ucfirst( esc_html__( 'rotateOutUpRight', 'aurora-slider' ) ),
			'hinge'              => ucfirst( esc_html__( 'hinge', 'aurora-slider' ) ),
			'jackInTheBox'       => ucfirst( esc_html__( 'jackInTheBox', 'aurora-slider' ) ),
			'rollIn'             => ucfirst( esc_html__( 'rollIn', 'aurora-slider' ) ),
			'rollOut'            => ucfirst( esc_html__( 'rollOut', 'aurora-slider' ) ),
			'zoomIn'             => ucfirst( esc_html__( 'zoomIn', 'aurora-slider' ) ),
			'zoomInDown'         => ucfirst( esc_html__( 'zoomInDown', 'aurora-slider' ) ),
			'zoomInLeft'         => ucfirst( esc_html__( 'zoomInLeft', 'aurora-slider' ) ),
			'zoomInRight'        => ucfirst( esc_html__( 'zoomInRight', 'aurora-slider' ) ),
			'zoomInUp'           => ucfirst( esc_html__( 'zoomInUp', 'aurora-slider' ) ),
			'zoomOut'            => ucfirst( esc_html__( 'zoomOut', 'aurora-slider' ) ),
			'zoomOutDown'        => ucfirst( esc_html__( 'zoomOutDown', 'aurora-slider' ) ),
			'zoomOutLeft'        => ucfirst( esc_html__( 'zoomOutLeft', 'aurora-slider' ) ),
			'zoomOutRight'       => ucfirst( esc_html__( 'zoomOutRight', 'aurora-slider' ) ),
			'zoomOutUp'          => ucfirst( esc_html__( 'zoomOutUp', 'aurora-slider' ) ),
			'slideInDown'        => ucfirst( esc_html__( 'slideInDown', 'aurora-slider' ) ),
			'slideInLeft'        => ucfirst( esc_html__( 'slideInLeft', 'aurora-slider' ) ),
			'slideInRight'       => ucfirst( esc_html__( 'slideInRight', 'aurora-slider' ) ),
			'slideInUp'          => ucfirst( esc_html__( 'slideInUp', 'aurora-slider' ) ),
			'slideOutDown'       => ucfirst( esc_html__( 'slideOutDown', 'aurora-slider' ) ),
			'slideOutLeft'       => ucfirst( esc_html__( 'slideOutLeft', 'aurora-slider' ) ),
			'slideOutRight'      => ucfirst( esc_html__( 'slideOutRight', 'aurora-slider' ) ),
			'slideOutUp'         => ucfirst( esc_html__( 'slideOutUp', 'aurora-slider' ) ),
		);
	}
}
