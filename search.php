<?php get_header();?>
<div class="w-full ">
    <div class="container mx-auto">
        <header class="entry-header text-center pt-20 pb-20 px-10">
            <h2 class="entry-title  page-title">

                <?php
printf( // WPCS: XSS ok.
    /* translators: 1: Search query name */
    __('Search Results for: %s', 'generatepress'),
    '<span>' . get_search_query() . '</span>'
);
?>

                </h3>
        </header>
    </div>
</div>
<div class="container mx-auto flex md:flex-row flex-col">
    <div class="w-full md:w-8/12 md:pr-5 px-5 md:px-0">
        <?php get_template_part('includes/section', 'archive');?>

        <?php if (have_posts()): ?>

        <div class="mb-10 bg-gray-300 p-5 rounded-md text-center">
            <?php
global $wp_query;

$big = 999999999; // need an unlikely integer

echo paginate_links(array(
    'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format'  => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total'   => $wp_query->max_num_pages,
));
?>
        </div>
        <?php endif;?>

    </div>
    <div class="w-full md:w-4/12 sidebar">
        <?php get_sidebar();?>
    </div>
</div>

<?php get_footer();?>