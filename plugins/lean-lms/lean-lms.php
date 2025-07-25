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

/*
 * Initialize the LeanLMS plugin
 * */
add_action('plugins_loaded', ['LeanLMS\Core\Plugin', 'init']);