<?php
/**
 * Plugin Helpers Class.
 *
 * This class is responsible for helper methods used throughout the plugin.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Lib;

/**
 * Helpers Class.
 *
 * @since  1.0.0
 */
class Helpers {

	/**
	 * Method to render the image markup.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @param string  $size image size.
	 * @param integer $id post id.
	 * @param string  $class image CSS class.
	 * @return void
	 */
	public static function render_image( $size = 'full', int $id = null, $class = '' ) {
		$alt_text = trim( \wp_strip_all_tags( \get_post_meta( absint( $id ), '_wp_attachment_image_alt', true ) ) );

		echo \wp_get_attachment_image(
			absint( $id ),
			esc_attr( $size ),
			false,
			array(
				'class' => esc_attr( $class ),
				'alt'   => esc_attr( $alt_text ),
			)
		);
	}
}
