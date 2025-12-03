<?php
$enabled_News   = get_field('news_section_enabled');
$title_News     = get_field('news_section_title');
$shortcode_News = get_field('news_section_shortcode'); 
$button_News    = get_field('news_section_button');
?>

<?php if ($enabled_News): ?>
  <section class="news-section">
    <div class="container">
      <?php if (!empty($title_News)): ?>
        <h2 class="title news-section--title"><?php echo esc_html($title_News); ?></h2>
      <?php endif; ?>

      <?php if (!empty($shortcode_News)): ?>
        <?php echo do_shortcode($shortcode_News); ?>
      <?php endif; ?>

      <?php if (!empty($button_News) && isset($button_News['url'], $button_News['title'])): ?>
        <div class="button-global__wrapper">
        <a href="<?php echo esc_url($button_News['url']); ?>"
          class="button-global"
          <?php if (!empty($button_News['target'])): ?>
          target="<?php echo esc_attr($button_News['target']); ?>"
          rel="noopener"
          <?php endif; ?>>
          <span class="button-global__text"><?php echo esc_html($button_News['title']); ?></span>
          <div class="button-global__liquid"></div>
        </a>
      </div>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>