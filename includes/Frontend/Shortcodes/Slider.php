<?php
/**
 * Slider Shortcodes Class.
 *
 * This class adds slider shortcodes in the frontend.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Frontend\Shortcodes;

use AuroraSlider\Frontend\Shortcodes\Content\Standard;

/**
 * Slider Shortcodes Class.
 *
 * @since  1.0.0
 */
class Slider extends AbstractShortcode {

	/**
	 * Method to load the shortcode.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->shortcode_name = 'aurora_slider';
		\add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
	}

	/**
	 * Method to render the slider content.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return void
	 */
	protected function content_slider() {
		if ( 'standard' === $this->metabox_values['type'] ) {
			$standard = new Standard();
			$standard->render();
		}
	}

	/**
	 * Method to build up wrapper individual CSS class.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return array
	 */
	protected function wrapper_class_individual() {
		$classes = array();

		switch ( $this->metabox_values['layout'] ) {
			case 'standard':
				$classes[] = 'as-slideshow--layout-standard';
				break;
			case 'fullwidth':
				$classes[] = 'as-slideshow--layout-fullwidth';
				break;
			case 'fullscreen':
				$classes[] = 'as-slideshow--layout-fullscreen';
				break;
			default:
				$classes[] = 'as-slideshow--layout-standard';
				break;
		}

		switch ( $this->metabox_values['content'] ) {
			case 'image':
				$classes[] = 'as-slideshow--content-image';
				break;
			case 'image-text':
				$classes[] = 'as-slideshow--content-image-w-text';
				break;
			default:
				$classes[] = 'as-slideshow--content-image';
				break;
		}

		return $classes;
	}

	/**
	 * Method to build up individual data-attributes.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return string
	 */
	protected function data_attributes_individual() {
		$input = array();

		if ( $this->metabox_values['pag'] ) {
			$input['data-pagtype'] = esc_attr( $this->metabox_values['pagtype'] ? $this->metabox_values['pagtype'] : 'bullet' );
		}

		if ( 'bullet' === $this->metabox_values['pagtype'] ) {
			$input['data-dynbull'] = esc_attr( $this->metabox_values['dynbull'] ? 'true' : 'false' );
		}

		return $input;
	}
}
