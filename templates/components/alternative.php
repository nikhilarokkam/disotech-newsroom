<?php
$enabled = modField('alt_enabled');
$subtitle = modField('alt_subtitle');
$content_html = modField('alt_content');
$button = modField('alt_button');
$image = modField('alt_image');







$use_alt_raw = modField('alt_altmode');
$use_alt = in_array($use_alt_raw, [1, '1', true, 'true', 'on'], true);

$anchor_id_tabs = modField('anchor_id') ?: 'contact-tab';

$open_tab_id = 'tab-1';
$open_tab_title = 'Regenerationsservice';

$alt_bg_webp = get_stylesheet_directory_uri() . '/assets/images/alter-bg.webp';
$alt_bg_alt_field = modField('alt_bg_alt');
$alt_bg_alt_webp = !empty($alt_bg_alt_field['url']) ? $alt_bg_alt_field['url'] : (get_stylesheet_directory_uri() . '/assets/images/alter-bg-alt.webp');
$active_bg = $use_alt ? $alt_bg_alt_webp : $alt_bg_webp;

$svg_default = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
  <path d="M8.955 5.26701C8.61688 5.23743 8.31786 5.41002 8.1805 5.68192C8.02782 5.96668 8.07238 6.2687 8.26521 6.49851L9.55079 8.0306C9.6922 8.19913 9.94579 8.22132 10.1143 8.0799C10.2829 7.93849 10.305 7.6849 10.1636 7.51637L8.94233 6.06089L14.152 6.38891L13.5649 11.4766C13.5496 11.4894 13.5061 11.4998 13.4933 11.4845L12.2205 9.96771C12.0791 9.79918 11.8255 9.777 11.657 9.91841C11.4885 10.0598 11.4663 10.3134 11.6077 10.4819L12.8933 12.014C13.099 12.2592 13.4603 12.3476 13.7826 12.2338C13.9002 12.1873 13.9897 12.1384 14.0816 12.0612C14.2348 11.9327 14.3213 11.7557 14.3514 11.5738L14.9459 6.40158C14.9631 6.20434 14.8959 5.99971 14.7673 5.8465C14.6388 5.69329 14.4489 5.59151 14.2364 5.58711L8.955 5.26701Z" fill="#004F9F" />
  <path d="M11.2531 8.68951C11.1117 8.52098 10.8581 8.49879 10.6896 8.6402L5.17409 13.2683C5.00556 13.4097 4.98338 13.6633 5.12479 13.8318C5.2662 14.0003 5.51979 14.0225 5.68832 13.8811L11.2038 9.25304C11.3724 9.11163 11.3946 8.85804 11.2531 8.68951Z" fill="#004F9F" />
</svg>';
$svg_alt = '<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
  <path d="M8.56859 9.01141C8.80859 8.77141 8.86859 8.43141 8.74859 8.15141C8.62859 7.85141 8.36859 7.69141 8.06859 7.69141H6.06859C5.84859 7.69141 5.66859 7.87141 5.66859 8.09141C5.66859 8.31141 5.84859 8.49141 6.06859 8.49141H7.96859L4.36859 12.2714L0.848594 8.55141C0.848594 8.53141 0.868594 8.49141 0.888594 8.49141H2.86859C3.08859 8.49141 3.26859 8.31141 3.26859 8.09141C3.26859 7.87141 3.08859 7.69141 2.86859 7.69141H0.868594C0.548594 7.69141 0.248594 7.91141 0.128594 8.23141C0.0885944 8.35141 0.068594 8.45141 0.068594 8.57141C0.068594 8.77141 0.148594 8.95141 0.268594 9.09141L3.84859 12.8714C3.98859 13.0114 4.18859 13.0914 4.38859 13.0914C4.58859 13.0914 4.78859 13.0114 4.92859 12.8514L8.56859 9.01141Z" fill="#004F9F"/>
  <path d="M4.47109 8.57129C4.69109 8.57129 4.87109 8.39129 4.87109 8.17129V0.971289C4.87109 0.751289 4.69109 0.571289 4.47109 0.571289C4.25109 0.571289 4.07109 0.751289 4.07109 0.971289V8.17129C4.07109 8.39129 4.25109 8.57129 4.47109 8.57129Z" fill="#004F9F"/>
</svg>';
$btn_svg = $use_alt ? $svg_alt : $svg_default;

$btn_url_raw = $button['url'] ?? '';
$is_cross_page = $use_alt && preg_match('~^(https?:)?/|^[a-z]+://~i', trim($btn_url_raw));

if ($use_alt) {
    if ($is_cross_page) {
        $href = add_query_arg(
            ['open_tab' => $open_tab_id, 'open_tab_title' => $open_tab_title],
            $btn_url_raw
        );
        $href_attr = esc_url($href);
        $data_attrs = '';
    } else {
        $href_attr = '#' . $anchor_id_tabs;
        $href_attr = esc_attr($href_attr);
        $data_attrs = ' data-scroll-target="#' . esc_attr($anchor_id_tabs) . '"'
            . ' data-activate-tab="' . esc_attr($open_tab_id) . '"'
            . ' data-activate-tab-title="' . esc_attr($open_tab_title) . '"';
    }
} else {
    $href_attr = esc_url($btn_url_raw ?: '#');
    $data_attrs = '';
}
?>

<?php if ($enabled): ?>
    <section class="altblock<?php echo $use_alt ? ' altblock--alt' : ''; ?>">
        <div class="container">
            <div class="altblock__wrap" style="background-image:url('<?php echo esc_url($active_bg); ?>')">
                <div class="altblock__inner">
                    <?php if ($subtitle): ?><span class="sub-label"><?php echo esc_html($subtitle); ?></span><?php endif; ?>
                    <?php if ($content_html): ?>
                        <div class="altblock__content rte"><?php echo $content_html; ?></div><?php endif; ?>

                    <?php if (!empty($image)): ?>
                        <div class="altblock__img-box altblock__img-box--mobile">
                            <img class="altblock__img" src="<?php echo esc_url($image['url']); ?>"
                                alt="<?php echo esc_attr($image['alt'] ?? ''); ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($button)): ?>
                        <div class="altblock__btns">
                            <a href="<?php echo $href_attr; ?>"
                                class="btn-product<?php echo $use_alt ? ' btn-product--alt' : ''; ?>" <?php echo $data_attrs; ?>
                                <?php if (!empty($button['target']) && !$use_alt)
                                    echo 'target="' . esc_attr($button['target']) . '"'; ?>>
                                <?php echo esc_html($button['title']); ?>
                                <span><?php echo $btn_svg; ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($image)): ?>
                    <div class="altblock__img-box altblock__img-box--desktop">
                        <img class="altblock__img" src="<?php echo esc_url($image['url']); ?>"
                            alt="<?php echo esc_attr($image['alt'] ?? ''); ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>