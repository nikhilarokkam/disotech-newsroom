<?php

/**
 * Template name: About template
 */
get_header();
?>

<!-- section about-firs-block start -->
<?php get_template_part('templates/about/about', 'first-block'); ?>
<!-- section about-firs-block end -->

<!-- section experience start -->
<?php get_template_part('templates/components/experience'); ?>
<!-- section experience end -->

<!-- section philosophy start -->
<?php get_template_part('templates/components/philosophy'); ?>
<!-- section philosophy end -->

<!-- section about-teams start -->
<?php get_template_part('templates/about/about', 'teams'); ?>
<!-- section about-teams end -->

<!-- section our-slider start -->
<?php get_template_part('templates/home-page/home', 'our-slider'); ?>
<!-- section our-slider end -->

<!-- section lift start -->
<?php get_template_part('templates/components/lift'); ?>
<!-- section lift end -->

<!-- section cta start -->
<?php get_template_part('templates/components/cta'); ?>
<!-- section cta end -->

<!-- section faq start -->
<?php get_template_part('templates/components/global-faq'); ?>
<!-- section faq end -->

<?php
get_footer();
?>