<?php
$octagon_slider_swicher  = modField('octagon-slider__swicher');
$octagon_slider_subtitle = modField('octagon-slider__sub-title');
$octagon_slider_title    = modField('octagon-slider__title');
$octagon_slider_gallery  = modField('octagon-slider__gallery');
$octagon_link            = modField('octagon-slider__link');
?>

<?php if ($octagon_slider_swicher && !empty($octagon_slider_gallery)): ?>
    <section class="octagon-slider">
        <div class="container">
            <?php if ($octagon_slider_title): ?>
                <h2 class="title octagon-slider__title"><?php echo esc_html($octagon_slider_title); ?></h2>
            <?php endif; ?>

            <?php if ($octagon_slider_subtitle): ?>
                <p class="slider__descr"><?php echo esc_html($octagon_slider_subtitle); ?></p>
            <?php endif; ?>

            <div id="carousel-area">
                <div id="carousel">
                    <?php foreach ($octagon_slider_gallery as $image): ?>
                        <?php
                        $image_url = $image['sizes']['medium_large'] ?? $image['url'];
                        $alt       = $image['alt'] ?: 'Galeriebild';
                        ?>
                        <div class="carousel-item">
                            <div class="img-wrap">
                                <img
                                    src="<?php echo esc_url($image_url); ?>"
                                    alt="<?php echo esc_attr($alt); ?>"
                                    loading="lazy"
                                    style="width: 100%; height: auto;">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="buttons">
                    <button class="icon-btn" id="carousel-prev">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/arrow-left.svg" alt="prev" class="icon-img">
                    </button>
                    <button class="icon-btn" id="carousel-next">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/arrow-right.svg" alt="next" class="icon-img">
                    </button>
                </div>
            </div>
            <?php if ($octagon_link): ?>
                <div class="octagon-slider__link">
                    <a href="<?php echo esc_url($octagon_link['url']); ?>"
                        class="button-global"
                        <?php if (!empty($octagon_link['target'])) echo 'target="' . esc_attr($octagon_link['target']) . '"'; ?>>
                        <span class="button-global__text"><?php echo esc_html($octagon_link['title']); ?></span>
                        <div class="button-global__liquid"></div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>