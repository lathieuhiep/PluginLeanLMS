<?php

namespace LeanLMS\Core;

use LeanLMS\DB\Migrations\CreateSectionItemsTable;
use LeanLMS\DB\Migrations\CreateSectionsTable;
use LeanLMS\PostType\CoursePostType;
use LeanLMS\PostType\LessonPostType;

class Installer
{
    const DB_VERSION = '1.0.0';
    const OPTION_KEY = 'lean_lms_db_version';

    /**
     * Activate the plugin and run the necessary migrations.
     *
     * This method is called when the plugin is activated.
     * It creates the necessary database tables and updates the version option.
     */
    public static function activate(): void
    {
        self::run_migrations();
        update_option(self::OPTION_KEY, self::DB_VERSION);

        /*
        * Register custom post types and taxonomies
        * */
        CoursePostType::register_now();
        LessonPostType::register_now();

        flush_rewrite_rules();
    }

    /**
     * Check if the database version needs to be upgraded.
     *
     * This method checks the current database version stored in the options table
     * and runs migrations if the version does not match the current DB_VERSION.
     */
    public static function maybe_upgrade(): void
    {
        $ver = get_option(self::OPTION_KEY);
        if ($ver !== self::DB_VERSION) {
            self::run_migrations();
            update_option(self::OPTION_KEY, self::DB_VERSION);
        }
    }

    private static function run_migrations(): void
    {
        CreateSectionsTable::create_table();
        CreateSectionItemsTable::create_table();
    }
}