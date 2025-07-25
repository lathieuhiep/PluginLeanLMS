<?php

namespace LeanLMS\PostType;

defined('ABSPATH') || exit;

use LeanLMS\Core\Constants;

class LessonPostType
{
    public const POST_TYPE = 'lesson';

    /**
     * Initialize the Lesson Post Type
     *
     * @return void
     */
    public static function init(): void
    {
        self::register_ctp();
    }

    /**
     * Register the Lesson post type.
     *
     * @return void
     */
    public static function register_ctp(): void
    {
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
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'show_in_menu' => true,
        ]);
    }
}
