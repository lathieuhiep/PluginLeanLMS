<?php

namespace LeanLMS\PostType;

use LeanLMS\Core\Constants;
use LeanLMS\Helper\Functions;

defined('ABSPATH') || exit;

class CoursePostType
{
    public const POST_TYPE = 'lean_lms_course';
    public const TAX_CAT = 'lean_lms_course_category';

    // name file template
    public const TEMPLATE_SINGLE = 'single-course.php';
    public const TEMPLATE_ARCHIVE = 'archive-course.php';
    public const TEMPLATE_TAX_CAT = 'taxonomy-course-category.php';

    /**
     * Initialize the Course Post Type
     *
     * This method hooks into WordPress actions to register the custom post type
     * and its taxonomy, and to add a custom filter for the taxonomy in the admin area.
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('init', [__CLASS__, 'register_ctp']);
        add_action('init', [__CLASS__, 'register_tax_cat']);
        add_action('admin_init', [__CLASS__, 'add_tax_cat_filter']);
    }

    public static function register_now(): void
    {
        self::register_ctp();
        self::register_tax_cat();
    }

    /**
     * Register the Course post type and its taxonomy.
     *
     * @return void
     */
    public static function register_ctp(): void
    {
        if ( post_type_exists(self::POST_TYPE) ) {
            return; // If the post type already exists, no need to register again
        }

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
            'has_archive' => false,
            'rewrite' => ['slug' => 'khoa-hoc'],
            'menu_position' => 5,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
            'show_in_rest' => false,
            'show_in_menu' => true,
        ]);
    }

    /**
     * Register the Course Category taxonomy.
     *
     * @return void
     */
    public static function register_tax_cat(): void
    {
        if ( taxonomy_exists(self::TAX_CAT) ) {
            return; // If the taxonomy already exists, no need to register again
        }

        register_taxonomy(self::TAX_CAT, self::POST_TYPE, [
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
            'public' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'rewrite' => [
                'slug' => 'danh-muc-khoa-hoc',
                'with_front' => false,
                'hierarchical' => true,
            ],
            'show_in_rest' => true,
        ]);
    }

    /**
     * Add a custom taxonomy filter to the Course post type in the admin area.
     *
     * This method hooks into the 'init' action to add the filter.
     *
     * @return void
     */
    public static function add_tax_cat_filter(): void
    {
        (new Functions)->add_custom_taxonomy_filter_to_cpt(self::POST_TYPE, self::TAX_CAT);
    }
}