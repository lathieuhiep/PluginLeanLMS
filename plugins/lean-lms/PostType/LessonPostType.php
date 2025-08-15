<?php

namespace LeanLMS\PostType;

defined('ABSPATH') || exit;

use LeanLMS\Core\Constants;
use LeanLMS\Helper\Functions;

class LessonPostType
{
    public const POST_TYPE = 'lean_lms_lesson';
    public const TAX_CAT = 'lean_lms_lesson_category';

    /**
     * Initialize the Lesson Post Type
     *
     * @return void
     */
    public static function init(): void
    {
        self::register_ctp();
        self::register_tax_cat();
        self::add_tax_cat_filter();
    }

    /**
     * Register the Lesson post type.
     *
     * @return void
     */
    protected static function register_ctp(): void
    {
        if (post_type_exists(self::POST_TYPE)) {
            return; // If the post type already exists, no need to register again
        }

        register_post_type(self::POST_TYPE, [
            'labels' => [
                'name' => esc_html__('Bài học', Constants::TEXT_DOMAIN),
                'singular_name' => esc_html__('Bài học', Constants::TEXT_DOMAIN),
                'add_new' => esc_html__('Thêm bài học', Constants::TEXT_DOMAIN),
                'add_new_item' => esc_html__('Thêm mới', Constants::TEXT_DOMAIN),
                'edit_item' => esc_html__('Chỉnh sửa', Constants::TEXT_DOMAIN),
                'new_item' => esc_html__('Bài học mới', Constants::TEXT_DOMAIN),
                'view_item' => esc_html__('Xem', Constants::TEXT_DOMAIN),
                'search_items' => esc_html__('Tìm kiếm', Constants::TEXT_DOMAIN),
                'not_found' => esc_html__('Không tìm thấy bài học nào.', Constants::TEXT_DOMAIN),
                'not_found_in_trash' => esc_html__('Không có bài học nào trong thùng rác.', Constants::TEXT_DOMAIN),
            ],
            'public' => false, // Không show public, chỉ truy cập khi học viên được phép
            'show_ui' => true,
            'has_archive' => false,
            'rewrite' => ['slug' => 'bai-hoc'],
            'menu_position' => 6,
            'menu_icon' => 'dashicons-media-text',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
            'show_in_rest' => true,
            'show_in_menu' => true,
        ]);
    }

    /**
     * Register the Lesson Category taxonomy.
     *
     * @return void
     */
    protected static function register_tax_cat(): void
    {
        if (taxonomy_exists(self::TAX_CAT)) {
            return; // If the taxonomy already exists, no need to register again
        }

        register_taxonomy(self::TAX_CAT, self::POST_TYPE, [
            'labels' => [
                'name' => esc_html__('Danh mục bài học', Constants::TEXT_DOMAIN),
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
            'show_in_nav_menus' => false,
            'rewrite' => false,
            'show_in_rest' => true,
        ]);
    }

    protected static function add_tax_cat_filter(): void
    {
        (new Functions)->add_custom_taxonomy_filter_to_cpt(self::POST_TYPE, self::TAX_CAT);
    }
}
