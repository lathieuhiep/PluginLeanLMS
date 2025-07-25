<?php
namespace LeanLMS\Backend;

defined('ABSPATH') || exit;

use LeanLMS\Core\Constants;

class MenuManager
{
    /**
     * Initialize the menu manager
     *
     * @return void
     */

    public static function init(): void
    {
        // Register the admin menu for Lean LMS
        self::create_menu_manager();
    }

    /**
     * Register the admin menu for Lean LMS
     *
     * @return void
     */
    public static function create_menu_manager(): void
    {
        add_menu_page(
            esc_html__('Quản lý khoá học', Constants::TEXT_DOMAIN),
            esc_html__('Quản lý khoá học', Constants::TEXT_DOMAIN),
            'manage_options',
            'lean-lms',
            [self::class, 'render_dashboard'], // CÓ callback!
            'dashicons-welcome-learn-more',
            7
        );
    }

    public static function render_dashboard(): void
    {
        echo '<div class="wrap"><h1>Lean LMS</h1><p>Chào mừng bạn đến với hệ thống quản lý khoá học.</p></div>';
    }
}
