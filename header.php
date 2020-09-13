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
            <div class="flex flex-col md:flex-row items-center px-5 md:px-0">
                <div class="flex flex-row items-center justify-between w-full md:w-auto">
                    <div onclick="kopidev_show_menu()" class="cursor-pointer pl-5 pr-5 md:hidden">
                        <svg viewBox='0 0 10 8' width='30'>
                            <path d='M1 1h8M1 4h 8M1 7h8' stroke='#fff' stroke-width='2' stroke-linecap='round' />
                        </svg>
                    </div>
                    <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                        <h1 class="font-bold text-3xl text-white">
                            <?php echo get_bloginfo('name'); ?>
                        </h1>
                    </a>
                    <div class="cursor-pointer pl-5 pr-5 md:hidden">
                        <!-- <svg height="30" width="30">
                            <circle cx="14" cy="14" r="11" stroke="#fff" stroke-width="5" fill="transparent" />
                        </svg> -->
                    </div>
                </div>
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