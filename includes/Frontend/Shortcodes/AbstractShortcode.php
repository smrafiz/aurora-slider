<?php
/**
 * Abstract Shortcode Class.
 *
 * This class acts as an abstraction for adding shortcodes.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Frontend\Shortcodes;

use AuroraSlider\Frontend\MetaboxValues;

/**
 * Shortcode Abstract Class.
 *
 * @since  1.0.0
 */
abstract class AbstractShortcode {

	/**
	 * Shortcode name.
	 *
	 * @access protected
	 * @since  1.0.0
	 *
	 * @var string
	 */
	protected $shortcode_name = '';

	/**
	 * Metabox values.
	 *
	 * @access protected
	 * @since  1.0.0
	 *
	 * @var array
	 */
	protected $metabox_values = array();

	/**
	 * Abstract method to register shortcode.
	 *
	 * @access public
	 * @since 1.0.0
	 * @abstract
	 */
	abstract public function register();

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
		$attributes = \shortcode_atts(
			array(
				'id' => '',
			),
			$atts
		);

		$this->load_scripts();

		$result = '';
		ob_start();

		$loop_args = array(
			'post_type'      => 'aurora_slider',
			'posts_per_page' => 1,
			'post__in'       => array( $attributes['id'] ),
		);

		$slider_loop = new \WP_Query( $loop_args );

		if ( $slider_loop->have_posts() ) {
			while ( $slider_loop->have_posts() ) {
				$slider_loop->the_post();

				$this->metabox_values = ! empty( MetaboxValues::fetch() ) ? MetaboxValues::fetch() : '';
				?>

				<!-- Slider main container -->
				<div <?php \post_class( esc_attr( implode( ' ', $this->wrapper_class() ) ) ); ?> <?php echo \wp_kses_post( $this->data_attributes() ); ?>>
					<div class="swiper-wrapper as-slideshow__wrapper">
						<?php
						$this->content_slider();
						?>
					</div>

					<?php
					if ( $this->metabox_values['pag'] ) {
						?>
						<!-- Pagination -->
						<div class="as-slideshow__pagination swiper-pagination"></div>
						<?php
					}

					if ( $this->metabox_values['nav'] ) {
						?>
						<!-- Navigation -->
						<div class="as-slideshow__nav as-slideshow__nav--left swiper-button-prev"></div>
						<div class="as-slideshow__nav as-slideshow__nav--right swiper-button-next"></div>
						<?php
					}
					?>
				</div>
				<?php
			}
		}

		\wp_reset_postdata();
		?>

		<?php
		$result .= ob_get_clean();
		return $result;
	}

	/**
	 * Method to load required scripts.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return void
	 */
	protected function load_scripts() {
		\wp_enqueue_script( 'swiper' );
		\wp_enqueue_script( 'swiper-animation-script' );
		\wp_enqueue_script( 'aurora-frontend-script' );
	}

	/**
	 * Abstract method to render the slider content.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @abstract
	 */
	abstract protected function content_slider();

	/**
	 * Method to build up total wrapper CSS class.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return array
	 */
	protected function wrapper_class() {
		$classes = array();

		$classes = array_merge( $classes, $this->wrapper_class_common(), $this->wrapper_class_individual() );

		return $classes;
	}

	/**
	 * Method to build up common wrapper CSS class.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return array
	 */
	protected function wrapper_class_common() {
		$classes = array(
			'swiper-container',
			'as-slideshow',
		);

		switch ( $this->metabox_values['type'] ) {
			case 'standard':
				$classes[] = 'as-slideshow--standard';
				break;
			case 'carousel':
				$classes[] = 'as-slideshow--carousel';
				break;
			default:
				$classes[] = 'as-slideshow--standard';
				break;
		}

		return $classes;
	}

	/**
	 * Abstract method to build up individual wrapper CSS class.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @abstract
	 */
	abstract protected function wrapper_class_individual();

	/**
	 * Method to build up total data-attributes.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @abstract
	 */
	protected function data_attributes() {
		$input  = array();
		$output = array();

		$input = array_merge( $input, $this->data_attributes_common(), $this->data_attributes_individual() );

		foreach ( $input as $key => $val ) {
			$val      = htmlspecialchars( $val, ENT_QUOTES );
			$output[] = "{$key}=\"{$val}\"";
		}

		return join( ' ', $output );
	}

	/**
	 * Method to build up common data-attributes.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return string
	 */
	protected function data_attributes_common() {
		$input = array();

		$input['data-loop']   = esc_attr( $this->metabox_values['loop'] ? 'true' : 'false' );
		$input['data-effect'] = esc_attr( $this->metabox_values['effect'] ? $this->metabox_values['effect'] : 'slide' );
		$input['data-nav']    = esc_attr( $this->metabox_values['nav'] ? 'true' : 'false' );
		$input['data-pag']    = esc_attr( $this->metabox_values['pag'] ? 'true' : 'false' );

		return $input;
	}

	/**
	 * Abstract method to build up individual data-attributes.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @abstract
	 */
	abstract protected function data_attributes_individual();
}
