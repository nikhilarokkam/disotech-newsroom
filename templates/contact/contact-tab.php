<?php
$enabled      =  modField('contact_tab_enabled');
$tabs         =  modField('contact_tabs');
$anchor_id    =  modField('anchor_id');
?>

<?php if ($enabled && $tabs): ?>
<section class="contact-tab" id="<?php echo esc_attr($anchor_id ?: 'contact-tab'); ?>">
        <div class="container">
            <div class="contact-tab__tabs" data-tabs>
                <div class="contact-tab__wrap">
                    <div class="contact-tab__nav">
                        <?php foreach ($tabs as $index => $tab): ?>
                            <button class="contact-tab__btn <?php echo $index === 0 ? 'contact-tab__btn--active' : ''; ?>"
                                data-tab="tab-<?php echo esc_attr($index); ?>">
                                <?php echo esc_html($tab['tab_title']); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php foreach ($tabs as $index => $tab): ?>
                    <div class="contact-tab__panel <?php echo $index === 0 ? 'contact-tab__panel--active' : ''; ?>"
                        id="tab-<?php echo esc_attr($index); ?>">
                        <div class="contact-tab__main">
                            <span class="sub-label sub-label--contact"><?php echo esc_html($tab['contact_tab_label']); ?></span>
                            <?php echo wp_kses_post($tab['tab_content']); ?>
                        </div>
                        <?php if (!empty($tab['tab_form'])): ?>
                            <div class="contact-tab__form">
                                <?php echo do_shortcode($tab['tab_form']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>