<?php
function get_seo_popup_content()
{
    if (is_singular()) {
        $content = get_field('seo_content_to_popup');
        if (!empty($content)) {
            return $content;
        }
    }

    if (is_tax('produkt-kategorie')) {
        $term = get_queried_object();
        $content = get_field('seo_content_to_popup', $term);
        if (!empty($content)) {
            return $content;
        }
    }
    if (is_post_type_archive('produkte')) {
        $content = get_field('seo_content_to_popup', 'option');
        if (!empty($content)) {
            return $content;
        }
    }

    $content = get_field('seo_content_to_popup');

    return $content;
}

function SeoButtonPopup()
{
    $content = get_seo_popup_content();

    if (empty($content)) {
        return '';
    }

    return '<button class="trigger-popup" data-popup-id="examplePopup">
        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.5 1.5625C15.4011 1.5625 18.1833 2.71492 20.2346 4.76625C22.2859 6.81757 23.4383 9.59977 23.4383 12.5008C23.4383 15.4018 22.2859 18.184 20.2346 20.2353C18.1833 22.2866 15.4011 23.4391 12.5 23.4391C9.59904 23.4391 6.81684 22.2866 4.76552 20.2353C2.71419 18.184 1.56177 15.4018 1.56177 12.5008C1.56177 9.59977 2.71419 6.81757 4.76552 4.76625C6.81684 2.71492 9.59904 1.5625 12.5 1.5625ZM14.1407 8.27813C14.9532 8.27813 15.6125 7.71406 15.6125 6.87813C15.6125 6.04219 14.9516 5.47813 14.1407 5.47813C13.3282 5.47813 12.6719 6.04219 12.6719 6.87813C12.6719 7.71406 13.3282 8.27813 14.1407 8.27813ZM14.4266 17.0703C14.4266 16.9031 14.4844 16.4688 14.4516 16.2219L13.1672 17.7C12.9016 17.9797 12.5688 18.1734 12.4125 18.1219C12.3417 18.0958 12.2824 18.0453 12.2455 17.9794C12.2085 17.9135 12.1963 17.8366 12.211 17.7625L14.3516 11C14.5266 10.1422 14.0454 9.35938 13.0251 9.25938C11.9485 9.25938 10.3641 10.3516 9.40005 11.7375C9.40005 11.9031 9.3688 12.3156 9.40161 12.5625L10.6844 11.0828C10.95 10.8063 11.2594 10.6109 11.4157 10.6641C11.4927 10.6917 11.5557 10.7484 11.5914 10.822C11.627 10.8956 11.6324 10.9803 11.6063 11.0578L9.48442 17.7875C9.23911 18.575 9.70317 19.3469 10.8282 19.5219C12.4844 19.5219 13.4625 18.4563 14.4282 17.0703H14.4266Z" fill="white"/>
        </svg>
    </button>';
}

add_action('blocksy:content:bottom', function () {
    $content = get_seo_popup_content();

    if (empty($content)) {
        return;
    }
    ?>

    <div class="site-popups"></div>
    <div id="examplePopup" class="popup-modal" style="display: none;">
        <div class="popup-overlay">
            <div class="popup-box">
                <button class="close-popup" aria-label="Close">&times;</button>
                <div><?php echo wp_kses_post($content); ?></div>
            </div>
        </div>
    </div>

    <script>
        (function ($) {
            $(function () {
                if (window.seoPopupInitialized) {
                    return;
                }
                window.seoPopupInitialized = true;

                $(document).on('click', '.trigger-popup', function (e) {
                    e.preventDefault();
                    const popupId = $(this).attr('data-popup-id');
                    const $modal = $('#' + popupId);

                    if ($modal.length) {
                        $modal.show();
                    }
                });

                $(document).on('click', '.close-popup', function (e) {
                    e.preventDefault();
                    $(this).closest('.popup-modal').hide();
                });

                $(document).on('click', '.popup-overlay', function (e) {
                    if (e.target === this) {
                        $(this).closest('.popup-modal').hide();
                    }
                });

                $(document).on('keydown', function (e) {
                    if (e.key === 'Escape') {
                        $('.popup-modal:visible').hide();
                    }
                });
            });
        })(jQuery);
    </script>
    <?php
});
