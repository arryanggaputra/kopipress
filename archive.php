<?php get_header();?>
<div class="w-full ">
    <div class="container mx-auto">
        <header class="entry-header text-center pt-20 pb-20 px-10">
            <?php

if (is_author()) {
    the_archive_title('<h1 class="entry-title page-title flex flex-col">', '</h1>');
} else {
    the_archive_title('<h1 class="entry-title page-title">', '</h1>');
}
the_archive_description('<div class="taxonomy-description ">', '</div>');

?>

        </header>
    </div>
</div>
<div class="container mx-auto flex md:flex-row flex-col">
    <div class="w-full md:w-8/12 md:pr-5 px-5 md:px-0">
        <?php get_template_part('includes/section', 'archive');?>
        <?php
global $wp_query;

$big = 999999999; // need an unlikely integer

$paginateLink = paginate_links(array(
    'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format'  => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total'   => $wp_query->max_num_pages,
));
?>
        <?php if ($paginateLink !== null): ?>
        <div class="mb-10 bg-gray-300 p-5 rounded-md text-center">
            <?php echo $paginateLink ?>
        </div>
        <?php endif;?>

    </div>
    <div class="w-full md:w-4/12 sidebar">
        <?php get_sidebar();?>
    </div>
</div>

<?php get_footer();?>