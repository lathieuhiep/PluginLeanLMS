(function ($) {
    "use strict";

    $(document).ready(function () {
        // Add new section
        $('#add-section-btn').on('click', function () {
            const $tpl = $('#lean-lms-section-template').html();
            const $section = $($tpl);

            // Gắn sự kiện trong section mới
            bindSectionEvents($section);

            $('.sections-list').append($section);
        });

        // Gắn event cho 1 section (title update, collapse, remove...)
        function bindSectionEvents($section) {
            // Update display title khi nhập input
            $section.on('input', '.section-title-input', function () {
                const val = $(this).val().trim();
                $section.find('.section-title-display').text(val || '(New Section)');
            });

            // Collapse toggle
            $section.on('click', '.collapse-toggle', function () {
                $section.toggleClass('is-collapsed');
            });

            // Remove section
            $section.on('click', '.remove-section', function () {
                $section.remove();
            });
        }

        // Nếu có section load sẵn từ DB thì bind cho chúng
        $('.sections-list .lean-section').each(function () {
            bindSectionEvents($(this));
        });
    });
})(jQuery);