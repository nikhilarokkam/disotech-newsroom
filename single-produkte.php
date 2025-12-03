<?php get_header(); ?>


<section class="product-content">
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
if (have_rows('producte_blocks')):

    // Loop through rows.
    while (have_rows('producte_blocks')):
        the_row();

        // Case: Paragraph layout.
        if (get_row_layout() == 'products'):

            get_template_part('templates/producte/producte');

        elseif (get_row_layout() == 'process_steps'):
            //  section process-steps start 
            get_template_part('templates/producte/process-steps');
        //  section process-steps end 
        elseif (get_row_layout() == 'experience_block'):
            //  section experience start 
            get_template_part('templates/components/experience');
        //  section experience end 
        elseif (get_row_layout() == 'philosophie_mission'):
            //  section philosophy start 
            get_template_part('templates/components/philosophy');
        //  section philosophy end 
        elseif (get_row_layout() == 'ersatzteile'):
            //  section philosophy start 
            get_template_part('templates/components/parts-overview');
        //  section philosophy end 
        elseif (get_row_layout() == 'individueller_slider'):
            //  section custom-slider start 
            get_template_part('templates/components/custom-slider');
        //  section custom-slider end 
        elseif (get_row_layout() == 'kontaktbereich'):
            //  section contact-section start 
            get_template_part('templates/components/contact-section');
        //  section contact-section end 
        elseif (get_row_layout() == 'formular_fur_tabs'):
            // section contact-tab start 
            get_template_part('templates/contact/contact', 'tab');
        // section contact-tab end 
        elseif (get_row_layout() == 'alternative_losung_block'):
            // section alternative start 
            get_template_part('templates/components/alternative');
        // section alternative end 
        endif;

    endwhile;

endif;

?>

<!-- section faq start -->
<?php get_template_part('templates/components/global-faq'); ?>
<!-- section faq end -->

<!-- section cta start -->
<?php get_template_part('templates/components/cta'); ?>
<!-- section cta end -->



<?php get_footer(); ?>