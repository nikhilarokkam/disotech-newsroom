<section class="product-cards">
    <div class="container">
        <?php
        $sub_title = get_sub_field('subcategories');
        if ($sub_title): ?>
            <p class="sub-label"><?php echo esc_html($sub_title); ?></p>
        <?php endif; ?>
        <div class="product-cards__wrap">

            <?php if (have_rows('product_cards_block')): ?>
                <?php while (have_rows('product_cards_block')):
                    the_row(); ?>
                    <?php
                    $badge = get_sub_field('badge_text');
                    $images = get_sub_field('image');
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $pdf = get_sub_field('pdf_file');
                    $schema = get_sub_field('schema_file');
                    ?>


                    <article class="product-card">
                        <?php if ($badge): ?>
                            <div class="product-card__badge">
                                <span><?php echo esc_html($badge); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php

                        $thumbnail_url = get_stylesheet_directory_uri() . '/assets/images/fallback.svg';

                        $image_urls = [];
                        if (!empty($images) && is_array($images)) {
                            foreach ($images as $img) {
                                if (!empty($img['sizes']['medium_large'])) {
                                    $image_urls[] = $img['sizes']['medium_large'];
                                } elseif (!empty($img['url'])) {
                                    $image_urls[] = $img['url'];
                                }
                            }
                        }

                        if (empty($image_urls)) {
                            $image_urls[] = $thumbnail_url;
                        }
                        ?>

                        <div class="product-card__image"
                            data-images='<?php echo json_encode($image_urls, JSON_UNESCAPED_SLASHES); ?>'>
                            <div class="image-slider">
                                <div class="slider-container">
                                    <?php foreach ($image_urls as $index => $url): ?>
                                        <img src="<?php echo esc_url($url); ?>"
                                            alt="<?php echo esc_attr($images[$index]['alt'] ?? ''); ?>"
                                            class="slider-image <?php echo $index === 0 ? 'active' : ''; ?>" />
                                    <?php endforeach; ?>
                                </div>

                                <button class="slider-btn prev-btn" aria-label="Previous image">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button class="slider-btn next-btn" aria-label="Next image">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <div class="slider-dots <?php echo (count($image_urls) >= 5) ? 'hidden' : ''; ?>">
                                    <?php foreach ($image_urls as $index => $_): ?>
                                        <span class="dot <?php echo $index === 0 ? 'active' : ''; ?>"
                                            data-slide="<?php echo $index; ?>"></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <span class="icon-search">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img">
                                    <title>Zoom in</title>
                                    <g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="6.5" />
                                        <path d="M11 8v6M8 11h6" /> 
                                        <line x1="16.4" y1="16.4" x2="21" y2="21" /> 
                                    </g>
                                </svg>

                            </span>
                        </div>

                        <?php if ($title): ?>
                            <h3 class="product-card__title"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($description): ?>
                            <p class="product-card__description"><?php echo esc_html($description); ?></p>
                        <?php endif; ?>

                        <div class="product-card__box-btn">
                            <?php if ($pdf): ?>
                                <a href="<?php echo esc_url($pdf['url']); ?>" class="product-card__pdf-button" target="_blank"
                                    rel="noopener">
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.6797 14.8438C21.6797 14.9992 21.618 15.1482 21.5081 15.2581C21.3982 15.368 21.2492 15.4297 21.0938 15.4297H18.5547V17.3828H20.3125C20.4679 17.3828 20.6169 17.4445 20.7268 17.5544C20.8367 17.6643 20.8984 17.8133 20.8984 17.9688C20.8984 18.1242 20.8367 18.2732 20.7268 18.3831C20.6169 18.493 20.4679 18.5547 20.3125 18.5547H18.5547V20.3125C18.5547 20.4679 18.493 20.6169 18.3831 20.7268C18.2732 20.8367 18.1242 20.8984 17.9688 20.8984C17.8133 20.8984 17.6643 20.8367 17.5544 20.7268C17.4445 20.6169 17.3828 20.4679 17.3828 20.3125V14.8438C17.3828 14.6883 17.4445 14.5393 17.5544 14.4294C17.6643 14.3195 17.8133 14.2578 17.9688 14.2578H21.0938C21.2492 14.2578 21.3982 14.3195 21.5081 14.4294C21.618 14.5393 21.6797 14.6883 21.6797 14.8438ZM8.78906 16.7969C8.78906 17.4703 8.52155 18.1161 8.04539 18.5923C7.56922 19.0684 6.9234 19.3359 6.25 19.3359H5.27344V20.3125C5.27344 20.4679 5.21171 20.6169 5.10182 20.7268C4.99194 20.8367 4.8429 20.8984 4.6875 20.8984C4.5321 20.8984 4.38306 20.8367 4.27318 20.7268C4.16329 20.6169 4.10156 20.4679 4.10156 20.3125V14.8438C4.10156 14.6883 4.16329 14.5393 4.27318 14.4294C4.38306 14.3195 4.5321 14.2578 4.6875 14.2578H6.25C6.9234 14.2578 7.56922 14.5253 8.04539 15.0015C8.52155 15.4777 8.78906 16.1235 8.78906 16.7969ZM7.61719 16.7969C7.61719 16.4343 7.47315 16.0865 7.21675 15.8301C6.96035 15.5737 6.6126 15.4297 6.25 15.4297H5.27344V18.1641H6.25C6.6126 18.1641 6.96035 18.02 7.21675 17.7636C7.47315 17.5072 7.61719 17.1595 7.61719 16.7969ZM15.8203 17.5781C15.8203 18.4587 15.4705 19.3033 14.8478 19.9259C14.2251 20.5486 13.3806 20.8984 12.5 20.8984H10.9375C10.7821 20.8984 10.6331 20.8367 10.5232 20.7268C10.4133 20.6169 10.3516 20.4679 10.3516 20.3125V14.8438C10.3516 14.6883 10.4133 14.5393 10.5232 14.4294C10.6331 14.3195 10.7821 14.2578 10.9375 14.2578H12.5C13.3806 14.2578 14.2251 14.6076 14.8478 15.2303C15.4705 15.853 15.8203 16.6975 15.8203 17.5781ZM14.6484 17.5781C14.6484 17.0083 14.4221 16.4619 14.0192 16.059C13.6163 15.656 13.0698 15.4297 12.5 15.4297H11.5234V19.7266H12.5C13.0698 19.7266 13.6163 19.5002 14.0192 19.0973C14.4221 18.6944 14.6484 18.1479 14.6484 17.5781ZM4.10156 10.9375V3.90625C4.10156 3.54365 4.24561 3.1959 4.502 2.9395C4.7584 2.68311 5.10615 2.53906 5.46875 2.53906H14.8438C14.9208 2.539 14.9972 2.55415 15.0684 2.58365C15.1396 2.61314 15.2043 2.6564 15.2588 2.71094L20.7275 8.17969C20.8371 8.28963 20.8986 8.43854 20.8984 8.59375V10.9375C20.8984 11.0929 20.8367 11.2419 20.7268 11.3518C20.6169 11.4617 20.4679 11.5234 20.3125 11.5234C20.1571 11.5234 20.0081 11.4617 19.8982 11.3518C19.7883 11.2419 19.7266 11.0929 19.7266 10.9375V9.17969H14.8438C14.6883 9.17969 14.5393 9.11795 14.4294 9.00807C14.3195 8.89819 14.2578 8.74915 14.2578 8.59375V3.71094H5.46875C5.41695 3.71094 5.36727 3.73152 5.33064 3.76814C5.29401 3.80477 5.27344 3.85445 5.27344 3.90625V10.9375C5.27344 11.0929 5.21171 11.2419 5.10182 11.3518C4.99194 11.4617 4.8429 11.5234 4.6875 11.5234C4.5321 11.5234 4.38306 11.4617 4.27318 11.3518C4.16329 11.2419 4.10156 11.0929 4.10156 10.9375ZM15.4297 8.00781H18.8984L15.4297 4.53906V8.00781Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span>PDF herunterladen</span>
                                </a>
                            <?php endif; ?>
                            <?php if ($schema): ?>
                                <a href="<?php echo esc_url($schema['url']); ?>" class="product-card__schema-link" target="_blank"
                                    rel="noopener" download>
                                  <?php echo $schema['caption'] ? '<span>' . $schema['caption'] . '</span>' : '<span>Schema</span>'; ?>        
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.67004 1.73553C9.56792 1.83766 9.53387 3.17666 9.53387 7.03481V12.2093L7.8431 10.5185C6.4814 9.15678 6.10693 8.8504 5.89133 8.88445C5.25587 8.96388 5.49417 9.31565 7.70693 11.5057C9.54522 13.344 9.88565 13.6277 10.0559 13.5369C10.1807 13.4688 11.1793 12.5043 12.3027 11.3809C14.3679 9.29295 14.5949 8.96388 13.9707 8.88445C13.7551 8.8504 13.3807 9.15678 12.019 10.5185L10.3282 12.2093V7.03481C10.3282 1.82631 10.3169 1.59936 9.93104 1.59936C9.86295 1.59936 9.74948 1.6561 9.67004 1.73553Z"
                                            fill="currentColor" />
                                        <path
                                            d="M0.0814049 12.913C-0.0547649 13.0379 -0.00937494 15.2279 0.138142 15.7159C0.217575 15.9882 0.501262 16.3967 0.796296 16.7031C1.6814 17.6223 1.45445 17.5996 9.93102 17.5996C18.1693 17.5996 18.1126 17.5996 18.9523 16.8506C19.6899 16.1811 19.8601 15.6818 19.8601 14.218C19.8601 13.14 19.826 12.9244 19.6785 12.8677C19.2473 12.6974 19.1225 12.9698 19.0657 14.2634C19.0317 14.9442 18.9523 15.6024 18.8728 15.7272C18.6572 16.1017 18.1239 16.5442 17.7154 16.6804C17.2161 16.8393 2.73672 16.862 2.16934 16.6918C1.72679 16.5669 1.19346 16.113 0.955161 15.6478C0.853034 15.4435 0.796296 14.9669 0.796296 14.218C0.796296 13.5031 0.750906 13.0606 0.660127 12.9698C0.512609 12.8223 0.19488 12.7882 0.0814049 12.913Z"
                                            fill="currentColor" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>

                    </article>
                <?php endwhile; ?>
            <?php endif; ?>

        </div>
    </div>
</section>