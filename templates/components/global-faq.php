<?php
$faq_title = get_field('faq_title') ?: 'FAQ';
$faq_tabs = get_field('faq_tabs');
$faq_active_block = get_field('block_anzeigen_faq');

if ($faq_tabs && $faq_active_block): ?>
    <section class="faq">
        <div class="container">
            <h2 class="title faq__title"><?php echo esc_html($faq_title); ?></h2>

            <!-- Tabs Navigation - ALWAYS show -->
            <div class="faq__tabs">
                <?php
                $first_active_found = false;
                foreach ($faq_tabs as $index => $tab):
                    // Always create tab ID
                    $tab_id = !empty($tab['tab_name']) ? sanitize_title($tab['tab_name']) : 'tab-' . $index;

                    // Determine if this tab should be active
                    $is_active = false;
                    if ($tab['tab_active']) {
                        $is_active = true;
                        $first_active_found = true;
                    } elseif (!$first_active_found && !array_filter($faq_tabs, function ($t) {
                        return $t['tab_active'];
                    })) {
                        $is_active = true;
                        $first_active_found = true;
                    }

                    // Use tab name or fallback to "Tab {number}"
                    $tab_display_name = !empty($tab['tab_name']) ? $tab['tab_name'] : 'Tab ' . ($index + 1);
                ?>
                    <button class="faq__tab<?php echo $is_active ? ' faq__tab--active' : ''; ?>"
                        data-tab="<?php echo esc_attr($index); ?>">
                        <?php echo esc_html($tab_display_name); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <?php
            $first_active_content_found = false;
            foreach ($faq_tabs as $index => $tab):
                // Always create tab ID
                $tab_id = !empty($tab['tab_name']) ? sanitize_title($tab['tab_name']) : 'tab-' . $index;

                // Determine if this content should be active
                $is_active = false;
                if ($tab['tab_active']) {
                    $is_active = true;
                    $first_active_content_found = true;
                } elseif (!$first_active_content_found && !array_filter($faq_tabs, function ($t) {
                    return $t['tab_active'];
                })) {
                    $is_active = true;
                    $first_active_content_found = true;
                }
            ?>
                <!-- Tab Content - ALWAYS output -->
                <div class="faq__content<?php echo $is_active ? ' faq__content--active' : ''; ?>"
                    data-content="<?php echo esc_attr($index); ?>">
                    <div class="faq__accordion">

                        <?php if (!empty($tab['faq_items'])): ?>
                            <?php foreach ($tab['faq_items'] as $faq_item): ?>
                                <div class="faq__item">
                                    <button class="faq__question">
                                        <span class="faq__question-text"><?php echo esc_html($faq_item['question']); ?></span>
                                        <span class="faq__icon">+</span>
                                    </button>
                                    <div class="faq__answer">
                                        <?php echo wp_kses_post($faq_item['answer']); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </section>
<?php endif;
?>