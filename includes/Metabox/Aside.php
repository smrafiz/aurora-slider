<?php
/**
 * Aside Metabox class.
 *
 * This class is responsible for rendering the sidebar shortcode name.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Metabox;

use Carbon_Fields\Field;

/**
 * Aside Class.
 *
 * @since  1.0.0
 */
class Aside {

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
	 * Method to render aside content.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::slider_shortcode();

		return self::$fields;
	}

	/**
	 * Method to add slider shortcode metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function slider_shortcode() {
		self::$fields = array();

		self::$fields[] = Field::make(
			'text',
			'aurora_slider_shortcode',
			esc_html__( 'Slider Shortcode', 'aurora-slider' )
		)
		->set_attribute( 'readOnly', true )
		->set_default_value( self::shortcode_name() );

		return new static();
	}

	/**
	 * Method to render shortcode name.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return string
	 */
	private static function shortcode_name() {
		$shortcode = '';
		$post_id   = isset( $_GET['post'] ) ? absint( wp_unslash( $_GET['post'] ) ) : '';

		if ( empty( $post_id ) ) {
			return;
		}

		$type = \get_post_meta( $post_id, '_aurora_slider_type', true );

		if ( 'standard' === $type ) {
			$shortcode = esc_attr( 'slider' );
		} else {
			$shortcode = esc_attr( 'carousel' );
		}

		return \wp_kses_post( '[aurora_' . $shortcode . ' id="' . $post_id . '"]' );
	}
}
