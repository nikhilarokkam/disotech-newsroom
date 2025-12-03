<?php
add_action('wp_footer', 'gs_floating_button');

function gs_floating_button()
{
    if (is_admin() || is_404()) {
        return;
    }

    $enabled = get_field('floating_button_enable', 'option');
    if (!$enabled) {
        return;
    }

    $link = get_field('floating_button_link', 'option');
    if (!$link || empty($link['url'])) {
        return;
    }

    $button_url    = esc_url($link['url']);
    $button_label  = esc_html($link['title'] ?: 'Mehr erfahren');
    $button_target = $link['target'] ? ' target="_blank" rel="noopener"' : '';

    $current_url = rtrim(home_url($_SERVER['REQUEST_URI']), '/');
    $target_url  = rtrim($button_url, '/');

    if ($current_url === $target_url) {
        return;
    }
    ?>

    <a href="<?php echo $button_url; ?>"
       class="gs-floating-button js-gs-floating-button"
       <?php echo $button_target; ?>>
        <?php echo $button_label; ?>
    </a>

    <script>
        (function () {
            document.addEventListener('DOMContentLoaded', function () {
                var btn = document.querySelector('.js-gs-floating-button');
                var footer = document.querySelector('footer.site-footer, footer#colophon, footer');

                if (!btn || !footer || !('IntersectionObserver' in window)) {
                    return;
                }

                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            btn.classList.add('gs-floating-button--hidden');
                        } else {
                            btn.classList.remove('gs-floating-button--hidden');
                        }
                    });
                }, {
                    threshold: 0    
                });

                observer.observe(footer);
            });
        })();
    </script>

    <?php
}
