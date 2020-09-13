<?php

/**
 * Prefetch document when mouse hover in anchor tags
 * https://web.dev/link-prefetch/
 */
if (!function_exists('kopidev_link_prefetch')) {
    function kopidev_link_prefetch()
    {
        echo '<script>function prefetch(e){if("A"==e.target.tagName&&e.target.origin==location.origin){var t=document.createElement("link");t.rel="prefetch",t.href=e.target.href,document.head.appendChild(t)}}window.onload=function(){document.documentElement.addEventListener("mouseover",prefetch,{capture:!0,passive:!0}),document.documentElement.addEventListener("touchstart",prefetch,{capture:!0,passive:!0})};</script>';
    }
    add_action('wp_footer', 'kopidev_link_prefetch');
}

if (!function_exists('kopidev_navbar_menu')) {
    function kopidev_navbar_menu()
    {
        echo '<script>function kopidev_show_menu(){var e=document.querySelector(".menu-primary-container");"none"!==e.style.display&&e.style.display?e.style.display="none":e.style.display="block"}</script>';
    }
    add_action('wp_footer', 'kopidev_navbar_menu');
}

/**
 * Show breadcrumbs from NavXT
 * https://wordpress.org/plugins/breadcrumb-navxt/
 */
if (!function_exists('kopidev_breadcrumbs')) {
    function kopidev_breadcrumbs()
    {
        if (function_exists('bcn_display') && is_single()) {
            echo '<div class="breadcrumbs px-4 py-2 mb-5 text-sm rounded-md"><div typeof="BreadcrumbList" vocab="https://schema.org/">';
            bcn_display();
            echo '</div></div>';
        }
    }
    add_action('kopidev_breadcrumbs', 'kopidev_breadcrumbs');
}

if (!function_exists('kopidev_related_posts')) {
    function kopidev_related_posts()
    {
        global $post;
        $orig_post  = $post;
        $categories = get_the_category($post->ID);
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $individual_category) {
                $category_ids[] = $individual_category->term_id;
            }

            $args = array(
                'category__in'        => $category_ids,
                'post__not_in'        => array($post->ID),
                'posts_per_page'      => 3, // Number of related posts that will be shown.
                'ignore_sticky_posts' => 1,
            );

            $my_query = new wp_query($args);
            if ($my_query->have_posts()) {
                echo '<div id="related_posts"><h3>Related Posts</h3>';
                while ($my_query->have_posts()) {
                    $my_query->the_post();
                    echo '<h1>' . the_title() . '</h1>';
                }
                echo '</div>';
            }
        }
        $post = $orig_post;
        wp_reset_query();
    }
    add_action('kopidev_related_posts', 'kopidev_related_posts');
}