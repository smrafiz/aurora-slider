<?php
/**
 * Main Metabox class.
 *
 * This class is responsible for creating the metaboxes with all the
 * necessary options for user interaction.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Metabox;

use Carbon_Fields\Container;

/**
 * Metabox Class.
 *
 * @since  1.0.0
 */
class Metaboxes {

	/**
	 * Method to register metaboxes.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->args = array(
			'title'     => esc_html__( 'Slider Settings', 'aurora-slider' ),
			'post-type' => esc_attr( 'aurora_slider' ),
		);

		\add_action( 'carbon_fields_register_fields', array( $this, 'settings' ) );
		\add_action( 'carbon_fields_register_fields', array( $this, 'aside' ) );
	}

	/**
	 * Method to render metabox tab contents.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return mixed
	 */
	private function tabs() {
		$tabs = array(
			esc_html__( 'General', 'aurora-slider' )    => Tabs\General::class,
			esc_html__( 'Size', 'aurora-slider' )       => Tabs\Size::class,
			esc_html__( 'Slides', 'aurora-slider' )     => Tabs\Slides::class,
			esc_html__( 'Controls', 'aurora-slider' )   => Tabs\Controls::class,
			esc_html__( 'Navigation', 'aurora-slider' ) => Tabs\Navigation::class,
			esc_html__( 'Colors', 'aurora-slider' )     => Tabs\Colors::class,
		);

		return \apply_filters( 'aurora_slider_metabox_tabs', $tabs );
	}

	/**
	 * Method to render metaboxes using Carbon Fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function settings() {
		$settings = Container::make( 'post_meta', $this->args['title'] );
		$settings->where( 'post_type', '=', $this->args['post-type'] )
			->set_classes( 'aurora-slider-metabox-settings' );

		foreach ( $this->tabs() as $tab_name => $tab_content ) {
			$settings->add_tab( $tab_name, $tab_content::register() );
		}
	}

	/**
	 * Method to render post sidebar contents.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function aside() {
		if ( ! isset( $_GET['post'] ) ) {
			return;
		}

		$settings = Container::make( 'post_meta', esc_html__( 'Shortcode', 'aurora-slider' ) );
		$settings->where( 'post_type', '=', $this->args['post-type'] )
			->set_context( 'side' )
			->set_classes( 'aurora-slider-shortcode-metabox-settings' );

		$settings->add_fields( Aside::register() );
	}
}
