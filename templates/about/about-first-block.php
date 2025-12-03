<?php
$enabled = get_field('about_enabled');
$image   = get_field('about_image');
$title   = get_field('about_title');
$text    = get_field('about_text');
?>

<?php if ($enabled): ?>
  <section class="about">
    <div class="container">
      <div class="about__box">
        <?php if ($image): ?>
          <picture>
            <source srcset="<?php echo esc_url($image['url']); ?>" type="<?php echo esc_attr($image['mime_type']); ?>">
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
          </picture>
        <?php endif; ?>

        <div class="about__text">
          <?php if ($title): ?>
            <h2 class="about__title title"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>

          <?php if ($text): ?>
            <div class="about__descr">
              <?php echo wp_kses_post($text); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>