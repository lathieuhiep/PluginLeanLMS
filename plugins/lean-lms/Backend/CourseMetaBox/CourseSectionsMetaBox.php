<?php

namespace LeanLMS\Backend\CourseMetaBox;

use LeanLMS\Core\Constants;
use LeanLMS\PostType\CoursePostType;

class CourseSectionsMetaBox
{
    public static function init(): void
    {
        add_action('add_meta_boxes', [__CLASS__, 'register_meta_box']);
    }

    /*
     * register_meta_box
     * */
    public static function register_meta_box(): void
    {
        add_meta_box(
            'lean_lms_sections',
            esc_html__('Courses Sections', Constants::TEXT_DOMAIN),
            [__CLASS__, 'render_meta_box'],
            CoursePostType::POST_TYPE,
            'normal',
            'default',
            [ '__back_compat_meta_box' => true ]
        );
    }

    /*
     * render_meta_box
     * */
    public static function render_meta_box(\WP_Post $post): void
    {
    ?>
        <div id="lean-lms-sections">
            <div class="sections-header">
                <button type="button" class="button button-primary" id="add-section-btn">
                    <?php esc_html_e('Add Section', Constants::TEXT_DOMAIN); ?>
                </button>
            </div>

            <div class="sections-list">
                <!-- Các Section sẽ được append ở đây bằng JS -->
            </div>

            <!-- Template ẩn -->
            <template id="lean-lms-section-template">
                <div class="lean-section">
                    <div class="lean-section-header">
                        <input type="text" name="lean_lms_sections[][title]" placeholder="Section title" class="section-title-input" />
                        <button type="button" class="button remove-section">Remove</button>
                    </div>
                    <div class="lean-section-body">
                        <textarea name="lean_lms_sections[][desc]" placeholder="Section description"></textarea>
                        <div class="lessons-list"></div>
                        <button type="button" class="button add-lesson">+ Add Lesson</button>
                    </div>
                </div>
            </template>
        </div>
    <?php
    }
}