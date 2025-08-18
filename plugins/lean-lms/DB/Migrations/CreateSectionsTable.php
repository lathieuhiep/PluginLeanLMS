<?php

namespace LeanLMS\DB\Migrations;

defined('ABSPATH') || exit;

class CreateSectionsTable
{
    /**
     * Table name for the sections in Lean LMS.
     */
    public static function table_name(): string
    {
        global $wpdb;
        return $wpdb->prefix . 'lean_lms_sections';
    }

    /**
     * Create or update the sections table (dbDelta-friendly, no FK).
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
            title        VARCHAR(191) NOT NULL,
            description  MEDIUMTEXT NULL,
            position     INT UNSIGNED NOT NULL,
            items_count  INT UNSIGNED NOT NULL DEFAULT 0,
            created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            KEY          course_id (course_id),
            KEY          course_pos (course_id, position, id),
            UNIQUE KEY   uniq_course_position (course_id, position)
        ) {$charset_collate};";

        dbDelta($sql);

        // verify
        $exists = $wpdb->get_var( $wpdb->prepare(
            "SHOW TABLES LIKE %s", $table_name
        ) );

        if ($exists !== $table_name) {
            error_log("LeanLMS: Failed to create table '{$table_name}'.");
        }
    }
}
