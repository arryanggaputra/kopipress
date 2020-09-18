<?php

function load_assets()
{
    wp_register_style('main-style', get_template_directory_uri() . '/assets/style.css', [], THEME_VERSION);
    wp_enqueue_style('main-style');

    // wp_register_script('main-script', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);
    // wp_enqueue_script('main-script');
}
add_action('wp_enqueue_scripts', 'load_assets');

// Register Sidebars
function custom_sidebars()
{
    register_sidebar([
        'id'            => 'kopidev-blog-sidebar',
        'name'          => 'Kopidev Blog Sidebar',
        'description'   => 'Sidebar on Post detail',
        'before_widget' => '<aside id="%1$s" class="kopidev-widget %2$s">',
        'after_widget'  => '</aside>',
    ]);
}
add_action('widgets_init', 'custom_sidebars');

function deregister_plugin_assets()
{
    /**
     * Deregister LuckyWP Table of Contents CSS & JS
     * to improve performance
     */
    wp_deregister_style('lwptoc-main');
    wp_deregister_script('lwptoc-main');
    /**
     * Deregister wordpress block css
     */
    wp_deregister_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'deregister_plugin_assets', 100);

// Menu setting
add_theme_support('menus');
register_nav_menu('navbar-menu', 'Main Menu Navbar');

remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'rel_canonical');

function kopidev_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base'    => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'  => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total'   => $wp_query->max_num_pages,
    ));
}

if (!function_exists('kopidev_preconnect_url')) {
    function kopidev_preconnect_url()
    {
        $preconnectSources = [
            'https://googleads.g.doubleclick.net',
            'https://www.google-analytics.com',
            'https://ssl.google-analytics.com',
            'https://pagead2.googlesyndication.com',
            'https://tpc.googlesyndication.com',
            'https://stats.g.doubleclick.net',
            'https://www.gstatic.com',
            'https://www.googleadservices.com',
            'https://www.googletagmanager.com',
            'https://res.cloudinary.com',
            'https://connect.facebook.net',
        ];
        $script = '';
        foreach ($preconnectSources as $key => $value) {
            $script .= '<link rel="preconnect" href="' . $value . '" crossorigin><link rel="dns-prefetch" href="' . $value . '">';
        }
        echo $script;
    }
    add_action('wp_head', 'kopidev_preconnect_url');
}

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string Filtered title.
 */
function wpdocs_filter_wp_title($title, $sep)
{
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title = "$site_description $sep ";
    }

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title " . sprintf(__('Page %s', 'twentytwelve'), max($paged, $page)) . " $sep ";
    }

    // Add the site name.
    $title .= get_bloginfo('name');

    return $title;
}
add_filter('wp_title', 'wpdocs_filter_wp_title', 10, 2);