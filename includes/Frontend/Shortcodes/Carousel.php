<?php
/**
 * Carousel Shortcodes Class.
 *
 * This class adds carousel shortcodes in the frontend.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Frontend\Shortcodes;

/**
 * Carousel Shortcodes Class.
 *
 * @since  1.0.0
 */
class Carousel extends AbstractShortcode {

	/**
	 * Method to load the shortcode.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->shortcode_name = 'aurora_carousel';
		\add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
	}

	/**
	 * Method to render the shortcodes.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param mixed $atts shortcode attributes.
	 * @return void|string
	 */
	public function shortcode( $atts ) {
		$atts   = \shortcode_atts(
			array(),
			$atts
		);
		$result = '';

		ob_start();
		?>

		<div>[<?php echo \wp_kses_post( $this->shortcode_name ); ?>] Shortcode Added</div>

		<?php
		$result .= ob_get_clean();

		return $result;
	}

	/**
	 * Method to render the slider content.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return void
	 */
	protected function content_slider() {}

	/**
	 * Method to build up wrapper CSS class.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return array
	 */
	protected function wrapper_class_individual() {}

	/**
	 * Method to build up data-attributes.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return string
	 */
	protected function data_attributes_individual() {}
}
