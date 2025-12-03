<?php
/**
 * Template name: Gallary template
 */
get_header(); ?>

<section class="gallary">
    <div class="container">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile;
        endif;
        ?>
    </div>
</section>
<?php

$gallery_names = get_field('gallery_categories');

?>

<?php if (!empty($gallery_names)): ?>
    <div class="zier-main-container">
        <?php $title = get_field('title'); ?>
        <?php if (!empty($title)): ?>
            <h2 class="zier-gallery-title"><?php echo $title; ?></h2>
        <?php endif; ?>
        <!-- Tab Navigation -->
        <div class="zier-tab-navigation">
            <?php foreach ($gallery_names as $index => $gallery_name): ?>
                <?php
                $tabName = isset($gallery_name['tabs_name']) ? $gallery_name['tabs_name'] : '';
                $iconClass = !empty($gallery_name['icon']) ? $gallery_name['icon'] : 'fas fa-image';
                $data_filter = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '', $tabName));
                $isActive = ($index === 0) ? ' zier-active-tab' : '';
                ?>
                <button class="zier-tab-button<?php echo $isActive; ?>" data-filter="<?php echo esc_attr($data_filter); ?>">
                    <i class="<?php echo esc_attr($iconClass); ?> zier-tab-icon"></i>
                    <div class="zier-loading-spinner"></div>
                    <?php if (!empty($tabName)): ?>
                        <span class="zier-tab-text"><?php echo esc_html($tabName); ?></span>
                    <?php endif; ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Initial Loading -->
        <div class="zier-initial-loading" id="loading">
            <i class="fas fa-magic"></i>
            <p>Galerie wird geladen...</p>
        </div>

        <!-- Tab Loading -->
        <div class="zier-tab-loading-container" id="tabLoading" style="display: none;">
            <div class="zier-tab-spinner"></div>
            <div class="zier-tab-loading-text">Bilder werden geladen...</div>
        </div>

        <!-- Masonry Gallery -->
        <div class="zier-masonry-gallery" id="gallery" style="display: none;"></div>
    </div>
<?php endif; ?>


<?php get_footer(); ?>