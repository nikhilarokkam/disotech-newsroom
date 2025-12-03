<?php

function zier_post_type_teams()
{
    $zier_labels = array(
        'name' => esc_html_x('Team', 'Post type general name', 'blocksy'),
        'singular_name' => esc_html_x('Mitglied des Teams', 'Post type singular name', 'blocksy'),
        'menu_name' => esc_html_x('Team', 'Admin Menu text', 'blocksy'),
        'name_admin_bar' => esc_html_x('Mitglied des Teams', 'Add New on Toolbar', 'blocksy'),
        'add_new' => esc_html__('Neu hinzufügen', 'blocksy'),
        'add_new_item' => esc_html__('Neues Mitglied des Teams hinzufügen', 'blocksy'),
        'new_item' => esc_html__('Neues Mitglied des Teams', 'blocksy'),
        'edit_item' => esc_html__('Mitglied des Teams bearbeiten', 'blocksy'),
        'view_item' => esc_html__('Mitglied des Teams anzeigen', 'blocksy'),
        'all_items' => esc_html__('Alle Mitglieder des Teams', 'blocksy'),
        'search_items' => esc_html__('Mitglieder des Teams suchen', 'blocksy'),
        'parent_item_colon' => esc_html__('Elternmitglieder des Teams:', 'blocksy'),
        'not_found' => esc_html__('Keine Mitglieder des Teams gefunden.', 'blocksy'),
        'not_found_in_trash' => esc_html__('Keine Mitglieder des Teams im Papierkorb gefunden.', 'blocksy'),
        'featured_image' => esc_html_x('Profilbild des Mitglieds des Teams', 'blocksy'),
        'set_featured_image' => esc_html_x('Profilbild des Mitglieds des Teams festlegen', 'blocksy'),
        'remove_featured_image' => esc_html_x('Profilbild des Mitglieds des Teams entfernen', 'blocksy'),
        'use_featured_image' => esc_html_x('Als Profilbild des Mitglieds des Teams verwenden', 'blocksy'),
        'archives' => esc_html_x('Archiv der Mitglieder des Teams', 'blocksy'),
        'insert_into_item' => esc_html_x('In Mitglied des Teams einfügen', 'blocksy'),
        'uploaded_to_this_item' => esc_html_x('Zu diesem Mitglied des Teams hochgeladen', 'blocksy'),
        'filter_items_list' => esc_html_x('Mitglieder des Teams filtern', 'blocksy'),
        'items_list_navigation' => esc_html_x('Navigation der Mitglieder des Teams', 'blocksy'),
        'items_list' => esc_html_x('Liste der Mitglieder des Teams', 'blocksy'),
    );

    $args = array(
        'labels' => $zier_labels,
        'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
        'public' => true,
        'publicly_queryable' => false, 
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-businessperson',
        'show_in_rest' => true,
        'menu_position' => 4
    );

    register_post_type('zier-team', $args);
}

add_action('init', 'zier_post_type_teams');


