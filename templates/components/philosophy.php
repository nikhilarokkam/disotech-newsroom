<?php
$enabled      = modField('philosophy_enabled');
$title        = modField('philosophy_title');
$subtitle     = modField('philosophy_subtitle');
$cards        = modField('philosophy_cards');
$bottom_text  = modField('bottom_text');
?>

<?php if ($enabled): ?>
    <section class="philosophy" aria-labelledby="philosophy-title">
        <div class="philosophy__bg" aria-hidden="true">
            <div class="container">
                <header class="philosophy__header">
                    <?php if ($title): ?>
                        <h2 class="philosophy__title title"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if ($subtitle): ?>
                        <p class="philosophy__subtitle"><?php echo esc_html($subtitle); ?></p>
                    <?php endif; ?>
                </header>

                <?php if ($cards): ?>
                    <div class="philosophy__list" role="list">
                        <?php foreach ($cards as $card): ?>
                            <article class="philosophy__item card">
                                <?php if (! empty($card['icon'])) : ?>
                                    <div class="card__icon">
                                        <img src="<?php echo esc_url($card['icon']['url']); ?>"
                                            alt="<?php echo esc_attr($card['icon']['alt'] ?? ''); ?>"
                                            loading="lazy"
                                            width="100"
                                            height="100"
                                            class="card__icon-img">
                                    </div>
                                <?php else : ?>
                                    <div class="card__icon">
                                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/icons/default-card-icon.svg'); ?>"
                                            alt="Standard Icon"
                                            loading="lazy"
                                            width="100"
                                            height="100"
                                            class="card__icon-img">
                                    </div>
                                <?php endif; ?>


                                <?php if (!empty($card['title'])): ?>
                                    <h3 class="card__title"><?php echo esc_html($card['title']); ?></h3>
                                <?php endif; ?>

                                <?php if (!empty($card['text'])): ?>
                                    <p class="card__text"><?php echo esc_html($card['text']); ?></p>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($bottom_text): ?>
                    <p class="philosophy__bottom"><?php echo esc_html($bottom_text); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>