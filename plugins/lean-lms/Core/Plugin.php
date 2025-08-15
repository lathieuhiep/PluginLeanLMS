<?php

namespace LeanLMS\Core;

use LeanLMS\Backend\MenuManager;
use LeanLMS\PostType\CoursePostType;
use LeanLMS\PostType\LessonPostType;

defined( 'ABSPATH' ) || exit;

class Plugin
{
    /**
     * Initialize the plugin
     *
     * @return void
     */
    public static function init(): void
    {
        // load plugin text domain for translations
        add_action('plugins_loaded', [self::class, 'load_text_domain']);

        // register custom post types
        add_action('init', [self::class, 'register_custom_post_types']);

        // load template loader
        TemplateLoader::boot();

        // add amin menu and submenus
        add_action('admin_menu', [MenuManager::class, 'init']);
    }

    /**
     * load text domain for translations
     *
     * @return void
     */
    public static function load_text_domain(): void
    {
        load_plugin_textdomain(
            Constants::TEXT_DOMAIN,
            false,
            Constants::path() . '/languages'
        );
    }

    /**
     * Register custom post types
     *
     * @return void
     */
    public static function register_custom_post_types(): void
    {
        CoursePostType::init();
        LessonPostType::init();
    }
}