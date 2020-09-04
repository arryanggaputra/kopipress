<?php
get_header();

// var_dump(!is_front_page());
?>


<div <?php post_class('container mx-auto' . (is_front_page() ? '' : ' pt-10'))?>>
    <?php get_template_part('includes/section', 'content');?>
</div>
<?php
get_footer();
?>