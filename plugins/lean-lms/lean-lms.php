<?php
/**
 * Plugin Name: Lean LMS
 * Description: A lightweight LMS plugin for managing courses and lessons.
 * Version: 1.0.0
 * Author: La Khắc Điệp
 * Author URI: https://example.com/
 * Text Domain: lean-lms
 * Domain Path: /languages
 *
 * Requires PHP: 8.2
 * Requires at least: 6.0
 */

use LeanLMS\Core\Installer;

defined('ABSPATH') || exit;

/*
 * autoload classes in LeanLMS namespace
 * */
spl_autoload_register(function (string $class) {

    // only load classes that belong to the LeanLMS namespace
    if (!str_starts_with($class, 'LeanLMS\\')) {
        return;
    }

    // remove the prefix LeanLMS\
    $relativeClass = substr($class, strlen('LeanLMS\\'));

    // convert backslashes to forward slashes and append .php
    $file = __DIR__ . '/' . str_replace('\\', '/', $relativeClass) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
});

register_activation_hook(__FILE__, ['LeanLMS\Core\Installer', 'activate']);

/*
 * Initialize the LeanLMS plugin
 * */
add_action('plugins_loaded', ['LeanLMS\Core\Plugin', 'init']);

/*
 * Run migrations and upgrades if needed
 * */
add_action('plugins_loaded', function () {
    if (is_admin()) {
        Installer::maybe_upgrade();
    }
}, 5);

/*
 * Hook after plugin update via WordPress Upgrader
 */
add_action('upgrader_process_complete', function ($upgrader, $hook_extra) {
    if (($hook_extra['type'] ?? null) !== 'plugin') return;
    if (($hook_extra['action'] ?? null) !== 'update') return;

    $this_plugin = plugin_basename(__FILE__);
    $updated = $hook_extra['plugins'] ?? [];
    if (in_array($this_plugin, $updated, true)) {
        Installer::maybe_upgrade();
    }
}, 10, 2);

// Register deactivation hook to clean up
register_deactivation_hook(__FILE__, function () {
    flush_rewrite_rules();
});