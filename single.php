<?php
get_header();
?>

<?php while (have_posts()): the_post();?>
<div class="w-full">
    <div class="container mx-auto">
        <header class="entry-header pt-20 pb-20 px-5 md:px-10">
            <?php the_title(sprintf('<h1 class="entry-title text-center" itemprop="headline"><a href="%s" class="no-underline" rel="bookmark">', esc_url(get_permalink())), '</a></h1>');?>
            <div class="flex flex-row justify-center pt-5 text-center">
                <?php do_action('generate_after_entry_title');?>
            </div>
        </header>
    </div>
</div>
<div class="container mx-auto flex md:flex-row flex-col">

    <div class="w-full md:w-8/12 pr-0 md:pr-5">
        <article id="post-<?php the_ID();?>" <?php post_class('px-6 pb-6 sm:px-5 md:px-0');?>
            <?php generate_do_microdata('article');?>>
            <?php do_action('kopidev_breadcrumbs');?>
            <?php the_content();?>
        </article><!-- #post -->

        <div class="px-5 md:px-0">
            <?php //do_action('kopidev_related_posts');?>
            <?php comments_template();?>
        </div>
    </div>
    <div class="w-full md:w-4/12 sidebar">
        <?php get_sidebar();?>
    </div>
</div>
<?php endwhile;?>

<?php
get_footer();
?>