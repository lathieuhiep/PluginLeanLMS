<?php

namespace LeanLMS\PostType;

use LeanLMS\Core\Constants;

defined('ABSPATH') || exit;

class CoursePostType
{
    public const POST_TYPE = 'course';
    public const TAXONOMY = 'course_category';

    public static function init(): void
    {
        self::register_ctp();
        self::register_tax();
    }

    /**
     * Register the Course post type and its taxonomy.
     *
     * @return void
     */
    protected static function register_ctp(): void
    {
        register_post_type(self::POST_TYPE, [
            'labels' => [
                'name' => esc_html__('Khoá học', Constants::TEXT_DOMAIN),
                'singular_name' => esc_html__('Khoá học', Constants::TEXT_DOMAIN),
                'add_new' => esc_html__('Thêm mới', Constants::TEXT_DOMAIN),
                'add_new_item' => esc_html__('Thêm khóa học', Constants::TEXT_DOMAIN),
                'edit_item' => esc_html__('Chỉnh sửa', Constants::TEXT_DOMAIN),
                'new_item' => esc_html__('Khoá học mới', Constants::TEXT_DOMAIN),
                'view_item' => esc_html__('Xem', Constants::TEXT_DOMAIN),
                'search_items' => esc_html__('Tìm kiếm', Constants::TEXT_DOMAIN),
                'not_found' => esc_html__('Không tìm thấy khoá học nào.', Constants::TEXT_DOMAIN),
                'not_found_in_trash' => esc_html__('Không có khoá học nào trong thùng rác.', Constants::TEXT_DOMAIN),
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'khoa-hoc'],
            'menu_position' => 5,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'show_in_menu' => true,
        ]);
    }

    /**
     * Register the Course Category taxonomy.
     *
     * @return void
     */
    protected static function register_tax(): void
    {
        register_taxonomy(self::TAXONOMY, self::POST_TYPE, [
            'labels' => [
                'name' => esc_html__('Danh mục khoá học', Constants::TEXT_DOMAIN),
                'singular_name' => esc_html__('Danh mục', Constants::TEXT_DOMAIN),
                'search_items' => esc_html__('Tìm danh mục', Constants::TEXT_DOMAIN),
                'all_items' => esc_html__('Tất cả danh mục', Constants::TEXT_DOMAIN),
                'edit_item' => esc_html__('Chỉnh sửa danh mục', Constants::TEXT_DOMAIN),
                'update_item' => esc_html__('Cập nhật danh mục', Constants::TEXT_DOMAIN),
                'add_new_item' => esc_html__('Thêm danh mục mới', Constants::TEXT_DOMAIN),
                'new_item_name' => esc_html__('Tên danh mục mới', Constants::TEXT_DOMAIN),
                'menu_name' => esc_html__('Danh mục', Constants::TEXT_DOMAIN),
            ],
            'public' => false,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'rewrite' => false,
            'show_in_rest' => true,
        ]);
    }
}