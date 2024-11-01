<?php
/**
 * Plugin Name: WooCommerce For Elementor
 * Plugin URI: https://phoenixdigi.com.vn/plugins/woo-for-elementor/
 * Description: Add new Woocommerce Widgets that are specifically designed to be used in conjunction with the Elementor Page Builder.
 * Version: 1.0.5
 * Author: Phoenix Digi Viet Nam
 * Author URI: https://phoenixdigi.com.vn
 *
 * Text Domain: woocommerce-for-elementor
 * Domain Path: /languages/
 *
 * @package WooCommerce for Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
	return;
}

// Define.
define( 'WFE_VERSION', '1.0.5' );
define( 'WFE_FILE', __FILE__ );
define( 'WFE_PATH', plugin_dir_path( WFE_FILE ) );
define( 'WFE_URL', plugin_dir_url( WFE_FILE ) );
define( 'WFE_MODULES_PATH', WFE_PATH . 'modules/' );
define( 'WFE_ASSETS_URL', WFE_URL . 'assets/' );

require_once WFE_PATH . '/includes/class-woocommerce-for-elementor.php';
require_once WFE_PATH . '/includes/helper.php';

/**
 * Main instance of WooCommerce_For_Elementor.
 *
 * Returns the main instance of WFE to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return WooCommerce_For_Elementor
 */
function wfe() {
	return WooCommerce_For_Elementor::instance();
}

// Global for backwards compatibility.
$GLOBALS['wfe'] = wfe();
