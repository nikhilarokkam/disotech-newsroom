<?php
$enabled    = modField('experience_enabled');
$subtitle   = modField('experience_subtitle');
$title      = modField('experience_title');
$paragraph  = modField('experience_paragraph');
$btn1       = modField('experience_btn1');
$btn2       = modField('experience_btn2');
$image      = modField('experience_image');
$images_size_cheker = modField('object_images_size');
$images_position = modField('imagesposition');

if (isset($images_size_cheker) && $images_size_cheker): ?>

<style>
    .experience__img{
    -o-object-fit: contain !important;
     object-fit: contain !important;
    }
</style>

<?php endif; ?>

<?php if ($enabled): ?>
    <section class="experience">
        <div class="container">
            <div class="experience__wrap <?= (isset($images_position) && $images_position === 'right') ? 'right' : 'left'; ?>">
                <div class="experience__inner">
                    <?php if ($subtitle): ?>
                        <span class="sub-label"><?php echo esc_html($subtitle); ?></span>
                    <?php endif; ?>

                    <?php if ($title): ?>
                        <h2 class="title experience__title"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if ($paragraph): ?>
                        <div class="experience__descr">
                            <?php echo $paragraph; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Мобільне зображення -->
                    <?php if ($image): ?>
                        <div class="experience__img-box experience__img-box--mobile">
                            <img class="experience__img" src="<?php echo esc_url($image['url']); ?>"
                                alt="<?php echo esc_attr($image['alt'] ?: ''); ?>">
                        </div>
                    <?php endif; ?>

                    <?php if ($btn1 || $btn2): ?>
                        <div class="experience__box-btn">
                            <?php if ($btn1): ?>
                                <a href="<?php echo esc_url($btn1['url']); ?>" class="button-global" <?php if ($btn1['target'])
                                       echo 'target="' . esc_attr($btn1['target']) . '"'; ?>>
                                    <span class="button-global__text"><?php echo esc_html($btn1['title']); ?></span>
                                    <div class="button-global__liquid"></div>
                                </a>
                            <?php endif; ?>

                            <?php if ($btn2): ?>
                                <a href="<?php echo esc_url($btn2['url']); ?>" class="btn-product" <?php if ($btn2['target'])
                                       echo 'target="' . esc_attr($btn2['target']) . '"'; ?>>
                                    <?php echo esc_html($btn2['title']); ?>
                                    <span>
                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4.625 11.75L10.625 5.75V11.125H11.875V3.625H4.375V4.875H9.75L3.75 10.875L4.625 11.75Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Десктопне зображення -->
                <?php if ($image): ?>
                    <div class="experience__img-box experience__img-box--desktop">
                        <img class="experience__img" src="<?php echo esc_url($image['url']); ?>"
                            alt="<?php echo esc_attr($image['alt'] ?: ''); ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>