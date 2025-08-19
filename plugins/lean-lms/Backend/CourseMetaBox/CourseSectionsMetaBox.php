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
        <div id="lean-lms-sections" class="lean-lms-admin">
            <div class="sections-list"></div>

            <div class="sections-action">
                <button type="button" class="button button-primary" id="add-section-btn">
                    <?php esc_html_e('Add Section', Constants::TEXT_DOMAIN); ?>
                </button>
            </div>

            <!-- Template ẩn -->
            <template id="lean-lms-section-template">
                <div class="lean-section">
                    <div class="lean-section-header">
                        <div class="item">
                            <h4 class="section-title-display">
                                <?php esc_html_e('(New Section)', Constants::TEXT_DOMAIN); ?>
                            </h4>
                        </div>

                        <div class="item item-action">
                            <!-- Remove button -->
                            <button type="button"
                                    class="btn remove-section"
                                    title="<?php esc_attr_e('Remove', Constants::TEXT_DOMAIN); ?>">
                                <span class="dashicons dashicons-remove"></span>
                            </button>

                            <!-- Drag handle -->
                            <span class="drag-handle" title="<?php esc_attr_e('Drag to reorder', Constants::TEXT_DOMAIN); ?>"></span>

                            <!-- Collapse toggle -->
                            <button type="button"
                                    class="btn collapse-toggle"
                                    aria-label="<?php esc_attr_e('Collapse/Expand', Constants::TEXT_DOMAIN); ?>"
                            >
                                <span class="dashicons dashicons-arrow-up"></span>
                                <span class="dashicons dashicons-arrow-down"></span>
                            </button>
                        </div>
                    </div>

                    <div class="lean-section-body">
                        <div class="group-control">
                            <div class="form-control">
                                <label for="">
                                    <?php esc_html_e('Section title', Constants::TEXT_DOMAIN); ?>
                                </label>

                                <input type="text"
                                       name="lean_lms_sections[][title]"
                                       placeholder="<?php esc_html_e('Section title', Constants::TEXT_DOMAIN); ?>"
                                       class="section-title-input"
                                       aria-label="<?php esc_attr_e('Section title', Constants::TEXT_DOMAIN); ?>" />
                            </div>

                            <div class="form-control">
                                <label for="">
                                    <?php esc_html_e('Description', Constants::TEXT_DOMAIN); ?>
                                </label>

                                <textarea name="lean_lms_sections[][desc]"
                                          placeholder="<?php esc_html_e('Section description', Constants::TEXT_DOMAIN); ?>"
                                          aria-label="<?php esc_attr_e('Section description', Constants::TEXT_DOMAIN); ?>"></textarea>
                            </div>
                        </div>

                        <!-- Danh sách bài học -->
                        <div class="lessons-list"></div>

                        <!-- Add lesson button -->
                        <button type="button" class="button add-lesson">
                            <?php esc_html_e('+ Add Lesson', Constants::TEXT_DOMAIN); ?>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <?php
    }
}