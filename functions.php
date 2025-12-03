<?php
if (!defined('WP_DEBUG')) {
  die('Direct access forbidden.');
}
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
});

require get_stylesheet_directory() . '/inc/scripts.php';
require get_stylesheet_directory() . '/inc/cpt.php';
require get_stylesheet_directory() . '/inc/custom-button.php';
require get_stylesheet_directory() . '/templates/components/custom-bradcrumbs.php';
require get_stylesheet_directory() . '/templates/components/popup.php';
require get_stylesheet_directory() . '/seo/main-seo.php';
require get_stylesheet_directory() . '/seo/open-graph-socials-media.php';

function remove_category_from_posts()
{
  unregister_taxonomy_for_object_type('category', 'post');
}
add_action('init', 'remove_category_from_posts');

function modField($fieldname)
{
  if (is_tax('produkt-kategorie')) {
    $term = get_queried_object();
    if ($term && isset($term->term_id)) {
      return get_field($fieldname, $term);
    }
  } elseif (get_post_type() === 'produkte' || get_post_type() === 'career' ) {
    return get_sub_field($fieldname);
  } else {
    return get_field($fieldname);
  }

  return false;
}

add_action('blocksy:single:container:bottom', function () {
  if (is_page() && is_page('datenschutzerklaerung')) {
    get_template_part('templates/components/global-faq');
  }
}, 50);

add_action('blocksy:single:container:bottom', function () {
  if (is_page(971)) {
    get_template_part('templates/components/contact-section');
  }
}, 20);


add_filter('get_the_archive_title', function ($title) {
  if (is_author()) {
    return wp_strip_all_tags($title);
  }
  return $title;
}, 20);

if (!function_exists('wpc_should_load_gtm')) {
  function wpc_should_load_gtm(): bool
  {

    if (is_admin())
      return false;

    if (is_user_logged_in() && current_user_can('manage_options'))
      return false;

    if (function_exists('is_customize_preview') && is_customize_preview())
      return false;

    return true;
  }
}


add_action('wp_head', function () {
  if (!wpc_should_load_gtm())
    return; ?>
  <script>
    window.dataLayer = window.dataLayer || [];

    (function () {
      var loaded = false;
      var GTM_ID = 'GTM-5X4M6D7P';
      var userInteracted = false;

      function loadGTM() {
        if (loaded) return;
        loaded = true;

        (function (w, d, s, l, i) {
          w[l] = w[l] || [];
          w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
          var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
          j.async = true;
          j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;

          j.onload = function () {
            window.dataLayer.push({
              event: 'gtm_loaded_successfully',
              load_time: new Date().getTime()
            });
          };

          f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', GTM_ID);
      }

      function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
          window.innerWidth <= 768;
      }

      var interactionDelay = isMobile() ? 50 : 200;
      var userEvents = ['mousedown', 'mousemove', 'touchstart', 'keydown', 'scroll'];

      var interactionHandler = function () {
        if (userInteracted) return;
        userInteracted = true;
        userEvents.forEach(function (ev) {
          document.removeEventListener(ev, interactionHandler);
        });
        setTimeout(loadGTM, interactionDelay);
      };

      userEvents.forEach(function (ev) {
        document.addEventListener(ev, interactionHandler, { passive: true });
      });

      setTimeout(function () {
        if (!loaded) loadGTM();
      }, 3000);
    })();
  </script>
<?php }, 5);

add_action('wp_body_open', function () {
  if (!wpc_should_load_gtm())
    return; ?>
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5X4M6D7P" height="0" width="0"
      style="display:none;visibility:hidden"></iframe>
  </noscript>
<?php });

/* Nikhila Code */

function diso_register_custom_post_types() {
    $article_labels = array(
        'name'               => __( 'Articles', 'diso' ),
        'singular_name'      => __( 'Article', 'diso' ),
        'add_new'            => __( 'Add New Article', 'diso' ),
        'add_new_item'       => __( 'Add New Article', 'diso' ),
        'edit_item'          => __( 'Edit Article', 'diso' ),
        'new_item'           => __( 'New Article', 'diso' ),
        'view_item'          => __( 'View Article', 'diso' ),
        'search_items'       => __( 'Search Articles', 'diso' ),
        'not_found'          => __( 'No Articles found', 'diso' ),
        'not_found_in_trash' => __( 'No Articles found in Trash', 'diso' ),
        'menu_name'          => __( 'Articles', 'diso' ),
    );

    $article_args = array(
        'labels'             => $article_labels,
        'public'             => true,
        'show_in_menu'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'articles' ),
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-media-document',
    );

    register_post_type( 'article', $article_args );

    $case_labels = array(
        'name'               => __( 'Case Studies', 'diso' ),
        'singular_name'      => __( 'Case Study', 'diso' ),
        'add_new'            => __( 'Add New Case Study', 'diso' ),
        'add_new_item'       => __( 'Add New Case Study', 'diso' ),
        'edit_item'          => __( 'Edit Case Study', 'diso' ),
        'new_item'           => __( 'New Case Study', 'diso' ),
        'view_item'          => __( 'View Case Study', 'diso' ),
        'search_items'       => __( 'Search Case Studies', 'diso' ),
        'not_found'          => __( 'No Case Studies found', 'diso' ),
        'not_found_in_trash' => __( 'No Case Studies found in Trash', 'diso' ),
        'menu_name'          => __( 'Case Studies', 'diso' ),
    );

    $case_args = array(
        'labels'             => $case_labels,
        'public'             => true,
        'show_in_menu'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'case-studies' ),
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-analytics',
    );

    register_post_type( 'case_study', $case_args );
}
add_action( 'init', 'diso_register_custom_post_types' );

function diso_child_enqueue_assets() {

    $theme_version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style(
        'diso-child-main',
        get_stylesheet_directory_uri() . '/assets/css/newsroom.css',
        array(),
        $theme_version
    );

    wp_enqueue_script(
        'diso-child-main',
        get_stylesheet_directory_uri() . '/assets/js/newsroom.js',
        array(),
        $theme_version,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'diso_child_enqueue_assets', 20 );

function blocksy_child_enqueue_fonts() {
    wp_enqueue_style(
        'gotham-font',
        get_stylesheet_directory_uri() . '/assets/css/gotham.css',
        array(),
        null
    );
}
add_action( 'wp_enqueue_scripts', 'blocksy_child_enqueue_fonts' );

function disotech_newsroom_assets() {

    
    if ( ! is_page_template( 'page-newsroom.php' ) ) {
        return;
    }
    wp_enqueue_script(
        'embla-carousel',
        'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
        array(),
        null,
        true
    );

    wp_enqueue_script(
        'newsroom-carousel',
        get_stylesheet_directory_uri() . '/assets/js/newsroom-carousel.js',
        array( 'embla-carousel' ),
        null,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'disotech_newsroom_assets' );