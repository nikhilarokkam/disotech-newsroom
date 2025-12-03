<?php
$enabled   = get_field('lift_enabled', 'option');
$subtitle  = get_field('lift_subtitle', 'option');
$title     = get_field('lift_title', 'option');
$paragraph = get_field('lift_paragraph', 'option');
$button    = get_field('lift_button', 'option');
$image     = get_field('lift_image', 'option');
?>

<?php if ($enabled): ?>
<section class="lift">
  <div class="container">
    <div class="lift__wrap">
      <div class="lift__content">
        <?php if ($subtitle): ?>
          <span class="sub-label"><?php echo esc_html($subtitle); ?></span>
        <?php endif; ?>

        <?php if ($title): ?>
          <h2 class="lift__title title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($paragraph): ?>
          <div class="lift__text">
            <?php echo $paragraph; ?>
          </div>
        <?php endif; ?>

        <?php if ($button): ?>
          <a href="<?php echo esc_url($button['url']); ?>"
             class="button-global button-global--lift"
             <?php if (!empty($button['target'])) echo 'target="' . esc_attr($button['target']) . '"'; ?>>
            <span class="button-global__text"><?php echo esc_html($button['title']); ?></span>
            <div class="button-global__liquid"></div>
          </a>
        <?php endif; ?>
      </div>

      <?php if ($image): ?>
        <div class="lift__image">
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: ''); ?>">
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>
