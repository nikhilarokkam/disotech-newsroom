<?php get_header(); ?>


<section class="career-content">
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
// Check value exists.
if (have_rows('karriere-block')):

    // Loop through rows.
    while (have_rows('karriere-block')):
        the_row();
        // Case: Paragraph layout.
        if (get_row_layout() == 'offer_main_description'):
            //  section experience start 
            get_template_part('templates/components/about-offer');
            //  section experience end 
        elseif (get_row_layout() == 'philosophie_mission'):
            //  section philosophy start 
            get_template_part('templates/components/philosophy');
            //  section philosophy end 
        elseif (get_row_layout() == 'ersatzteile'):
            //  section philosophy start 
            get_template_part('templates/components/parts-overview');
            //  section custom-slider end 
        elseif (get_row_layout() == 'kontaktbereich'):
            //  section contact-section start 
            get_template_part('templates/components/contact-section');
            //  section contact-section end 
        endif;

    endwhile;

endif;

?>

<!-- section faq start -->
<?php get_template_part('templates/components/global-faq'); ?>
<!-- section faq end -->


<?php get_footer(); ?>