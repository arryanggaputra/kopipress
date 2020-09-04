<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?php bloginfo('charset');?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <title><?php wp_title('-', true, 'right');?></title>
    <?php wp_head();?>
</head>

<body <?php body_class();?> <?php generate_do_microdata('body');?>>
    <?php do_action('wp_body_open');?>
    <nav class="bg-gradient py-2">
        <div class="container mx-auto">
            <div class="flex flex-col sm:flex-row items-center px-5 md:px-0">
                <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                    <h1 class="font-bold text-3xl text-white">
                        <?php echo get_bloginfo('name'); ?>
                    </h1>
                </a>
                <?php
wp_nav_menu([
    'theme_location' => 'navbar-menu',
    'menu_id'        => 'navbar-menu',

]);
?>
            </div>

        </div>
    </nav>

    <div class="prose max-w-none">