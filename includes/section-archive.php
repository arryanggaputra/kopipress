<?php
$array_defaults = ['display' => 'normal'];
$args           = wp_parse_args($args, $array_defaults);
$isNormal       = $args['display'] === 'normal';
?>

<?php if (have_posts()): while (have_posts()): the_post();?>

<article id="post-<?php the_ID();?>"
    <?php post_class(($isNormal ? ' mb-10 pb-10 inline-block' : ' entry-small px-10 md:px-0 '))?>
    <?php generate_do_microdata('article');?>>

    <header class="article-header">
        <?php the_title(sprintf('<h1 class="entry-title" itemprop="headline"><a href="%s" class="no-underline" rel="bookmark">', esc_url(get_permalink())), '</a></h1>');?>
        <div class="flex flex-row pt-5 text-sm">
            <?php do_action('generate_after_entry_title');?>
        </div>
    </header> <!-- end article header -->

    <section class="entry-content" itemprop="text">
        <?php if ($isNormal) {
            do_action('generate_after_entry_header');
        }?>
        <?php the_excerpt();?>
    </section> <!-- end article section -->

    <footer class="article-footer">
        <p class="tags text-sm">

            <?php
        do_action('show_first_post_category');
        // the_tags('<span class="tags-title">' . __('Tags:', 'jointstheme') . '</span> ', ', ', '');
        ?>
        </p>
    </footer> <!-- end article footer -->

</article> <!-- end article -->

<?php endwhile;else:endif;?>