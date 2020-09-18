<?php

if (!function_exists('generate_post_image')) {
    add_action('generate_after_entry_header', 'generate_post_image');
    /**
     * Prints the Post Image to post excerpts
     */
    function generate_post_image()
    {
        // If there's no featured image, return.
        if (!has_post_thumbnail()) {
            return;
        }

        // If we're not on any single post/page or the 404 template, we must be showing excerpts.
        if (!is_singular() && !is_404()) {
            echo apply_filters('generate_featured_image_output', sprintf( // WPCS: XSS ok.
                '<div class="post-image">
					%3$s
					<a href="%1$s">
						%2$s
					</a>
				</div>',
                esc_url(get_permalink()),
                get_the_post_thumbnail(
                    get_the_ID(),
                    apply_filters('generate_page_header_default_size', 'full'),
                    array(
                        'itemprop' => 'image',
                    )
                ),
                apply_filters('generate_inside_featured_image_output', '')
            ));
        }
    }
}
if (!function_exists('show_first_category')) {
    add_action('show_first_post_category', 'show_first_category');
    /**
     * Prints the Post Image to post excerpts
     */
    function show_first_category()
    {
        $categories = get_the_category();
        if (!empty($categories)) {
            $icon = '<svg  style="width:15px; margin-right:5px;" enable-background="new 0 0 512.001 512.001" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
            <path d="m405.23 0h-298.46c-17.522 0-31.735 14.212-31.735 31.735v471.4c0 7.256 8.263 11.423 14.098 7.106l171.28-139.64 162.45 139.65c5.835 4.317 14.098 0.15 14.098-7.106v-471.41c0-17.523-14.212-31.735-31.735-31.735z" fill="#DD352E"/>
            <g fill="#B02721">
                <path d="m145.66 61.793h-70.621v17.655h70.621c4.873 0 8.828-3.946 8.828-8.828s-3.955-8.827-8.828-8.827z"/>
                <path d="m163.31 114.76h-88.276v17.655h88.276c4.873 0 8.828-3.946 8.828-8.828s-3.955-8.827-8.828-8.827z"/>
                <path d="m180.97 167.72h-105.93v17.655h105.93c4.873 0 8.828-3.946 8.828-8.828s-3.955-8.827-8.828-8.827z"/>
                <path d="m260.41 370.6 8.828 7.592v-42.893c0-4.882-3.955-8.828-8.828-8.828s-8.828 3.946-8.828 8.828v42.505l8.828-7.204z"/>
            </g>
            </svg>';
            $url   = esc_url(get_category_link($categories[0]->term_id));
            $title = esc_html($categories[0]->name);
            echo "<div class='flex flex-row items-center text-sm'>$icon <a href='$url' title='$title'>$title</a> </div>";
        }
    }
}

add_filter('excerpt_length', function ($length) {
    return 30;
});