function zier_post_type_produkte()
{
    $labels = array(
        'name' => esc_html_x('Produkte', 'Post type general name', 'blocksy'),
        'singular_name' => esc_html_x('Produkt', 'Post type singular name', 'blocksy'),
        'menu_name' => esc_html_x('Produkte', 'Admin Menu text', 'blocksy'),
        'name_admin_bar' => esc_html_x('Produkt', 'Add New on Toolbar', 'blocksy'),
        'add_new' => esc_html__('Neu hinzufügen', 'blocksy'),
        'add_new_item' => esc_html__('Neues Produkt hinzufügen', 'blocksy'),
        'new_item' => esc_html__('Neues Produkt', 'blocksy'),
        'edit_item' => esc_html__('Produkt bearbeiten', 'blocksy'),
        'view_item' => esc_html__('Produkt anzeigen', 'blocksy'),
        'all_items' => esc_html__('Alle Produkte', 'blocksy'),
        'search_items' => esc_html__('Produkte suchen', 'blocksy'),
        'parent_item_colon' => esc_html__('Elternprodukt:', 'blocksy'),
        'not_found' => esc_html__('Keine Produkte gefunden.', 'blocksy'),
        'not_found_in_trash' => esc_html__('Keine Produkte im Papierkorb gefunden.', 'blocksy'),
        'featured_image' => esc_html_x('Produktbild', 'blocksy'),
        'set_featured_image' => esc_html_x('Produktbild festlegen', 'blocksy'),
        'remove_featured_image' => esc_html_x('Produktbild entfernen', 'blocksy'),
        'use_featured_image' => esc_html_x('Als Produktbild verwenden', 'blocksy'),
        'archives' => esc_html_x('Produkte-Archiv', 'blocksy'),
        'insert_into_item' => esc_html_x('In Produkt einfügen', 'blocksy'),
        'uploaded_to_this_item' => esc_html_x('Zu diesem Produkt hochgeladen', 'blocksy'),
        'filter_items_list' => esc_html_x('Produkte filtern', 'blocksy'),
        'items_list_navigation' => esc_html_x('Navigation der Produkte', 'blocksy'),
        'items_list' => esc_html_x('Produktliste', 'blocksy'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'produkte'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-products',
        'show_in_rest' => true,
        'menu_position' => 5
    );

    register_post_type('produkte', $args);
}
add_action('init', 'zier_post_type_produkte');

function zier_taxonomy_produkt_kategorie()
{
    $labels = array(
        'name' => esc_html__('Produktkategorien', 'blocksy'),
        'singular_name' => esc_html__('Produktkategorie', 'blocksy'),
        'search_items' => esc_html__('Kategorien durchsuchen', 'blocksy'),
        'all_items' => esc_html__('Alle Kategorien', 'blocksy'),
        'parent_item' => esc_html__('Übergeordnete Kategorie', 'blocksy'),
        'parent_item_colon' => esc_html__('Übergeordnete Kategorie:', 'blocksy'),
        'edit_item' => esc_html__('Kategorie bearbeiten', 'blocksy'),
        'update_item' => esc_html__('Kategorie aktualisieren', 'blocksy'),
        'add_new_item' => esc_html__('Neue Kategorie hinzufügen', 'blocksy'),
        'new_item_name' => esc_html__('Name der neuen Kategorie', 'blocksy'),
        'menu_name' => esc_html__('Kategorien', 'blocksy'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'produkt-kategorie'),
        'show_in_rest' => true,
    );

    register_taxonomy('produkt-kategorie', array('produkte'), $args);
}
add_action('init', 'zier_taxonomy_produkt_kategorie');


// carrers
function zier_post_type_carries()
{
    $zier_labels = array(
        'name' => esc_html_x('Karriere', 'Post type general name', 'blocksy'),
        'singular_name' => esc_html_x('Stellenangebot', 'Post type singular name', 'blocksy'),
        'menu_name' => esc_html_x('Karriere', 'Admin Menu text', 'blocksy'),
        'name_admin_bar' => esc_html_x('Stellenangebot', 'Add New on Toolbar', 'blocksy'),
        'add_new' => esc_html__('Neue Stelle hinzufügen', 'blocksy'),
        'add_new_item' => esc_html__('Neues Stellenangebot hinzufügen', 'blocksy'),
        'new_item' => esc_html__('Neues Stellenangebot', 'blocksy'),
        'edit_item' => esc_html__('Stellenangebot bearbeiten', 'blocksy'),
        'view_item' => esc_html__('Stellenangebot ansehen', 'blocksy'),
        'all_items' => esc_html__('Alle Stellenangebote', 'blocksy'),
        'search_items' => esc_html__('Stellenangebote suchen', 'blocksy'),
        'parent_item_colon' => esc_html__('Übergeordnete Stellenangebote:', 'blocksy'),
        'not_found' => esc_html__('Keine Stellenangebote gefunden.', 'blocksy'),
        'not_found_in_trash' => esc_html__('Keine Stellenangebote im Papierkorb gefunden.', 'blocksy'),
        'featured_image' => esc_html_x('Titelbild der Stelle', 'blocksy'),
        'set_featured_image' => esc_html_x('Titelbild der Stelle festlegen', 'blocksy'),
        'remove_featured_image' => esc_html_x('Titelbild der Stelle entfernen', 'blocksy'),
        'use_featured_image' => esc_html_x('Als Titelbild der Stelle verwenden', 'blocksy'),
        'archives' => esc_html_x('Stellen-Archiv', 'blocksy'),
        'insert_into_item' => esc_html_x('In Stellenangebot einfügen', 'blocksy'),
        'uploaded_to_this_item' => esc_html_x('Zu diesem Stellenangebot hochgeladen', 'blocksy'),
        'filter_items_list' => esc_html_x('Stellenangebote filtern', 'blocksy'),
        'items_list_navigation' => esc_html_x('Navigation der Stellenangebote', 'blocksy'),
        'items_list' => esc_html_x('Liste der Stellenangebote', 'blocksy'),
    );

    $args = array(
        'labels' => $zier_labels,
        'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'has_archive' => false,
        'rewrite' => array(
            'slug' => 'karriere',
        ),
        'menu_icon' => 'dashicons-id',
        'show_in_rest' => true,
        'menu_position' => 4,
    );

    register_post_type('career', $args);
}

add_action('init', 'zier_post_type_carries');

