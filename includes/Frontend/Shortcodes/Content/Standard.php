<?php
/**
 * Renders Standard Slider.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Frontend\Shortcodes\Content;

use AuroraSlider\Lib\Helpers;
use AuroraSlider\Frontend\MetaboxValues;

/**
 * Class that renders Standard Slider.
 *
 * @since 1.0.0
 */
class Standard {

	/**
	 * Metabox Values.
	 *
	 * @access private
	 * @var array
	 * @since 1.0.0
	 */
	private $metabox_values = array();

	/**
	 * Method to render Standard Slider.
	 *
	 * @access Private.
	 * @since 1.0.0
	 * @return void
	 */
	public function render() {
		$this->metabox_values = ! empty( MetaboxValues::fetch() ) ? MetaboxValues::fetch() : '';

		foreach ( $this->metabox_values['slides'] as $slide ) {
			?>
			<div class="swiper-slide as-slideshow__item">
				<?php
				$image_size = 'full';
				$class      = 'as-slideshow__image';

				Helpers::render_image( $image_size, $slide, $class );
				?>
			</div>
			<?php
		}
	}
}
