<?php

/**
 * Template Name: Newsroom
 */

get_header();
?>

<main id="primary" class="site-main newsroom-page">

    <!-- HERO SECTION -->
    <section class="newsroom-hero">
        <div class="newsroom-hero__inner">
            <div class="newsroom-hero__content">
                <h1 class="newsroom-hero__title">Our Newsroom</h1>
            </div>
        </div>
    </section>

    <!-- FEATURED CASE STUDY SECTION -->
    <section class="newsroom-featured-case">
        <div class="newsroom-featured-case__inner">
            <?php
            $featured_case_query = new WP_Query( array(
                'post_type'      => 'case_study',
                'posts_per_page' => 1,
                'meta_query'     => array(
                    array(
                        'key'   => 'hero_featured',
                        'value' => '1',
                    ),
                ),
            ) );

            if ( $featured_case_query->have_posts() ) :
                while ( $featured_case_query->have_posts() ) :
                    $featured_case_query->the_post();

                    $featured_case_id     = get_the_ID();
                    $featured_short_intro = get_field( 'short_intro', $featured_case_id );
                    $featured_date        = get_the_date( 'd M' );

                    $GLOBALS['newsroom_hero_case_id'] = $featured_case_id;
                    ?>
                    <article class="featured-case-card">
                        <div class="featured-case-card__image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="featured-case-card__content">
                            <?php if ( get_field( 'hero_featured', $featured_case_id ) ) : ?>
                                <span class="badge badge--featured">
                                    FEATURED
                                </span>
                            <?php endif; ?>

                            <h2 class="featured-case-card__title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <?php if ( $featured_short_intro ) : ?>
                                <p class="featured-case-card__excerpt">
                                    <?php echo esc_html( $featured_short_intro ); ?>
                                </p>
                            <?php endif; ?>

                            <div class="featured-case-card__meta">
                                <span class="featured-case-card__author">
                                    <?php echo esc_html( get_the_author() ); ?>
                                </span>

                                <span class="featured-case-card__date">
                                    <?php echo esc_html( $featured_date ); ?>
                                </span>
                            </div>
                        </div>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p class="featured-case-card__no-featured">
                    Please mark one Case Study as "Hero Featured" to show it here.
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- POPULAR ARTICLES SECTION -->
    <section class="newsroom-section newsroom-popular">
        <div class="newsroom-popular__header">
            <div class="newsroom-popular__titles">
                <h2 class="newsroom-section__title">Popular Articles</h2>
                <p class="newsroom-section__subtitle">
                    We share common trends, strategies ideas, opinions, short &amp; long
                    stories from the team behind company.
                </p>
            </div>

            <div class="newsroom-popular__actions">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'article' ) ); ?>" class="btn-view-all">
                    <span>View all</span>
                    <span class="btn-view-all__icon">&rarr;</span>
                </a>
            </div>
        </div>

        <div class="newsroom-grid newsroom-grid--popular">
            <?php
            $popular_articles_query = new WP_Query( array(
                'post_type'      => 'article',
                'posts_per_page' => 3,
                'meta_query'     => array(
                    array(
                        'key'   => 'is_popular',
                        'value' => '1',
                    ),
                ),
            ) );

            if ( $popular_articles_query->have_posts() ) :
                while ( $popular_articles_query->have_posts() ) :
                    $popular_articles_query->the_post();

                    $article_id       = get_the_ID();
                    $article_intro    = get_field( 'short_intro', $article_id );
                    $article_date     = get_the_date( 'd M' );
                    ?>
                    <article class="popular-article-card">
                        <a href="<?php the_permalink(); ?>" class="popular-article-card__link">
                            <div class="popular-article-card__image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large' ); ?>
                                <?php endif; ?>

                                <div class="popular-article-card__overlay"></div>

                                <div class="popular-article-card__top">
                                    <?php if ( get_field( 'is_popular', $article_id ) ) : ?>
                                        <span class="badge badge--featured">FEATURED</span>
                                    <?php endif; ?>
                                </div>

                                <div class="popular-article-card__bottom">
                                    <h3 class="popular-article-card__title">
                                        <?php the_title(); ?>
                                    </h3>

                                    <?php if ( $article_intro ) : ?>
                                        <p class="popular-article-card__excerpt">
                                            <?php echo esc_html( $article_intro ); ?>
                                        </p>
                                    <?php endif; ?>

                                    <div class="popular-article-card__meta">
                                        <span class="popular-article-card__author">
                                            <?php echo esc_html( get_the_author() ); ?>
                                        </span>
                                        <span class="popular-article-card__date">
                                            <?php echo esc_html( $article_date ); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p>No popular articles found. Please mark some Articles as "Popular".</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- RECENT ARTICLES SECTION -->
    <section class="newsroom-section newsroom-recent">
    <div class="newsroom-popular__header">
        <div class="newsroom-popular__titles">
            <h2 class="newsroom-section__title">Recent Articles</h2>
            <p class="newsroom-section__subtitle">
                Here's what we've been up to recently.
            </p>
        </div>

        <div class="newsroom-popular__actions">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'article' ) ); ?>" class="btn-view-all">
                <span>View all</span>
                <span class="btn-view-all__icon">&rarr;</span>
            </a>
        </div>
    </div>

    <div class="newsroom-grid newsroom-grid--recent">
        <?php
        $recent_articles_query = new WP_Query( array(
            'post_type'      => 'article',
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        if ( $recent_articles_query->have_posts() ) :
            while ( $recent_articles_query->have_posts() ) :
                $recent_articles_query->the_post();

                $recent_id    = get_the_ID();
                $recent_intro = get_field( 'short_intro', $recent_id );
                $recent_date  = get_the_date( 'd M' );
                ?>
                <article class="popular-article-card">
                    <a href="<?php the_permalink(); ?>" class="popular-article-card__link">
                        <div class="popular-article-card__image">

                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'large' ); ?>
                            <?php endif; ?>

                            <div class="popular-article-card__overlay"></div>

                            <div class="popular-article-card__bottom">
                                <h3 class="popular-article-card__title">
                                    <?php the_title(); ?>
                                </h3>

                                <?php if ( $recent_intro ) : ?>
                                    <p class="popular-article-card__excerpt">
                                        <?php echo esc_html( $recent_intro ); ?>
                                    </p>
                                <?php endif; ?>

                                <div class="popular-article-card__meta">
                                    <span class="popular-article-card__author">
                                        <?php echo esc_html( get_the_author() ); ?>
                                    </span>
                                    <span class="popular-article-card__date">
                                        <?php echo esc_html( $recent_date ); ?>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </a>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p>No recent articles found.</p>
        <?php endif; ?>
    </div>
    </section>

    <!-- CASE STUDIES SLIDER SECTION -->
    <section class="newsroom-section newsroom-case-studies">
        <div class="newsroom-popular__header">
            <div class="newsroom-popular__titles">
                <h2 class="newsroom-section__title">Case Studies</h2>
                <p class="newsroom-section__subtitle">
                    Here's what we've been up to recently.
                </p>
            </div>

            <div class="newsroom-popular__actions">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'case_study' ) ); ?>" class="btn-view-all">
                    <span>View all</span>
                    <span class="btn-view-all__icon">&rarr;</span>
                </a>
            </div>
        </div>

        <div class="embla newsroom-case-embla">
            <div class="embla__viewport">
                <div class="embla__container">
                    <?php
                    $exclude_ids = array();
                    if ( ! empty( $GLOBALS['newsroom_hero_case_id'] ) ) {
                        $exclude_ids[] = (int) $GLOBALS['newsroom_hero_case_id'];
                    }

                    $case_slider_query = new WP_Query( array(
                        'post_type'      => 'case_study',
                        'posts_per_page' => 3,       
                        'post__not_in'   => $exclude_ids,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ) );

                    if ( $case_slider_query->have_posts() ) :
                        while ( $case_slider_query->have_posts() ) :
                            $case_slider_query->the_post();

                            $case_id      = get_the_ID();
                            $case_intro   = get_field( 'short_intro', $case_id );
                            $case_date    = get_the_date( 'd M' );
                            ?>
                            <div class="embla__slide">
                                <article class="case-card">
                                    <div class="featured-case-card__image">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( 'large' ); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="featured-case-card__content">
                                        <?php if ( get_field( 'hero_featured', $case_id ) ) : ?>
                                            <span class="badge badge--featured">
                                                FEATURED
                                            </span>
                                        <?php endif; ?>

                                        <h2 class="featured-case-card__title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>

                                        <?php if ( $case_intro ) : ?>
                                            <p class="featured-case-card__excerpt">
                                                <?php echo esc_html( $case_intro ); ?>
                                            </p>
                                        <?php endif; ?>

                                        <div class="featured-case-card__meta">
                                            <span class="featured-case-card__author">
                                                <?php echo esc_html( get_the_author() ); ?>
                                            </span>

                                            <span class="featured-case-card__date">
                                                <?php echo esc_html( $case_date ); ?>
                                            </span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <p>No case studies found.</p>
                    <?php endif; ?>
                </div>
            </div>
            <button
                class="embla__button embla__button--prev"
                type="button"
                aria-label="Previous case study">
                &#8592;
            </button>
            <button
                class="embla__button embla__button--next"
                type="button"
                aria-label="Next case study">
                &#8594;
            </button>
        </div>
    </section>

    <!-- ALL ARTICLES SECTION -->
    <section class="newsroom-section newsroom-all">
        <div class="newsroom-popular__header">
            <div class="newsroom-popular__titles">
                <h2 class="newsroom-section__title">All Articles</h2>
                <p class="newsroom-section__subtitle">
                    We share common trends, strategies ideas, opinions, short &amp; long
                    stories from the team behind company.
                </p>
            </div>
        </div>

        <?php
        /**
         * TOP ROW - 2 CARDS
         */
        $all_top_query = new WP_Query( array(
            'post_type'      => 'article',
            'posts_per_page' => 2,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        if ( $all_top_query->have_posts() ) : ?>
            <div class="newsroom-grid newsroom-grid--all-top">
                <?php
                while ( $all_top_query->have_posts() ) :
                    $all_top_query->the_post();

                    $all_id    = get_the_ID();
                    $all_intro = get_field( 'short_intro', $all_id );
                    $all_date  = get_the_date( 'd M' );
                    ?>
                    <article class="popular-article-card">
                        <a href="<?php the_permalink(); ?>" class="popular-article-card__link">
                            <div class="popular-article-card__image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large' ); ?>
                                <?php endif; ?>

                                <div class="popular-article-card__overlay"></div>

                                <div class="popular-article-card__top">
                                    <?php if ( get_field( 'is_popular', $all_id ) ) : ?>
                                        <span class="badge badge--featured">FEATURED</span>
                                    <?php endif; ?>
                                </div>

                                <div class="popular-article-card__bottom">
                                        
                                    <h3 class="popular-article-card__title">
                                        <?php the_title(); ?>
                                    </h3>

                                    <?php if ( $all_intro ) : ?>
                                        <p class="popular-article-card__excerpt">
                                            <?php echo esc_html( $all_intro ); ?>
                                        </p>
                                    <?php endif; ?>

                                    <div class="popular-article-card__meta">
                                        <span class="popular-article-card__author">
                                            <?php echo esc_html( get_the_author() ); ?>
                                        </span>
                                        <span class="popular-article-card__date">
                                            <?php echo esc_html( $all_date ); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>

        <?php
        /**
         * BOTTOM ROW - 3 CARDS
         */
        $all_bottom_query = new WP_Query( array(
            'post_type'      => 'article',
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'offset'         => 2,
        ) );

        if ( $all_bottom_query->have_posts() ) : ?>
            <div class="newsroom-grid newsroom-grid--recent newsroom-grid--all-bottom">
                <?php
                while ( $all_bottom_query->have_posts() ) :
                    $all_bottom_query->the_post();

                    $all_id    = get_the_ID();
                    $all_intro = get_field( 'short_intro', $all_id );
                    $all_date  = get_the_date( 'd M' );
                    ?>
                    <article class="popular-article-card">
                        <a href="<?php the_permalink(); ?>" class="popular-article-card__link">
                            <div class="popular-article-card__image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large' ); ?>
                                <?php endif; ?>

                                <div class="popular-article-card__overlay"></div>

                                <div class="popular-article-card__top">
                                    <?php if ( get_field( 'is_popular', $all_id ) ) : ?>
                                        <span class="badge badge--featured">FEATURED</span>
                                    <?php endif; ?>
                                </div>

                                <div class="popular-article-card__bottom">

                                    <h3 class="popular-article-card__title">
                                        <?php the_title(); ?>
                                    </h3>

                                    <?php if ( $all_intro ) : ?>
                                        <p class="popular-article-card__excerpt">
                                            <?php echo esc_html( $all_intro ); ?>
                                        </p>
                                    <?php endif; ?>

                                    <div class="popular-article-card__meta">
                                        <span class="popular-article-card__author">
                                            <?php echo esc_html( get_the_author() ); ?>
                                        </span>
                                        <span class="popular-article-card__date">
                                            <?php echo esc_html( $all_date ); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

                <div class="newsroom-all__more">
    <a href="<?php echo esc_url( get_post_type_archive_link( 'article' ) ); ?>" class="btn-more-articles">
        More articles
        <span class="btn-more-articles__icon">→</span>
    </a>
</div>

        <?php endif; ?>
    </section>

</main>

<?php
get_footer();
