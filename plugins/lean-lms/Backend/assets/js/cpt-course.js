(function ($) {
    "use strict";

    $(document).ready(function () {
        const $list = $('.sections-list');
        const tpl = document.querySelector('#lean-lms-section-template');

        $('#add-section-btn').on('click', function () {
            const clone = tpl.content.cloneNode(true);
            $list.append(clone);
        });

        $list.on('click', '.remove-section', function () {
            $(this).closest('.lean-section').remove();
        });
    });
})(jQuery);