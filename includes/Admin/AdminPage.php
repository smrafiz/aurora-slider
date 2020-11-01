<?php
/**
 * Main Admin Page class.
 *
 * This class is responsible for creating the settings page with all the
 * necessary options for user interaction.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Admin;

use Carbon_Fields\Container;
use AuroraSlider\Admin\Aside;
use AuroraSlider\Admin\Tabs\Colors;
use AuroraSlider\Admin\Tabs\Settings;

/**
 * Admin Page Class.
 *
 * @since  1.0.0
 */
class AdminPage {

	/**
	 * Page args.
	 *
	 * @access private
	 * @since  1.0.0
	 *
	 * @var array
	 */
	private $args = array();

	/**
	 * Method to register settings page.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->args = array(
			'title'       => esc_html__( 'Slider Settings', 'aurora-slider' ),
			'parent-page' => esc_url( 'edit.php?post_type=aurora_slider' ),
			'page-slug'   => esc_attr( 'aurora-slider-settings' ),
		);

		\add_action( 'carbon_fields_register_fields', array( $this, 'settings' ) );
		\add_action( 'carbon_fields_container_slider_settings_after_sidebar', array( $this, 'aside' ) );
	}

	/**
	 * Method to render settings page tab contents.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return mixed
	 */
	private function tabs() {
		$tabs = array(
			esc_html__( 'Settings', 'aurora-slider' ) => Settings::class,
			esc_html__( 'Colors', 'aurora-slider' )   => Colors::class,
		);

		return \apply_filters( 'aurora_slider_settings_tabs', $tabs );
	}

	/**
	 * Method to render settings page using Carbon Fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function settings() {
		$settings = Container::make( 'theme_options', $this->args['title'] );
		$settings->set_page_parent( $this->args['parent-page'] )
			->set_page_file( $this->args['page-slug'] )
			->set_classes( 'aurora-slider-settings' );

		foreach ( $this->tabs() as $tab_name => $tab_content ) {
			$settings->add_tab( $tab_name, $tab_content::register() );
		}
	}

	/**
	 * Method to render settings page sidebar contents.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function aside() {
		$content = '';

		ob_start();
		Aside::register();
		$content .= ob_get_clean();

		echo \wp_kses_post( $content );
	}
}
