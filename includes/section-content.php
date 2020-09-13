<?php while (have_posts()): the_post();?>
<article id="post-<?php the_ID();?>" <?php post_class('px-6 pb-6 sm:px-5 md:px-0');?>
    <?php generate_do_microdata('article');?>>
    <?php if (!is_front_page()): ?>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title();?></h1>
    </header>
    <?php endif;?>
    <?php do_action('kopidev_breadcrumbs');?>
    <?php the_content();?>
</article><!-- #post -->
<?php endwhile;?>