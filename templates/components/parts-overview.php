<?php
$enabled =  modField('parts_enabled');
$title   =  modField('parts_title');
$items   =  modField('parts_items');
$descriptions   =  modField('parts_descr');
$fullwidth      = (bool) modField('parts_fullwidth');


$top_classes = 'parts-overview__top';
if ($fullwidth) {
    $top_classes .= ' parts-overview__top--full';
}
?>

<?php if ($enabled && $items): ?>
    <section class="parts-overview" aria-labelledby="parts-overview">
        <div class="container">
            <div class="<?php echo esc_attr($top_classes); ?>">

                <?php if ($title): ?>
                    <h2 class="parts-overview__title title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($descriptions): ?>
                    <div class="parts-overview__descr"><?php echo $descriptions; ?></div>
                <?php endif; ?>
            </div>

            <ul class="parts-overview__list" role="list">
                <?php foreach ($items as $item): ?>
                    <li class="parts-overview__item teaser">
                        <?php if (! empty($item['icon'])) : ?>
                            <div class="teaser__icon">
                                <img src="<?php echo esc_url($item['icon']['url']); ?>"
                                    alt="<?php echo esc_attr($item['icon']['alt'] ?: ''); ?>"
                                    loading="lazy"
                                    class="teaser__icon-img"
                                    width="60"
                                    height="60">
                            </div>
                        <?php else : ?>
                            <div class="teaser__icon">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/icons/default-icon.svg'); ?>"
                                    alt="Standard Icon"
                                    loading="lazy"
                                    class="teaser__icon-img"
                                    width="60"
                                    height="60">
                            </div>
                        <?php endif; ?>

                        <div class="teaser__inner-box">
                            <?php if (!empty($item['title'])): ?>
                                <h3 class="teaser__title"><?php echo esc_html($item['title']); ?></h3>
                            <?php endif; ?>

                            <?php if (!empty($item['text'])): ?>
                                <p class="teaser__text"><?php echo esc_html($item['text']); ?></p>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
<?php endif; ?>