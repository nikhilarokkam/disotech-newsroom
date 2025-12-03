<?php

/**
 * Template name: Servise template
 */
get_header();
?>

<!-- section experience start -->
<?php get_template_part('templates/components/experience'); ?>
<!-- section experience end -->

<!-- section philosophy start -->
<?php get_template_part('templates/components/philosophy'); ?>
<!-- section philosophy end -->

<!-- section systems start -->
<?php get_template_part('templates/components/systems'); ?>
<!-- section systems end -->

<!-- section parts-overview start -->
<?php get_template_part('templates/components/parts-overview'); ?>
<!-- section parts-overview end -->

<!-- section contact-tab start -->
<?php get_template_part('templates/contact/contact', 'tab'); ?>
<!-- section contact-tab end -->

<!-- section faq start -->
<?php get_template_part('templates/components/global-faq'); ?>
<!-- section faq end -->

<?php
get_footer();
?>