<?php

/**
 * Template name: Home page
 */
get_header();
?>

<!-- section main-section start -->
<?php get_template_part('templates/home-page/home', 'main-section'); ?>
<!-- section main-section end -->

<!-- section experience start -->
<?php get_template_part('templates/components/experience'); ?>
<!-- section experience end -->

<!-- section allservices start -->
<?php get_template_part('templates/components/allservices'); ?>
<!-- section allservices end -->

<!-- section our-slider start -->
<?php get_template_part('templates/home-page/home', 'our-slider'); ?>
<!-- section our-slider end -->

<!-- section systems start -->
<?php get_template_part('templates/components/systems'); ?>
<!-- section systems end -->

<!-- section lift start -->
<?php get_template_part('templates/components/lift'); ?>
<!-- section lift end -->

<!-- section cta start -->
<?php get_template_part('templates/components/cta'); ?>
<!-- section cta end -->

<!-- section news-section start -->
<?php get_template_part('templates/home-page/home', 'news-section'); ?>
<!-- section news-section end -->

<!-- section contact-section start -->
<?php get_template_part('templates/components/contact-section'); ?>
<!-- section contact-section end -->

<!-- section faq start -->
<?php get_template_part('templates/components/global-faq'); ?>
<!-- section faq end -->


<?php
get_footer();
?>