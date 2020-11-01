<?php
/**
 * Custom Post Types initiator.
 *
 * This class registers custom post types required for Aurora Slider.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Base;

use AuroraSlider\Lib\CustomPostType;
use AuroraSlider\Base\BaseController;

/**
 * Custom Post Type Controller Class.
 *
 * @since  1.0.0
 */
class CustomPostTypesController extends BaseController {

	/**
	 * Accumulates Custom Post Types.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @var array
	 */
	public $custom_post_types = array();

	/**
	 * Method to register CPT.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		if ( ! in_array( 'cpt_manager', $this->managers, true ) ) {
			return;
		}

		$this->define_cpt();

		if ( ! empty( $this->custom_post_types ) ) {
			$this->register_custom_post_types();
		}
	}

	/**
	 * Method to define CPT.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return array
	 */
	private function define_cpt() {
		$this->custom_post_types = array(
			array(
				'name'   => __( 'Aurora Slider', 'aurora-slider' ),
				'slug'   => 'aurora_slider',
				'labels' => array(
					'all_items' => __( 'All Sliders', 'aurora-slider' ),
				),
				'args'   => array(
					'menu_icon'          => 'dashicons-format-gallery',
					'publicly_queryable' => false,
					'has_archive'        => false,
					'supports'           => array(
						'title',
					),
				),
			),
		);

		return $this->custom_post_types;
	}

	/**
	 * Method to loop through all the CPT definition and build up CPT.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_custom_post_types() {
		foreach ( $this->custom_post_types as $post_type ) {
			new CustomPostType(
				$post_type['name'],
				$post_type['slug'],
				! empty( $post_type['labels'] ) ? $post_type['labels'] : array(),
				! empty( $post_type['args'] ) ? $post_type['args'] : array()
			);
		}
	}
}
