<?php
/**
 * Media Portfolios Fields
 *
 * This is essentially a premium distribution shell for the
 * Advanced Custom Fields PRO plugin. See notice below.
 *
 * @package      Media_Portfolios_Fields
 * @version      5.7.7
 * @author       Media Portfolios <dev@mediaportfolios.com>
 * @copyright    Copyright © 2018, Media Portfolios
 * @link         https://mediaportfolios.com/
 * @license      GPL-3.0+ http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * Plugin Name:  Media Portfolios Fields
 * Plugin URI:   https://mediaportfolios.com/
 * Description:  A content management interface for your portfolio website.
 * Version:      5.7.7
 * Author:       Media Portfolios
 * Author URI:   https://mediaportfolios.com/
 * License:      GPL-3.0+
 * License URI:  https://www.gnu.org/licenses/gpl.txt
 * Text Domain:  mps-text
 * Domain Path:  /languages
 * Tested up to: 4.9.8
 */

/**
 * Media Portfolios Fields version notice.
 *
 * The version of this plugin will be kept consistent with the version
 * of Advanced Custom Fields PRO that is included. The initital development
 * version of Media Portfolios Fields included ACF 5.7.7 so the
 * @since versions referring to 5.7.7 refer to the first version.
 */

/**
 * Media Portfolios Fields distribution notice.
 *
 * @since 5.7.7
 *
 * Media Portfolios Fields includes the complete Advanced Custom Fields PRO
 * plugin. As per their request, whether or not such a request is compatible under
 * the GNU license to which WordPress products are bound, the ACF PRO files included
 * here are not to be used or distributed outside of the Media Portfolios plugin.
 *
 * @link https://www.advancedcustomfields.com/resources/including-acf-in-a-plugin-theme/
 *
 * If you wish to obtain a copy of Advanced Custom Fields PRO then have some self
 * respect and buy a license of your own. It is a one-time purchase and the price is
 * well worth the endless possibilities which the plugin provides.
 *
 * @link https://www.advancedcustomfields.com/pro
 *
 * @see  mps-text/fields/readme.txt
 * @see  mps-text/fields/acf.php
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * If Advanced Custom Fields is active then stop here.
 *
 * @since  5.7.7
 * @return void
 */
if ( class_exists( 'acf' ) ) {
	return;
}

/**
 * Get plugins path to check for active plugins.
 *
 * @since  5.7.7
 * @return void
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Define the Media Portfolios plugin path.
 *
 * @since  5.7.7
 * @return string Returns the plugin path of the parent.
 */
if ( ! defined( 'MPF_PARENT' ) ) {
	define( 'MPF_PARENT', 'prod-port/prod-port.php' );
}

/**
 * Check for the plugin dependency.
 *
 * Add an admin error notice if the Media Portfolios
 * base plugin is not active.
 *
 * @since  5.7.7
 * @return void
 */
if ( ! is_plugin_active( MPF_PARENT ) ) {

	add_action( 'admin_notices', 'ppf_parent_notice' );

}

/**
 * Get the parent plugin admin notice output.
 *
 * @since  5.7.7
 * @return void
 */
function ppf_parent_notice() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/parent-notice.php';

}

/**
 * If the parent plugin is not active then stop here.
 *
 * @since  5.7.7
 * @return void
 */
if ( ! is_plugin_active( MPF_PARENT ) ) {
	return;
}

/**
 * The core plugin class.
 *
 * @since  5.7.7
 * @access public
 */
final class Media_Portfolios_Fields {

	/**
	 * Get an instance of the class.
	 *
	 * @since  5.7.7
	 * @access public
	 * @return object Returns the instance.
	 */
	public static function instance() {

		// Varialbe for the instance to be used outside the class.
		static $instance = null;

		if ( is_null( $instance ) ) {

			// Set variable for new instance.
			$instance = new self;

			// Require the core plugin class files.
			$instance->dependencies();

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method.
	 *
	 * @since  5.7.7
	 * @access private
	 * @return self
	 */
	private function __construct() {

		// Update the ACF path.
		add_filter( 'acf/settings/path', [ $this, 'acf_settings_path' ] );

		// Update the ACF directory.
		add_filter( 'acf/settings/dir', [ $this, 'acf_settings_dir' ] );

		// Hide ACF field group menu item.
		add_filter( 'acf/settings/show_admin', '__return_false' );

	}

	/**
	 * Update the ACF path.
	 *
	 * @since  5.7.7
	 * @access public
	 * @param  string $path
	 * @return string returns the path to the ACF files.
	 */
	public function acf_settings_path( $path ) {

		$path = plugin_dir_path( __FILE__ ) . 'fields/';

		return $path;

	}

	/**
	 * Update the ACF directory.
	 *
	 * @since  5.7.7
	 * @access public
	 * @param  string $dir
	 * @return string returns the URL to the ACF directory.
	 */
	public function acf_settings_dir( $dir ) {

		$dir = plugin_dir_url( __FILE__ ) . 'fields/';

		return $dir;

	}

	/**
	 * Require the core plugin class files.
	 *
	 * @since  5.7.7
	 * @access private
	 * @return void Gets the file which contains the core plugin class.
	 */
	private function dependencies() {

		// Include the fields directory.
		require_once plugin_dir_path( __FILE__ ) . 'fields/acf.php';

	}

}
// End core plugin class.

/**
 * Put an instance of the plugin class into a function.
 *
 * @since  5.7.7
 * @access public
 * @return object Returns the instance of the `Media_Portfolios_Fields` class.
 */
function ppf_plugin() {

	return Media_Portfolios_Fields::instance();

}

// Begin plugin functionality.
ppf_plugin();