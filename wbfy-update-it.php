<?php
/**
 * Main Update It! plugin file
 *
 * Set up autoload and instantiate the main Update It! class and constants
 *
 * @link    https://websitesbuiltforyou.com/wordpress/update-it-automatic-plugin-theme-updater
 * @package Update It! Automatic Plugin And Theme Updater
 */

/**
 * Plugin Name: Update It!
 * Plugin URI: https://websitesbuiltforyou.com/wordpress/update-it-automatic-plugin-theme-updater
 * Description: Resize and optimise images already uploaded to WordPress
 * Author: Websites Built For You
 * Author URI: https://websitesbuiltforyou.com
 * Version: 1.1.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses
 * Text Domain: wbfy-update-it
 * Domain Path: /resources/languages
 *
 * Update It! Automatic Plugin And Theme Updater is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 2 of the License, or any later version.
 *
 * Update It! Automatic Plugin And Theme Updater is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Update It! Automatic Plugin And Theme Updater. If not, see https://www.gnu.org/licenses.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('wbfy_ui_Main')) {
    define('WBFY_UI_VERSION', '1.1.0');
    define('WBFY_UI_PLUGIN_DIR', plugin_dir_path(__FILE__));

    include 'server/php/Autoloader.class.php';
    wbfy_ui_Autoloader::register();

    $wbfy_ui = new wbfy_ui_Main;
}
