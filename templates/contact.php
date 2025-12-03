<?php

/**
 * Template name: Contact template
 */
get_header();
?>

<!-- section contact-info start -->
<?php get_template_part('templates/contact/contact', 'info'); ?>
<!-- section contact-info end -->

<!-- section contact-section start -->
<?php get_template_part('templates/components/contact-section'); ?>
<!-- section contact-section end -->

<!-- section contact-section start -->
<?php get_template_part('templates/components/alternative'); ?>
<!-- section contact-section end -->


<?php get_footer(); ?>