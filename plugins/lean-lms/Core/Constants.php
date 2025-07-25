<?php

namespace LeanLMS\Core;

defined( 'ABSPATH' ) || exit;

class Constants
{
    // define plugin constants
    public const VERSION = '1.0.0';
    public const TEXT_DOMAIN = 'lean-lms';


    /**
     * Get the path of the plugin directory.
     *
     * @return string
     */
    public static function path(): string
    {
        return plugin_dir_path(dirname(__FILE__, 1));
    }

    /**
     * Get the URL of the plugin directory.
     *
     * @return string
     */
    public static function url(): string
    {
        return plugin_dir_url(dirname(__FILE__, 1));
    }
}