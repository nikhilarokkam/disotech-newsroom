<?php
$contact_info_swicher  = get_field('contact-custom__swicher', get_the_ID());
$contact_info_repeater = get_field('contact-custom__repeater', get_the_ID());

if ($contact_info_swicher) :
?>

    <section class="contact-custom">
        <div class="contact">
            <div class="contact-custom__wrap">

                <?php
                foreach ($contact_info_repeater as $item) :

                    $icon      = $item['contact-custom__icon'];
                    $address   = $item['contact-custom__address'];
                    $email_box = $item['contact-custom__email-box'];
                    $phone_box = $item['contact-custom__phone-box'];

                    $has_content = !empty(trim($address)) || (!empty($email_box) && is_array($email_box)) || (!empty($phone_box) && is_array($phone_box));

                    if ($has_content) :
                ?>
                        <div class="contact-custom__item">
                            <?php
                            if ($icon) :
                                if (is_array($icon)) {
                                    $icon_url = esc_url($icon['url']);
                                    $icon_alt = esc_attr($icon['alt'] ? $icon['alt'] : 'Contact Icon');
                                } else {
                                    $icon_url = esc_url($icon);
                                    $icon_alt = esc_attr('Contact Icon');
                                }
                            ?>
                                <div class="contact-custom__icon">
                                    <img src="<?php echo $icon_url; ?>" alt="<?php echo $icon_alt; ?>">
                                </div>
                            <?php endif;
                            ?>

                            <div class="contact-custom__content">
                                <?php
                                if (!empty(trim($address))) :
                                ?>
                                    <address><?php echo esc_html($address); ?></address>
                                    <?php
                                elseif (!empty($email_box) && is_array($email_box)) :
                                    foreach ($email_box as $email_item) :
                                        $email = $email_item['contact-info__mail'];
                                        if (!empty(trim($email)) && is_email($email)) :
                                    ?>
                                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                            <?php
                                        endif;
                                    endforeach;

                                elseif (!empty($phone_box) && is_array($phone_box)) :
                                    foreach ($phone_box as $phone_item) :
                                        $phone_raw = $phone_item['contact-info__phone'];
                                        $phone_raw_str = trim((string)$phone_raw);

                                        if (!empty($phone_raw_str)) :

                                            $digits = preg_replace('/[^0-9]/', '', $phone_raw_str);
                                            $phone_link_digits = '';

                                            if (strpos(str_replace(' ', '', $phone_raw_str), '+41') === 0 || strpos(str_replace(' ', '', $phone_raw_str), '41') === 0) {
                                                if (strpos($digits, '410') === 0 && strlen($digits) >= 11) {
                                                    $phone_link_digits = '41' . substr($digits, 3);
                                                } else {
                                                    $phone_link_digits = preg_replace('/[^0-9]/', '', ltrim(str_replace(' ', '', $phone_raw_str), '+'));
                                                }
                                            } elseif (strpos($digits, '0') === 0 && strlen($digits) == 10) {
                                                $phone_link_digits = '41' . substr($digits, 1);
                                            } elseif (strlen($digits) == 9) {
                                                $phone_link_digits = '41' . $digits;
                                            } else {
                                                $phone_link_digits = $digits;
                                            }

                                            $phone_link = 'tel:+' . preg_replace('/[^0-9]/', '', $phone_link_digits);

                                            $display_phone = '';
                                            if (strpos($phone_link_digits, '41') === 0 && strlen($phone_link_digits) == 11) {
                                                $display_phone = '+ ' . substr($phone_link_digits, 0, 2)
                                                    . ' ' . substr($phone_link_digits, 2, 2)
                                                    . ' ' . substr($phone_link_digits, 4, 3)
                                                    . ' ' . substr($phone_link_digits, 7, 2)
                                                    . ' ' . substr($phone_link_digits, 9, 2);
                                            } else {
                                                $fallback_display_cleaned = preg_replace('/[^0-9\s+]/', '', $phone_raw_str);
                                                $fallback_display_cleaned = preg_replace('/\s+/', ' ', $fallback_display_cleaned);
                                                $display_phone = esc_html(trim($fallback_display_cleaned));
                                            }
                                            if (!empty($display_phone)) :
                                            ?>
                                                <a href="<?php echo esc_attr($phone_link); ?>"><?php echo $display_phone; ?></a>
                                <?php
                                            endif;
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    </section>
<?php
endif;
?>