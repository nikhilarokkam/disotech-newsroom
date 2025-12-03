<?php



// new

add_action('blocksy:content:top', function () {
    if (is_front_page() || is_home() || (is_single() && get_post_type() === 'post')) {
        return;
    }

    ob_start();
    $top_navigation_class = 'top-navigation';

    if (is_page() && !is_page_template()) {
        $top_navigation_class .= ' top-navigation--custom';
    }
    if (is_tax('produkt-kategorie')) {
        $term = get_queried_object();
        $editor_content = get_field('top_editor', $term);
    } elseif (is_post_type_archive('produkte')) {
        $editor_content = get_field('top_editor', 'option');
    } else {
        $editor_content = get_field('top_editor');
    }

    $map_iframe = '';
    $map_iframe = get_field('top_map');


    $top_image_html = '';
    if (is_singular('career')) {
        $top_image = get_field('top_image');

        if (is_array($top_image) && !empty($top_image['url'])) {
            $alt = !empty($top_image['alt']) ? $top_image['alt'] : get_the_title();
            $src = esc_url($top_image['url']);
            $tiny = 'data:image/gif;base64,R0lGODlhAQABAAAAACw=';
            $top_image_html = '
            <picture>
                <source media="(min-width: 768px)" srcset="' . $src . '">
                <img 
                    src="' . $tiny . '" 
                    alt="' . esc_attr($alt) . '"
                    width="635"
                    height="310"
                    loading="lazy"
                    style="max-width: 100%; height: auto;"
                >
            </picture>';
        }
    }

?>

    <section class="<?php echo esc_attr($top_navigation_class); ?>">
        <div class="container">
            <div class="top-navigation__wrapper">

                <div class="top-navigation__col top-navigation__col--left">
                    <?php
                    $breadcrumbs = do_shortcode("[blocksy_breadcrumbs]");
                    if (!empty($breadcrumbs)) :
                    ?>
                        <div class="custom-breadcrumbs"><?php echo $breadcrumbs; ?></div>
                    <?php endif; ?>

                    <h1 class="title">
                        <?php
                        if (is_page() || is_singular('produkte') || is_singular('career')) {

                            $override = get_field('top_title_override', get_the_ID());
                            $title    = (isset($override) && trim($override) !== '') ? $override : get_the_title();
                        } elseif (is_post_type_archive('produkte')) {

                            $archive_breadcrumbs_title = get_field('title_arhive_breadcrumbs', 'option');
                            $title = $archive_breadcrumbs_title ? $archive_breadcrumbs_title : post_type_archive_title('', false);
                        } elseif (is_tax('produkt-kategorie')) {

                            $title = single_term_title('', false);
                        } elseif (is_archive()) {

                            $title = get_the_archive_title();
                        } else {

                            $title = get_the_title();
                        }

                        echo esc_html($title) . ' ' . SeoButtonPopup();
                        ?>
                    </h1>

                    <?php if (!empty($editor_content)) : ?>
                        <div class="top-editor">
                            <?php echo wp_kses_post($editor_content); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($map_iframe)) : ?>
                    <div class="top-navigation__col top-navigation__col--right">
                        <div class="top-map">
                            <?php echo $map_iframe; ?>
                        </div>
                    </div>

                <?php elseif (!empty($top_image_html)) : ?>
                    <div class="top-navigation__col top-navigation__col--right top-img-responsive">
                        <div class="top-img-box">
                            <?php echo $top_image_html; ?>
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </section>

<?php
    echo ob_get_clean();
});