// Return an alternate title, without prefix, for every type used in the get_the_archive_title().
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        /*
         * Queue the first post, that way we know
         * what author we're dealing with (if that is the case).
         */
        the_post();
        $title = sprintf('<span class="avatar inline-block">%1$s</span><span class="vcard">%2$s</span>',
            get_avatar(get_the_author_meta('ID'), 100),
            get_the_author()
        );
        /*
         * Since we called the_post() above, we need to
         * rewind the loop back to the beginning that way
         * we can run the loop properly, in full.
         */
        rewind_posts();
    } elseif (is_year()) {
        $title = get_the_date(_x('Y', 'yearly archives date format'));
    } elseif (is_month()) {
        $title = get_the_date(_x('F Y', 'monthly archives date format'));
    } elseif (is_day()) {
        $title = get_the_date(_x('F j, Y', 'daily archives date format'));
    } elseif (is_tax('post_format')) {
        if (is_tax('post_format', 'post-format-aside')) {
            $title = _x('Asides', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-gallery')) {
            $title = _x('Galleries', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-image')) {
            $title = _x('Images', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-video')) {
            $title = _x('Videos', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-quote')) {
            $title = _x('Quotes', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-link')) {
            $title = _x('Links', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-status')) {
            $title = _x('Statuses', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-audio')) {
            $title = _x('Audio', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-chat')) {
            $title = _x('Chats', 'post format archive title');
        }
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    } else {
        $title = __('Archives');
    }
    return $title;
});

if (!function_exists('generate_excerpt_more')) {
    add_filter('excerpt_more', 'generate_excerpt_more');
    /**
     * Prints the read more HTML to post excerpts.
     *
     * @since 0.1
     *
     * @param string $more The string shown within the more link.
     * @return string The HTML for the more link.
     */
    function generate_excerpt_more($more)
    {
        return apply_filters('generate_excerpt_more_output', sprintf(' ... <a title="%1$s" class="read-more text-primary" href="%2$s">%3$s %4$s</a>',
            the_title_attribute('echo=0'),
            esc_url(get_permalink(get_the_ID())),
            __('Read more', 'generatepress'),
            '<span class="screen-reader-text">' . get_the_title() . '</span>'
        ));
    }
}

function generate_get_microdata($context)
{
    $data = false;

    if ('microdata' !== apply_filters('generate_schema_type', 'microdata')) {
        return false;
    }

    if ('body' === $context) {
        $type = 'WebPage';

        if (is_home() || is_archive() || is_attachment() || is_tax() || is_single()) {
            $type = 'Blog';
        }

        if (is_search()) {
            $type = 'SearchResultsPage';
        }

        $type = apply_filters('generate_body_itemtype', $type);

        $data = sprintf(
            'itemtype="https://schema.org/%s" itemscope',
            esc_html($type)
        );
    }

    if ('header' === $context) {
        $data = 'itemtype="https://schema.org/WPHeader" itemscope';
    }

    if ('navigation' === $context) {
        $data = 'itemtype="https://schema.org/SiteNavigationElement" itemscope';
    }

    if ('article' === $context) {
        $type = apply_filters('generate_article_itemtype', 'CreativeWork');

        $data = sprintf(
            'itemtype="https://schema.org/%s" itemscope',
            esc_html($type)
        );
    }

    if ('post-author' === $context) {
        $data = 'itemprop="author" itemtype="https://schema.org/Person" itemscope';
    }

    if ('comment-body' === $context) {
        $data = 'itemtype="https://schema.org/Comment" itemscope';
    }

    if ('comment-author' === $context) {
        $data = 'itemprop="author" itemtype="https://schema.org/Person" itemscope';
    }

    if ('sidebar' === $context) {
        $data = 'itemtype="https://schema.org/WPSideBar" itemscope';
    }

    if ('footer' === $context) {
        $data = 'itemtype="https://schema.org/WPFooter" itemscope';
    }

    if ($data) {
        return apply_filters("generate_{$context}_microdata", $data);
    }
}

/**
 * Output our microdata for an element.
 *
 * @since 2.2
 *
 * @param $context The element to target.
 * @return string The microdata.
 */
function generate_do_microdata($context)
{
    echo generate_get_microdata($context); // WPCS: XSS ok, sanitization ok.
}

if (!function_exists('generate_post_meta')) {
    add_action('generate_after_entry_title', 'generate_post_meta');
    /**
     * Build the post meta.
     *
     * @since 1.3.29
     */
    function generate_post_meta()
    {
        $post_types = apply_filters('generate_entry_meta_post_types', array(
            'post',
        ));

        if (in_array(get_post_type(), $post_types)): ?>
<div class="entry-meta">
    <?php generate_posted_on();?>
</div><!-- .entry-meta -->
<?php endif;
    }
}

if (!function_exists('generate_posted_on')) {
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     *
     * @since 0.1
     */
    function generate_posted_on()
    {
        $items = apply_filters('generate_header_entry_meta_items', array(
            'date',
            'author',
        ));

        foreach ($items as $item) {
            generate_do_post_meta_item($item);
        }
    }
}

/**
 * Output requested post meta.
 *
 * @since 2.3
 *
 * @param string $item The post meta item we're requesting
 * @return The requested HTML.
 */
function generate_do_post_meta_item($item)
{
    if ('date' === $item) {
        $date = apply_filters('generate_post_date', true);

        $time_string = '';

        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>' . $time_string;
        } else {
            $time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time>' . $time_string;
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        // If our date is enabled, show it.
        if ($date) {
            echo apply_filters('generate_post_date_output',
                sprintf( // WPCS: XSS ok, sanitization ok.
                    '<span class="posted-on">%1$s<a href="%2$s" title="%3$s" rel="bookmark">%4$s</a></span>&nbsp;',
                    apply_filters('generate_inside_post_meta_item_output', '', 'date'),
                    esc_url(get_permalink()),
                    esc_attr(get_the_time()),
                    $time_string
                ),
                $time_string);
        }
    }

    if ('author' === $item) {
        $author = apply_filters('generate_post_author', true);

        if ($author) {
            echo apply_filters('generate_post_author_output',
                sprintf('<span class="byline">%1$s<span class="author vcard" %5$s><a class="url fn n" href="%2$s" title="%3$s" rel="author" itemprop="url"><span class="author-name" itemprop="name">%4$s</span></a></span></span> ',
                    apply_filters('generate_inside_post_meta_item_output', '', 'author'),
                    esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                    /* translators: 1: Author name */

                    esc_attr(sprintf(__('View all posts by %s', 'generatepress'), get_the_author())),

                    esc_html(get_the_author()),
                    generate_get_microdata('post-author')
                )
            );
        }
    }

    if ('categories' === $item) {
        $categories = apply_filters('generate_show_categories', true);

        $term_separator  = apply_filters('generate_term_separator', _x(', ', 'Used between list items, there is a space after the comma.', 'generatepress'), 'categories');
        $categories_list = get_the_category_list($term_separator);

        if ($categories_list && $categories) {
            echo apply_filters('generate_category_list_output',
                sprintf('<span class="cat-links">%3$s<span class="screen-reader-text">%1$s </span>%2$s</span> ', // WPCS: XSS ok, sanitization ok.
                    esc_html_x('Categories', 'Used before category names.', 'generatepress'),
                    $categories_list,
                    apply_filters('generate_inside_post_meta_item_output', '', 'categories')
                )
            );
        }
    }

    if ('tags' === $item) {
        $tags = apply_filters('generate_show_tags', true);

        $term_separator = apply_filters('generate_term_separator', _x(', ', 'Used between list items, there is a space after the comma.', 'generatepress'), 'tags');
        $tags_list      = get_the_tag_list('', $term_separator);

        if ($tags_list && $tags) {
            echo apply_filters('generate_tag_list_output',
                sprintf('<span class="tags-links">%3$s<span class="screen-reader-text">%1$s </span>%2$s</span> ', // WPCS: XSS ok, sanitization ok.
                    esc_html_x('Tags', 'Used before tag names.', 'generatepress'),
                    $tags_list,
                    apply_filters('generate_inside_post_meta_item_output', '', 'tags')
                )
            );
        }
    }

    if ('comments-link' === $item) {
        $comments = apply_filters('generate_show_comments', true);

        if ($comments && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            echo apply_filters('generate_inside_post_meta_item_output', '', 'comments-link');
            comments_popup_link(__('Leave a comment', 'generatepress'), __('1 Comment', 'generatepress'), __('% Comments', 'generatepress'));
            echo '</span> ';
        }
    }

    /**
     * generate_post_meta_items hook.
     *
     * @since 2.4
     */
    do_action('generate_post_meta_items', $item);
}

add_filter('generate_inside_post_meta_item_output', 'generate_do_post_meta_prefix', 10, 2);
/**
 * Add svg icons or text to our post meta output.
 *
 * @since 2.4
 */
function generate_do_post_meta_prefix($output, $item)
{
    if ('author' === $item) {
        $output = __('by', 'generatepress') . ' ';
    }

    if ('categories' === $item) {
        // $output = generate_get_svg_icon( 'categories' );
    }

    if ('tags' === $item) {
        // $output = generate_get_svg_icon( 'tags' );
    }

    if ('comments-link' === $item) {
        // $output = generate_get_svg_icon( 'comments' );
    }

    return $output;
}