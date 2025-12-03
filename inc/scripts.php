<?php

function zier_child_enqueue_parent_style()
{
  $version = '1.0.2';

  wp_enqueue_style('zier-custom-css', get_stylesheet_directory_uri() . '/assets/css/custom.css', array(), $version, 'all');
  wp_enqueue_style('zier-custom-vova', get_stylesheet_directory_uri() . '/assets/css/custom-vova.css', array(), $version, 'all');
  wp_enqueue_style('zier-custom-global', get_stylesheet_directory_uri() . '/assets/css/custom-global.css', array(), $version, 'all');
  wp_enqueue_style('zier-custom-home', get_stylesheet_directory_uri() . '/assets/css/home-page.css', array(), $version, 'all');

  wp_enqueue_script('zier-custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array(), $version, true);

  if (is_page_template('templates/about.php')) {
    wp_enqueue_style('zier-contact-page-css', get_stylesheet_directory_uri() . '/assets/css/about.css', array(), $version, 'all');
  }

  if (is_page_template('templates/contact.php')) {
    wp_enqueue_style('zier-custom-contact', get_stylesheet_directory_uri() . '/assets/css/contact-tab.css', array(), $version, 'all');
    wp_enqueue_style('zier-custom-producte', get_stylesheet_directory_uri() . '/assets/css/producte.css', array(), $version, 'all');
  }

  if (is_page_template('templates/service.php')) {
    wp_enqueue_style('zier-custom-service', get_stylesheet_directory_uri() . '/assets/css/service.css', array(), $version, 'all');
    wp_enqueue_style('zier-custom-contact-service', get_stylesheet_directory_uri() . '/assets/css/contact-tab.css', array(), $version, 'all');
  }

  if (is_singular('produkte')) {
    wp_enqueue_style('zier-custom-contact-produkte', get_stylesheet_directory_uri() . '/assets/css/contact-tab.css', array(), $version, 'all');
    wp_enqueue_style('zier-custom-producte-single', get_stylesheet_directory_uri() . '/assets/css/producte.css', array(), $version, 'all');
    wp_enqueue_style('zier-custom-slider', get_stylesheet_directory_uri() . '/assets/css/custom-slider.css', array(), $version, 'all');
    wp_enqueue_script('custom-slider', get_stylesheet_directory_uri() . '/assets/js/custom-slider.js', array(), $version, true);
    wp_enqueue_script('product-lightbox', get_stylesheet_directory_uri() . '/assets/js/product-lightbox.js', array(), $version, true);
  }

  if (!is_front_page() && (!is_single() || get_post_type() === 'produkte' || get_post_type() === 'career')) {
    wp_enqueue_style('zier-custom-breadcrumbs', get_stylesheet_directory_uri() . '/assets/css/breadcrumbs.css', array(), $version, 'all');
  }

  if ((is_home() || is_front_page()) || is_page_template('templates/contact.php') || is_page_template('templates/about.php') || is_page_template('templates/service.php') || is_post_type_archive('produkte') || is_singular('produkte') || is_page(971) || is_singular('career')) {
    wp_enqueue_style('zier-custom-components', get_stylesheet_directory_uri() . '/assets/css/components.css', array(), $version, 'all');
  }

  if (is_post_type_archive('produkte')) {
    wp_enqueue_style('zier-custom-ar-producte', get_stylesheet_directory_uri() . '/assets/css/custom-ar-producte.css', array(), $version, 'all');
  }

  if (is_tax('produkt-kategorie') || is_singular('career')) {
    wp_enqueue_style('zier-custom-producte-tax', get_stylesheet_directory_uri() . '/assets/css/producte.css', array(), $version, 'all');
  }

  if (
    (is_home() || is_archive() || is_search()) &&
    !is_post_type_archive('produkte') &&
    !is_tax('produkt-kategorie')
  ) {
    wp_enqueue_style('zier-custom-fairs', get_stylesheet_directory_uri() . '/assets/css/fairs.css', array(), $version, 'all');
  }

  if (is_home() || is_front_page() || is_page_template('templates/about.php')) {
    wp_enqueue_style('blaze-slider-home-css', get_stylesheet_directory_uri() . '/assets/css/home-style-slider.css', array(), $version, 'all');
    wp_enqueue_script('blaze-slider-home-js', get_stylesheet_directory_uri() . '/assets/js/main-slider.js', array('blaze-slider-js'), $version, true);
  }

  wp_enqueue_style('blaze-slider-css', get_stylesheet_directory_uri() . '/assets/libraries/blaze-slider/blaze-slider.css', array(), $version, 'all');
  wp_enqueue_script('blaze-slider-js', get_stylesheet_directory_uri() . '/assets/libraries/blaze-slider/blaze-slider.js', array(), $version, true);
}

add_action('wp_enqueue_scripts', 'zier_child_enqueue_parent_style');

// Gallery scripts
add_action('wp_enqueue_scripts', function () {
  if (is_page_template('templates/gallery-template.php')) {
    $version = '1.0.1';
    
    // Fancybox CSS
    wp_enqueue_style('fancybox', get_stylesheet_directory_uri() . '/assets/libraries/fancybox/fancybox.css', array(), $version);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Fancybox JS
    wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/assets/libraries/fancybox/fancybox.umd.js', array(), $version, true);

    // Custom gallery CSS
    wp_enqueue_style('my-gallery', get_stylesheet_directory_uri() . '/assets/css/gallary.css', array('fancybox'), $version);
    wp_enqueue_script('my-gallery', get_stylesheet_directory_uri() . '/assets/js/gallary.js', array('fancybox'), $version, true);

    $gallery_categories = get_field('gallery_categories');
    $result = array();

    if (!empty($gallery_categories) && is_array($gallery_categories)) {
      foreach ($gallery_categories as $category) {
        $cat_key = preg_replace('/\s+/', '', $category['tabs_name']);
        $result[$cat_key] = array();

        if (!empty($category['items']) && is_array($category['items'])) {
          foreach ($category['items'] as $item) {
            if (!empty($item['add_pictures']) && is_array($item['add_pictures'])) {
              foreach ($item['add_pictures'] as $pic) {
                $result[$cat_key][] = array(
                  's' => $pic['url'],
                  't' => $pic['url'],
                  'title' => $pic['caption'],
                  'desc' => $pic['description']
                );
              }
            }
          }
        }
      }
    }

    wp_localize_script('my-gallery', 'galleryData', $result);
  }
});

