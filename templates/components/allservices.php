<?php

$current_term = get_queried_object();
$is_term_page = $current_term instanceof WP_Term;

if (!$is_term_page) {
    $parents = get_terms([
        'taxonomy' => 'produkt-kategorie',
        'hide_empty' => true,
        'parent' => 0,
        'orderby' => 'name',
        'order' => 'ASC',
    ]);
    $view = 'root';
    $terms_to_show = $parents;
} else {
    // Ми всередині терміну
    $children = get_terms([
        'taxonomy' => 'produkt-kategorie',
        'hide_empty' => true,
        'parent' => $current_term->term_id,
        'orderby' => 'name',
        'order' => 'ASC',
    ]);

    if (!empty($children)) {
        $view = 'inner';
        $terms_to_show = $children;
    } else {
        $view = 'leaf';
    }
}
?>

<section class="solutions <?php echo (is_home() || is_front_page()) ? 'solutions--home' : ''; ?>">
    <div class="container">
        <?php

        if ($view === 'root' || $view === 'inner'): ?>

            <h2 class="solutions__title title">
                <?php
                echo esc_html(
                    $view === 'root'
                    ? __('Ihre Lösung für sauberes Wasser – von Experten geplant', 'blocksy')
                    : $current_term->name
                );
                ?>
            </h2>

            <div class="solutions__grid">

                <?php foreach ($terms_to_show as $term):

                    // ACF‑поля
                    $subcaption = get_field('subcaption', $term);
                    $thumbnail = get_field('thumbnail', $term);

                    $thumbnail_url = get_stylesheet_directory_uri() . '/assets/images/fallback.svg';
                    $thumbnail_alt = $term->name;

                    if ($thumbnail) {
                        if (is_array($thumbnail) && !empty($thumbnail['url'])) {
                            $thumbnail_url = $thumbnail['url'];
                            $thumbnail_alt = $thumbnail['alt'] ?: $term->name;
                        } elseif (is_numeric($thumbnail)) {
                            $thumbnail_url = wp_get_attachment_image_url($thumbnail, 'full');
                            $thumbnail_alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true) ?: $term->name;
                        }
                    }

                    // Отримуємо пости з цієї категорії
                    $posts_in_category = new WP_Query([
                        'post_type' => 'produkte',
                        'tax_query' => [
                            [
                                'taxonomy' => 'produkt-kategorie',
                                'field' => 'term_id',
                                'terms' => $term->term_id,
                            ],
                        ],
                        'posts_per_page' => 5, // Обмежуємо кількість постів для показу
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ]);

                    $has_posts = $posts_in_category->have_posts();
                    ?>
                    <article class="solutions__card">

                        <?php if ($subcaption): ?>
                            <span class="solutions__label"><?php echo esc_html($subcaption); ?></span>
                        <?php endif; ?>

                        <!-- Посилання на категорію якщо є пости -->
                        <?php if ($has_posts): ?>
                            <a href="<?php echo esc_url(get_term_link($term)); ?>" class="solutions__img-link">
                                <img class="solutions__img" src="<?php echo esc_url($thumbnail_url); ?>"
                                    alt="<?php echo esc_attr($thumbnail_alt); ?>" />
                            </a>
                        <?php else: ?>
                            <img class="solutions__img" src="<?php echo esc_url($thumbnail_url); ?>"
                                alt="<?php echo esc_attr($thumbnail_alt); ?>" />
                        <?php endif; ?>

                        <h3 class="solutions__caption">
                            <?php if ($has_posts): ?>
                                <a class="solutions__caption-categories-name" href="<?php echo esc_url(get_term_link($term)); ?>">
                                    <?php echo esc_html($term->name); ?>
                                </a>
                            <?php else: ?>
                                <span class="solutions__caption-categories-name">
                                    <?php echo esc_html($term->name); ?>
                                </span>
                            <?php endif; ?>
                        </h3>

                        <?php if ($term->description): ?>
                            <p class="solutions__card-text">
                                <?php echo esc_html(wp_trim_words($term->description, 40, ' …')); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($has_posts): ?>
                            <!-- Показуємо пости з цієї категорії -->
                            <ul class="solutions__card-subcategories">
                                <?php while ($posts_in_category->have_posts()):
                                    $posts_in_category->the_post(); ?>
                                    <li class="solutions__card-item">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                            <span>
                                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.625 11.75L10.625 5.75V11.125H11.875V3.625H4.375V4.875H9.75L3.75 10.875L4.625 11.75Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </ul>

                        <?php else: ?>
                            <!-- Якщо немає постів -->
                            <p class="solutions__empty-category">
                                <?php esc_html_e('Noch keine Produkte in dieser Kategorie.', 'blocksy'); ?>
                            </p>
                        <?php endif; ?>

                    </article>
                <?php endforeach; ?>

            </div><!-- /.solutions__grid -->

            <?php
            // ---------------------------------------------------------------------
            // LEAF: показуємо пости
            // ---------------------------------------------------------------------
        elseif ($view === 'leaf'):

            $posts_q = new WP_Query([
                'post_type' => 'produkte',
                'tax_query' => [
                    [
                        'taxonomy' => 'produkt-kategorie',
                        'field' => 'term_id',
                        'terms' => $current_term->term_id,
                    ],
                ],
                'posts_per_page' => -1,
            ]);

            $secontTitle = get_field('secont_title', $current_term);
            $secondDescription = get_field('second_description', $current_term);
            ?>
            <?php if ($secontTitle): ?>
                <h2 class="solutions__secont-title title">
                    <?php echo esc_html($secontTitle); ?>
                </h2>
            <?php endif; ?>

            <?php if ($secondDescription): ?>
                <div class="solutions__secont-description">
                    <?php echo $secondDescription; ?>
                </div>
            <?php endif; ?>

            <?php if ($posts_q->have_posts()): ?>
                <div class="solutions__grid">
                    <?php while ($posts_q->have_posts()):
                        $posts_q->the_post(); ?>
                        <article <?php post_class('solutions__card'); ?>>

                            <?php if ($subtitlePost = get_field('subtitle_for_the_card', get_the_ID())): ?>
                                <span class="solutions__label"><?php echo esc_html($subtitlePost); ?></span>
                            <?php endif; ?>

                            <?php
                            $excerpt = get_the_excerpt();
                            ?>

                            <a href="<?php the_permalink(); ?>" class="solutions__img-link">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large', [
                                        'class' => 'solutions__img',
                                        'loading' => 'lazy',
                                    ]); ?>
                                <?php else: ?>
                                    <img class="solutions__img"
                                        src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/fallback.svg'); ?>"
                                        alt="<?php echo esc_attr(get_the_title()); ?>">
                                <?php endif; ?>
                            </a>

                            <h3 class="solutions__caption">
                                <a class="solutions__caption-post-name" href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <?php if ($excerpt): ?>
                                <p class="solutions__card-text">
                                    <?php echo esc_html(wp_trim_words($excerpt, 30, ' …')); ?>
                                </p>
                            <?php endif; ?>

                            <a href="<?php the_permalink(); ?>" class="btn-product btn-product--solutions">
                                <?php esc_html_e('Mehr erfahren', 'blocksy'); ?>
                                <span>
                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.625 11.75L10.625 5.75V11.125H11.875V3.625H4.375V4.875H9.75L3.75 10.875L4.625 11.75Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <p><?php esc_html_e('Noch keine Produkte in dieser Kategorie.', 'blocksy'); ?></p>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</section>