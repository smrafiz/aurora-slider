<?php
/**
 * Plugin Name: Aurora Slider
 * Plugin URI: https://github.com/smrafiz/aurora-slider/
 * Description: All in one WordPress Slider.
 * Version: 1.0.0
 * Author: Aurora Themes
 * Author URI: https://github.com/smrafiz/aurora-slider/
 * License: GPLv2 or later
 * Text Domain: aurora-slider
 * Domain Path: /languages/
 *
 * @package AuroraSlider
 * @since   1.0.0
 */

/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// If this file is called directly, abort!!!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! version_compare( PHP_VERSION, '5.6', '>=' ) ) {
	add_action( 'admin_notices', 'aurora_slider_fail_php_version' );
	exit;
} elseif ( ! version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ) {
	add_action( 'admin_notices', 'aurora_slider_fail_wp_version' );
	exit;
}

// Require once the Composer Autoload.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation.
 */
function activate_aurora_slider() {
	AuroraSlider\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_aurora_slider' );

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_aurora_slider() {
	AuroraSlider\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_aurora_slider' );

/**
 * Initialize all the core classes of the plugin.
 */
if ( class_exists( 'AuroraSlider\\Plugin' ) ) {
	AuroraSlider\Plugin::register_services();
}

/**
 * Admin notice for minimum PHP version.
 *
 * Warns user when the site doesn't have the minimum required PHP version.
 *
 * @since 1.0.0
 * @return void
 */
function aurora_slider_fail_php_version() {
	/* translators: %s: PHP version */
	$message      = sprintf( esc_html__( 'Aurora Slider requires PHP version %s+, plugin is currently NOT RUNNING.', 'aurora-slider' ), '5.6' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}

/**
 * Admin notice for minimum WordPress version.
 *
 * Warns user when the site doesn't have the minimum required WordPress version.
 *
 * @since 1.0.0
 * @return void
 */
function aurora_slider_fail_wp_version() {
	/* translators: %s: WordPress version */
	$message      = sprintf( esc_html__( 'Aurora Slider requires WordPress version %s+. Because you are using an earlier version, the plugin is currently NOT RUNNING.', 'aurora-slider' ), '5.0' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}
