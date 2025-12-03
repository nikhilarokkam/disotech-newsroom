<?php
$enabled = get_field('systems_enabled', 'option');

if ($enabled):
    $title = get_field('systems_title', 'option');
    $items = get_field('systems_items', 'option');
?>

    <section class="systems">
        <div class="container">
            <?php if ($title): ?>
                <header class="systems__header">
                    <h2 class="systems__title title"><?php echo esc_html($title); ?></h2>
                </header>
            <?php endif; ?>

            <?php if ($items): ?>
                <div class="systems__grid">
                    <?php foreach ($items as $item):
                        $icon        = $item['systems_icon'];
                        $number      = $item['systems_number'];
                        $label       = $item['systems_label'];
                        $description = $item['systems_description'];
                        $category    = $item['systems_category']; // WP_Term object
                    ?>
                        <?php if (!empty($category)): ?>
                            <article class="systems__item">
                                <div class="systems__top">
                                    <?php if ($icon): ?>
                                        <img src="<?php echo esc_url($icon['url']); ?>"
                                            alt="<?php echo esc_attr($icon['alt'] ?: ''); ?>"
                                            class="systems__icon">
                                    <?php endif; ?>

                                    <h3 class="systems__item-title"><?php echo esc_html($category->name); ?></h3>
                                </div>

                                <div class="systems__inner">
                                    <div class="systems__inner-left">
                                        <?php if ($number): ?>
                                            <div class="systems__number"><?php echo esc_html($number); ?></div>
                                        <?php endif; ?>

                                        <?php if ($label): ?>
                                            <span class="systems__label"><?php echo esc_html($label); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="systems__inner-right">
                                        <?php if ($description): ?>
                                            <p class="systems__desc"><?php echo esc_html($description); ?></p>
                                        <?php endif; ?>

                                        <a href="<?php echo esc_url(get_term_link($category)); ?>"
                                            class="btn-product btn-product--systems">
                                            <?php echo esc_html__('Produkte', 'textdomain'); ?>
                                            <span>
                                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.625 11.75L10.625 5.75V11.125H11.875V3.625H4.375V4.875H9.75L3.75 10.875L4.625 11.75Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php endif; ?>