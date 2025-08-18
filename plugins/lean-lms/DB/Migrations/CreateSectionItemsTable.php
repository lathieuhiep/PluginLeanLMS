<?php

namespace LeanLMS\DB\Migrations;

defined('ABSPATH') || exit;

class CreateSectionItemsTable
{
    /**
     * Table name for the section items in Lean LMS.
     *
     * @return string
     */
    public static function table_name(): string
    {
        global $wpdb;
        return $wpdb->prefix . 'lean_lms_section_items';
    }

    /**
     * Create the section items table in the database.
     *
     * @return void
     */
    public static function create_table(): void
    {
        global $wpdb;
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = self::table_name();

        $sql = "CREATE TABLE {$table_name} (
            id           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            course_id    BIGINT UNSIGNED NOT NULL,
            section_id   BIGINT UNSIGNED NOT NULL,
            lesson_id    BIGINT UNSIGNED NOT NULL,
            position     INT UNSIGNED NOT NULL,
            created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            KEY          course_id (course_id),
            KEY          section_id (section_id),
            KEY          lesson_id (lesson_id),
            KEY          course_section_pos (course_id, section_id, position, id),
            UNIQUE KEY   uniq_section_lesson (section_id, lesson_id),
            UNIQUE KEY   uniq_section_position (section_id, position)
        ) {$charset_collate};";

        dbDelta($sql);

        $exists = $wpdb->get_var( $wpdb->prepare(
            "SHOW TABLES LIKE %s", $table_name
        ) );

        if ($exists !== $table_name) {
            error_log("LeanLMS: Failed to create table '{$table_name}'.");
        }
    }
}