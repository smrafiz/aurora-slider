<?php
/**
 * Base Controller.
 *
 * This class defines all the necessary paths, URLs' and other
 * required information that acts as an constant.
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

namespace AuroraSlider\Base;

/**
 * Plugin Base Controller Class.
 *
 * @since  1.0.0
 */
class BaseController {

	/**
	 * Plugin Path.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @var string
	 */
	protected $plugin_path;

	/**
	 * Plugin URL.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @var string
	 */
	protected $plugin_url;

	/**
	 * Plugin Version.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @var string
	 */
	protected $plugin_version;

	/**
	 * Plugin File.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @var string
	 */
	protected $plugin;

	/**
	 * Plugin Text Domain.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @var string
	 */
	protected $plugin_textdomain;

	/**
	 * Plugin Managers.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @var array
	 */
	protected $managers = array();

	/**
	 * Class constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		$this->plugin_path       = \plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url        = \plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin_version    = '1.0.0';
		$this->plugin            = \plugin_basename( dirname( __FILE__, 3 ) ) . '/aurora-slider.php';
		$this->plugin_textdomain = 'aurora-slider';

		$this->managers = array(
			'cpt_manager',
			'admin_manager',
			'enqueue_manager',
			'metabox_manager',
			'shortcode_manager',
		);
	}

	/**
	 * Method to initialize a class.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @static
	 *
	 * @param  class $class class to instantiate.
	 * @return class new instance of the class
	 */
	protected static function instance( $class ) {
		$service = new $class();

		return $service;
	}
}
