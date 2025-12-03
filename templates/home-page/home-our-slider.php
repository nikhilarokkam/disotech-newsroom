<?php
$enabled = get_field('slider_enabled');
$title = get_field('slider_title');
$gallery = get_field('slider_gallery');
$button = get_field('slider_button');
?>

<?php if ($enabled): ?>
    <section class="our-slider">
        <div class="container">
            <?php if ($title): ?>
                <h2 class="title our-slider__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($gallery): ?>
                <div class="blaze-our-slider">
                    <div class="blaze-container">
                        <div class="blaze-track-container">
                            <div class="blaze-track">
                                <?php foreach ($gallery as $image): ?>
                                    <div>
                                        <img src="<?php echo esc_url($image['url']); ?>"
                                            alt="<?php echo esc_attr($image['alt'] ?: ''); ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="my-structure">
                            <div class="blaze-pagination"></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($button): ?>
                <div class="our-slider__box-btn">
                    <a href="<?php echo esc_url($button['url']); ?>" class="button-global"
                        <?php if ($button['target']) echo 'target="' . esc_attr($button['target']) . '"'; ?>>
                        <span class="button-global__text"><?php echo esc_html($button['title']); ?></span>
                        <div class="button-global__liquid"></div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>