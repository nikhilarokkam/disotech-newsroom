<?php
$enabled = modField('contact_enabled');
$subtitle = modField('contact_subtitle');
$quote = modField('contact_quote');
$title = modField('contact_title');
$paragraph = modField('contact_paragraph');
$image = modField('contact_image');
$shortcode = modField('contact_form_shortcode');
$anchor_id = modField('anchor_id');
?>

<?php if ($enabled): ?>
    <section class="contact-section" <?php if ($anchor_id): ?> id="<?php echo esc_attr($anchor_id); ?>" <?php endif; ?>>
        <div class="container">
            <div class="contact-section__box">
                <div class="contact-section__top">
                    <?php if ($subtitle): ?>
                        <span class="sub-label"><?php echo esc_html($subtitle); ?></span>
                    <?php endif; ?>

                    <?php if ($quote): ?>
                        <div class="contact-section__quote"><span><?php echo esc_html($quote); ?></span></div>
                    <?php endif; ?>
                </div>

                <div class="contact-section__wrap">
                    <div class="contact-section__content">
                        <?php if ($title): ?>
                            <h2 class="contact-section__title title"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <?php if ($paragraph): ?>
                            <div class="contact-section__text">
                                <?php echo $paragraph; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($image): ?>
                            <picture class="contact-section__image">
                                <img src="<?php echo esc_url($image['url']); ?>"
                                    alt="<?php echo esc_attr($image['alt'] ?: ''); ?>">
                            </picture>
                        <?php endif; ?>
                    </div>

                    <div class="contact-section__form">
                        <?php if ($quote): ?>
                            <div class="contact-section__quote contact-section__quote--mobile"><span><?php echo esc_html($quote); ?></span></div>
                        <?php endif; ?>
                        <?php if ($shortcode): ?>
                            <?php echo do_shortcode($shortcode); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>