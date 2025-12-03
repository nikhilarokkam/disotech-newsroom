<?php
$subtitle = modField('experience_subtitle');
$title = modField('title');
$description = modField('description');
$arrayMainInfo = modField('add_offer_block');
?>

<section class="experience offer-block">
    <div class="container">
        <div class="experience__wrap">
            <div class="offer-block__inner">
                <?php if ($subtitle): ?>
                    <span class="sub-label"><?php echo esc_html($subtitle); ?></span>
                <?php endif; ?>

                <?php if ($title): ?>
                    <h2 class="title experience__title offer--title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($description): ?>
                    <div class="experience__descr">
                        <?php echo $description; ?>
                    </div>
                <?php endif; ?>

                <?php if (is_array($arrayMainInfo)): ?>
                    <?php foreach ($arrayMainInfo as $item): ?>
                        <div class="offer-block-box">
                            <div class="offer-block-box__item">
                                <?php if (!empty($item['title'])): ?>
                                    <h2 class="title experience__title offer--title"><?php echo esc_html($item['title']); ?></h2>
                                <?php endif; ?>

                                <?php if (!empty($item['description'])): ?>
                                    <div class="experience__descr offer--description"><?php echo $item['description']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="offer-block-box__item">
                                <?php if (!empty($item['images'])): ?>
                                    <?php
                                    $image_id = $item['images']['ID'];
                                    $image_alt = $item['images']['alt'] ?: '';

                                    $image_srcset = wp_get_attachment_image_srcset($image_id, 'full');
                                    $image_sizes = '(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 600px';
                                    ?>
                                    <img class="experience__img"
                                        src="<?php echo esc_url(wp_get_attachment_image_url($image_id, 'large', false)); ?>"
                                        srcset="<?php echo esc_attr($image_srcset); ?>"
                                        sizes="<?php echo esc_attr($image_sizes); ?>" alt="<?php echo esc_attr($image_alt); ?>"
                                        loading="lazy" decoding="async">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>