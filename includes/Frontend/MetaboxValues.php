<?php
/**
 * Metabox values Class.
 *
 * This class stores the saved metabox values.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Frontend;

/**
 * MetaboxValues Class.
 *
 * @since  1.0.0
 */
class MetaboxValues {

	/**
	 * Accumulates metabox values.
	 *
	 * @access private
	 * @since  1.0.0
	 * @static
	 *
	 * @var array
	 */
	private static $values = array();

	/**
	 * Method to return stored metabox values.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function fetch() {
		self::general()->slides()->controls()->navigation();

		if ( empty( self::$values ) ) {
			return;
		}

		return self::$values;
	}

	/**
	 * Method to store metabox values from general tab.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function general() {
		self::$values['type']    = \carbon_get_the_post_meta( 'aurora_slider_type' );
		self::$values['layout']  = \carbon_get_the_post_meta( 'aurora_slider_layout' );
		self::$values['content'] = \carbon_get_the_post_meta( 'aurora_content_type' );

		return new static();
	}

	/**
	 * Method to store metabox values from controls tab.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function controls() {
		self::$values['loop']   = \carbon_get_the_post_meta( 'aurora_slider_loop' );
		self::$values['effect'] = \carbon_get_the_post_meta( 'aurora_slide_transition' );

		return new static();
	}

	/**
	 * Method to store metabox values from slides tab.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function slides() {
		self::$values['slides'] = \carbon_get_the_post_meta( 'aurora_slider_image' );

		return new static();
	}

	/**
	 * Method to store metabox values from navigation tab.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function navigation() {
		self::$values['nav']     = \carbon_get_the_post_meta( 'aurora_slider_navigation' );
		self::$values['pag']     = \carbon_get_the_post_meta( 'aurora_slider_pagination' );
		self::$values['pagtype'] = \carbon_get_the_post_meta( 'aurora_slider_pagination_type' );
		self::$values['dynbull'] = \carbon_get_the_post_meta( 'aurora_slider_dynamic_bullets' );

		return new static();
	}
}
