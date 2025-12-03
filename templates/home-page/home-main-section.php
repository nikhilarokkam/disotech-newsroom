<?php
$video = get_field('main_video_mp4');
$title = get_field('main_title');
$description = get_field('main_description');
$btn1 = get_field('main_btn1');
$btn2 = get_field('main_btn2');
$btn3 = get_field('main_btn3');

if ($title || $description || $video): ?>
    <section class="main-section">
        <?php if ($video): ?>
            <div class="main-section__bg-video">
                <video autoplay muted loop playsinline>
                    <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
                </video>
            </div>
        <?php endif; ?>

        <div class="container main-section__container">
            <div class="main-section__inner">
                <?php if ($title): ?>
                    <h1 class="main-section__title"><?php echo esc_html($title); ?></h1>
                <?php endif; ?>

                <?php if ($description): ?>
                    <div class="main-section__description">
                        <p><?php echo esc_html($description); ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($btn1 || $btn2): ?>
                    <div class="main-section__btn-box">
                        <?php if ($btn1): ?>
                            <a href="<?php echo esc_url($btn1['url']); ?>"
                                class="button-global button-global--white button-global--main"
                                <?php if ($btn1['target']) echo 'target="' . esc_attr($btn1['target']) . '"'; ?>>
                                <span class="button-global__text"><?php echo esc_html($btn1['title']); ?></span>
                                <div class="button-global__liquid"></div>
                            </a>
                        <?php endif; ?>

                        <?php if ($btn2): ?>
                            <a href="<?php echo esc_url($btn2['url']); ?>"
                                class="btn-product btn-product--main"
                                <?php if ($btn2['target']) echo 'target="' . esc_attr($btn2['target']) . '"'; ?>>
                                <?php echo esc_html($btn2['title']); ?>
                                <span>
                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.625 11.75L10.625 5.75V11.125H11.875V3.625H4.375V4.875H9.75L3.75 10.875L4.625 11.75Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </a>
                        <?php endif; ?>
                        <?php if ($btn3): ?>
                            <a href="<?php echo esc_url($btn3['url']); ?>"
                                class="button-global button-global--white button-global--main button-global--career"
                                <?php if ($btn3['target']) echo 'target="' . esc_attr($btn3['target']) . '"'; ?>>
                                  <div class="button-global__text global--text-containter"> 
                                <span>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 2L6.4 7.2C5.7 8.2 5.4 9.2 5.4 10.2C5.4 13 7.6 15.2 10.4 15.2C13.2 15.2 15.4 13 15.4 10.2C15.4 9.2 15.1 8.2 14.4 7.2L10 2Z"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M11 10.2C11 9.6 10.5 9.1 9.9 9.1C9.3 9.1 8.8 9.6 8.8 10.2C8.8 10.8 9.3 11.3 9.9 11.3C10.5 11.3 11 10.8 11 10.2Z"
                                            stroke="currentColor"
                                            stroke-width="1.2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M9.9 8.3V7.7M9.9 12.7V12.1M12 10.2H12.6M7.2 10.2H7.8M11.2 8.9L11.7 8.4M8.1 12L8.6 11.5M8.1 8.4L8.6 8.9M11.2 11.5L11.7 12"
                                            stroke="currentColor"
                                            stroke-width="1.2"
                                            stroke-linecap="round" />

                                    </svg>
                                </span>
                                <span>
                              <?php echo esc_html($btn3['title']); ?></span>
                            </div>
                               
                                 <div class="button-global__liquid"></div>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>