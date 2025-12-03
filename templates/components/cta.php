<?php
$enabled = get_field('consultation_enabled', 'option');
$title     = get_field('consultation_title', 'option');
$text      = get_field('consultation_text', 'option');
$button    = get_field('consultation_button', 'option');
$note      = get_field('consultation_note', 'option');
$bg_image  = get_field('consultation_bg_image', 'option');
$bg_style  = $bg_image ? 'style="background-image: url(' . esc_url($bg_image['url']) . ');"' : '';
?>

<?php if ($enabled): ?>
    <section class="consultation">
        <div class="consultation__wrap" <?php echo $bg_style; ?>>
            <div class="container">
                <div class="consultation__content">
                    <?php if ($title): ?>
                        <h2 class="consultation__title title"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if ($text): ?>
                        <p class="consultation__text"><?php echo esc_html($text); ?></p>
                    <?php endif; ?>

                    <?php if ($button): ?>
                        <div class="consultation__buttons">
                            <a href="<?php echo esc_url($button['url']); ?>"
                                class="button-global button-global--white"
                                <?php if ($button['target']) echo 'target="' . esc_attr($button['target']) . '"'; ?>>
                                <span class="button-global__text"><?php echo esc_html($button['title']); ?></span>
                                <div class="button-global__liquid"></div>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($note): ?>
                        <div class="consultation__note"><?php echo esc_html($note); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>