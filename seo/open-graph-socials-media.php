<?php

// add facebook graph
function zier_default_og_image_fallback()
{
    $default_og_image = 'https://zier.ch/wp-content/uploads/2025/11/logo-white.png';

    if (!is_singular('post') && !is_singular('page')) {
        echo '<meta property="og:type" content="website" />' . "\n";
    }


    if (!has_post_thumbnail()) {
        global $wp_query;
        if (!is_singular() || (is_singular() && !has_post_thumbnail($wp_query->post->ID))) {
            echo '<meta property="og:image" content="' . esc_url($default_og_image) . '" />' . "\n";
        }
    }
}

add_action('wp_head', 'zier_default_og_image_fallback', 5);

// add X 

function add_default_twitter_card_tags()
{




    $default_title = get_the_title() ? get_the_title() : 'Zier AG';
    $default_description = "Anlagen und Verbrauchsmaterial zur Wasseraufbereitung ✓ Schwimmbadtechnik für Ihr Pool. Seit über 50 Jahren ist die Firma Zier AG spezialisiert auf das Medium Wasser und deren Aufbereitung";
    $default_image = "https://zier.ch/wp-content/example/og-default.png";

    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";

    echo '<meta name="twitter:title" content="' . esc_attr($default_title) . '" />' . "\n";

    echo '<meta name="twitter:description" content="' . esc_attr($default_description) . '" />' . "\n";

    echo '<meta name="twitter:image" content="' . esc_url($default_image) . '" />' . "\n";

}
add_action('wp_head', 'add_default_twitter_card_tags', 6);