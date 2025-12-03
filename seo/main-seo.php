<?php

// Add hreflang
function zier_add_monolingual_hreflang()
{

    $current_url = get_permalink();

    if ($current_url) {
        echo '<link rel="alternate" hreflang="de-CH" href="' . esc_url($current_url) . '" />' . "\n";

        echo '<link rel="alternate" hreflang="x-default" href="' . esc_url($current_url) . '" />' . "\n";
    }
}

add_action('wp_head', 'zier_add_monolingual_hreflang');


// disable second page in custom archive
function zier_fix_produkte_pagination($query) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive('produkte') ) {
        $query->set('posts_per_page', -1);
    }
}
add_action('pre_get_posts', 'zier_fix_produkte_pagination');