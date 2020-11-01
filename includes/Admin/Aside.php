<?php
/**
 * Aside Admin class.
 *
 * This class is responsible for rendering the sidebar settings.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Admin;

use Carbon_Fields\Field;

/**
 * Aside Class.
 *
 * @since  1.0.0
 */
class Aside {

	/**
	 * Method to register sidebar content.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public static function register() {
		self::content();
	}

	/**
	 * Method to render settings page sidebar contents.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return void
	 */
	private static function content() {
		?>
		<div class="aurora-settings-sidebar postbox">
			<h3>Leave a review</h3>
			<div style="padding: 8px 12px; border-top: 1px solid #ddd; background: #f5f5f5;">
				<p>If you like Aurora Slider please leave us a rating ★★★★★ . Your Review is very important to us as it helps us to grow more.</p>
				<a href="#" class="button button-primary button-large">Leave Review</a>
			</div>
		</div>
		<?php
	}
}
