<?php get_header(); ?>

<?php get_template_part('templates/components/allservices'); ?>

<?php
$enabled    = get_field('experience_enabled', 'option');
$subtitle   = get_field('experience_subtitle', 'option');
$title      = get_field('experience_title', 'option');
$paragraph  = get_field('experience_paragraph', 'option');
$image      = get_field('experience_image', 'option');
?>

<?php if ($enabled): ?>
    <section class="experience">
        <div class="container">
            <div class="experience__wrap">
                <div class="experience__inner">
                    <?php if ($subtitle): ?>
                        <span class="sub-label"><?php echo esc_html($subtitle); ?></span>
                    <?php endif; ?>

                    <?php if ($title): ?>
                        <h2 class="title experience__title"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if ($paragraph): ?>
                        <div class="experience__descr">
                            <?php echo $paragraph; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($image): ?>
                        <div class="experience__img-box experience__img-box--mobile">
                            <img class="experience__img"
                                src="<?php echo esc_url($image['url']); ?>"
                                alt="<?php echo esc_attr($image['alt'] ?: ''); ?>">
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($image): ?>
                    <div class="experience__img-box experience__img-box--desktop">
                        <img class="experience__img"
                            src="<?php echo esc_url($image['url']); ?>"
                            alt="<?php echo esc_attr($image['alt'] ?: ''); ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-- section cta start -->
<?php get_template_part('templates/components/cta'); ?>
<!-- section cta end -->

<?php get_footer(); ?>