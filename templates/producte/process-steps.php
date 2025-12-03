<?php
$show_block = get_sub_field('process-steps__checkbox');
$sub_title = get_sub_field('process-steps__sub-title');
$main_title = get_sub_field('process-steps__title');
$steps_items = get_sub_field('process-steps__items');

if ($show_block): ?>

    <section class="process-steps">
        <div class="container">

            <?php if ($sub_title): ?>
                <p class="sub-label"><?php echo esc_html($sub_title); ?></p>
            <?php endif; ?>

            <?php
            if ($main_title): ?>
                <h2 class="title process-steps__title"><?php echo esc_html($main_title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($steps_items)): ?>
                <div class="process-steps__wrap">
                    <?php foreach ($steps_items as $index => $item):
                        $caption = $item['step_caption'];
                        $text = $item['step_text'];
                        ?>
                        <article class="process-steps__card">
                            <div class="process-steps__box-num">
                                <span class="process-steps__num"><?php echo $index + 1; ?></span>
                            </div>
                            <div class="process-steps__inner">
                                <?php if ($caption): ?>
                                    <h3 class="process-steps__caption"><?php echo esc_html($caption); ?></h3>
                                <?php endif; ?>

                                <?php if ($text): ?>
                                    <div class="process-steps__text">
                                        <p><?php echo esc_html($text); ?> </p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>



