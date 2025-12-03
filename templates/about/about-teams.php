<section class="teams">
    <div class="container">
        <div class="teams__top">
            <?php if ($sub_title = get_field('sub-label-team', get_the_ID())): ?>
                <span class="sub-label"><?php echo esc_html($sub_title); ?></span>
            <?php endif; ?>

            <div class="teams__box-info">
                <?php if ($title = get_field('main-title-team', get_the_ID())): ?>
                    <h2 class="teams__title title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if ($descr = get_field('teams__description', get_the_ID())): ?>
                    <p class="teams__description">
                        <?php echo esc_html($descr); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="teams__persons">
            <?php
            $team_query = new WP_Query([
                'post_type' => 'zier-team',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'no_found_rows' => true,
            ]);

            if ($team_query->have_posts()):
                while ($team_query->have_posts()):
                    $team_query->the_post();
                    $email = get_field('email-team', get_the_ID());
            ?>
                    <article class="team-card">
                        <div class="teams__img-box">
                            <?php

                            $fallback = get_stylesheet_directory_uri() . '/assets/images/team-img.svg';
                            ?>

                            <div class="product-card__image">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php
                                    $thumb_full = get_the_post_thumbnail_url(null, 'full');
                                    $thumb_large = get_the_post_thumbnail_url(null, 'large');
                                    $thumb_medium = get_the_post_thumbnail_url(null, 'medium');
                                    ?>
                                    <picture>
                                        <source
                                            srcset="<?php echo esc_url($thumb_medium); ?> 768w,
                    <?php echo esc_url($thumb_large); ?> 1200w,
                    <?php echo esc_url($thumb_full); ?> 1920w"
                                            sizes="(max-width: 768px) 100vw, (max-width: 1200px) 80vw, 1200px"
                                            type="image/webp">

                                        <!-- Fallback JPEG/PNG -->
                                        <img
                                            src="<?php echo esc_url($thumb_medium); ?>"
                                            srcset="<?php echo esc_url($thumb_medium); ?> 768w,
                    <?php echo esc_url($thumb_large); ?> 1200w,
                    <?php echo esc_url($thumb_full); ?> 1920w"
                                            sizes="(max-width: 768px) 100vw, (max-width: 1200px) 80vw, 1200px"
                                            alt="<?php the_title_attribute(); ?>"
                                            loading="lazy"
                                            width="1200"
                                            height="800">
                                    </picture>
                                <?php else: ?>
                                    <picture>
                                        <img src="<?php echo esc_url($fallback); ?>" alt="<?php the_title_attribute(); ?>">
                                    </picture>

                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="teams__content-box">
                            <h2 class="teams__name"><?php the_title(); ?></h2>
                            <p class="teams__about"><?php echo esc_html(get_the_excerpt()); ?></p>

                            <?php if ($email): ?>
                                <a href="mailto:<?php echo esc_attr($email); ?>" class="teams__social">
                                    <span class="icon">
                                        <svg width="9" height="9" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_2724_712)">
                                                <path
                                                    d="M2.20819 0.773263C1.94574 0.800729 1.61615 0.931955 1.40558 1.09217C1.28656 1.18372 1.12482 1.35157 1.04852 1.46296L0.995117 1.54383L2.54694 3.09413C4.06519 4.61085 4.10333 4.64747 4.21472 4.70088C4.38409 4.78022 4.51074 4.80616 4.703 4.79853C4.88306 4.7909 5.02802 4.74818 5.1684 4.66273C5.22333 4.63069 5.75586 4.10731 6.7843 3.07887L8.31934 1.54383L8.26593 1.46296C8.18964 1.35157 8.02484 1.18067 7.90735 1.09065C7.77765 0.991464 7.50452 0.858713 7.3504 0.81904C7.28326 0.802255 7.1673 0.780893 7.091 0.773263C6.92926 0.756479 2.36993 0.756479 2.20819 0.773263Z"
                                                    fill="#F9F7F8" />
                                                <path
                                                    d="M0.758247 2.30058C0.75367 2.32957 0.750618 3.29698 0.75367 4.45055L0.758247 6.54863L0.799446 6.69664C0.982552 7.36497 1.53034 7.838 2.20478 7.91277C2.40772 7.93565 6.90601 7.93565 7.10896 7.91277C7.78339 7.838 8.32966 7.36497 8.51429 6.69664L8.55549 6.54863L8.56007 4.45055C8.56312 3.29698 8.56007 2.32957 8.55549 2.30058L8.54633 2.2487L7.11659 3.6754C6.02711 4.76183 5.6609 5.11888 5.57697 5.17381C5.42133 5.27452 5.22907 5.3615 5.05665 5.40727C4.92542 5.44237 4.87965 5.44695 4.65687 5.44695C4.43256 5.44695 4.38831 5.44237 4.25251 5.40727C4.0633 5.35539 3.82832 5.24248 3.68031 5.12956C3.61774 5.08226 2.93568 4.41393 2.16663 3.64488L0.768929 2.2487L0.758247 2.30058Z"
                                                    fill="#F9F7F8" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_2724_712">
                                                    <rect width="7.8125" height="7.8125" fill="currentColor"
                                                        transform="translate(0.75 0.4375)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    <span><?php echo esc_html($email); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </article>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>Keine Team-Mitglieder gefunden.</p>';
            endif;
            ?>
        </div>
    </div>
</section>