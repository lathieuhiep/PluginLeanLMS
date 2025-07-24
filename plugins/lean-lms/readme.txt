=== Lean LMS ===
Contributors: your-name
Tags: lms, course, lesson, elearning, education
Requires at least: 5.5
Tested up to: 6.5
Requires PHP: 8.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A lightweight and extensible Learning Management System (LMS) plugin for WordPress — fully customizable, developer-friendly, and performance-focused.

== Description ==

**Lean LMS** is a minimalist and developer-first LMS plugin for WordPress. It provides the essential features to manage courses, lessons, and enrolled students — while staying lightweight and extensible.

This plugin is ideal for those who want full control over UI/UX, without relying on bloated LMS plugins.

### Core Features
- Custom Post Types for Courses and Lessons
- Course Builder Interface with Section & Lesson Mapping
- Custom Metaboxes for Lesson Types (e.g., video, text)
- Shortcodes for displaying course list
- Custom templates for course archive and single views
- Admin pages to manage students and enrollment
- Database mapping between courses and lessons
- Clean code structure with modern OOP practices
- Easily extensible by developers

### Built For Developers
The plugin is structured like a Laravel-style app with separate modules: `core/`, `post-type/`, `backend/`, `db/`, `frontend/`, and more. Every piece of logic is organized for clarity and extensibility.

== Installation ==

1. Upload the `lean-lms` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. After activation, you can access LMS features under the WordPress admin menu.

== Frequently Asked Questions ==

= Is this plugin ready for production use? =
Yes — but it is developer-oriented. UI is minimal. You’re encouraged to extend and style it per your needs.

= Does this plugin support WooCommerce or payment gateways? =
Not yet. It currently focuses on course management and enrollment logic. Payment integration is on the roadmap.

= Can I customize course templates? =
Yes. Templates are located in `frontend/templates/`. You can override them in your theme if needed.

== Screenshots ==

1. Course list in admin
2. Course builder UI with lesson mapping
3. Student management panel

== Changelog ==

= 1.0.0 =
* Initial release
* CPT course & lesson
* Course builder UI
* Student management pages

== Upgrade Notice ==

= 1.0.0 =
Initial release

== License ==

This plugin is licensed under the GPLv2 or later.