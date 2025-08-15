<?php
namespace LeanLMS\Core;

use LeanLMS\PostType\CoursePostType;

defined('ABSPATH') || exit;

class TemplateLoader {

    /**
     * Initialize the template loader by hooking into the 'template_include' filter.
     */
    public static function boot(): void {
        add_filter('template_include', [__CLASS__, 'pick'], 99);
    }

    /**
     * Generate a list of template candidates based on the basename.
     *
     * @param string $basename The base name of the template file.
     * @return array An array of candidate template paths.
     */
    private static function candidates(string $basename): array {
        return [
            'lean-lms/' . $basename,
            'lean_lms/' . $basename,
            $basename,
        ];
    }

    /**
     * Locate the template in the active theme or child theme.
     *
     * @param string $basename The base name of the template file.
     * @return string The path to the located template file, or an empty string if not found.
     */
    private static function locate_in_theme(string $basename): string {
        $t = locate_template(self::candidates($basename));
        return $t ?: '';
    }

    /**
     * Get the path to the plugin template file.
     *
     * @param string $basename The base name of the template file.
     * @return string The full path to the plugin template file.
     */
    private static function plugin_template(string $basename): string {
        return Constants::path() . 'templates/' . $basename;
    }

    /**
     * Pick the appropriate template based on the current context.
     *
     * @param string $template The default template to use if no specific template is found.
     * @return string The path to the selected template file.
     */
    public static function pick(string $template): string {
        // Single Course
        if ( is_singular( CoursePostType::POST_TYPE ) ) {
            return self::locate_in_theme(CoursePostType::TEMPLATE_SINGLE)
                ?: self::plugin_template(CoursePostType::TEMPLATE_SINGLE);
        }

        // Archive Course
        if ( is_post_type_archive( CoursePostType::POST_TYPE ) ) {
            return self::locate_in_theme(CoursePostType::TEMPLATE_ARCHIVE)
                ?: self::plugin_template(CoursePostType::TEMPLATE_ARCHIVE);
        }

        // Taxonomy Course Category
        if ( is_tax(CoursePostType::TAX_CAT) ) {
            return self::locate_in_theme(CoursePostType::TEMPLATE_TAX_CAT)
                ?: self::plugin_template(CoursePostType::TEMPLATE_TAX_CAT);
        }

        return $template;
    }
}