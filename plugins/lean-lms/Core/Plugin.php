<?php

namespace LeanLMS\Core;

use LeanLMS\Backend\CourseMetaBox\CourseSectionsMetaBox;
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

        // load admin enqueue scripts
        add_action('admin_enqueue_scripts', [self::class, 'load_admin_enqueue_scripts']);

        // register custom post types
        self::register_custom_post_types();

        // add meta box for custom post types
        self::add_meta_box_cpt();

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

    public static function load_admin_enqueue_scripts($hook): void
    {
        global $post;

        if ( ( $hook === 'post.php' || $hook === 'post-new.php')
            && $post && $post->post_type === CoursePostType::POST_TYPE ) {

            wp_enqueue_style(
                'cpt-course-admin',
                Constants::url() . 'Backend/assets/css/cpt-course.css',
                [],
                '1.0'
            );

            wp_enqueue_script(
                'cpt-course-admin',
                Constants::url() . 'Backend/assets/js/cpt-course.js',
                ['jquery'],
                '1.0',
                true
            );
        }
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

    /**
     * Add meta box for cpt
     *
     * @return void
     */
    public static function add_meta_box_cpt(): void
    {
        if ( is_admin() ) {
            CourseSectionsMetaBox::init();
        }
    }
}