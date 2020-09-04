<?php
get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
<?php if ($paged === 1): ?>
<div class="w-full mb-0  ">
    <div class="container mx-auto">
        <header class="md:flex-row flex-col flex items-center entry-header py-10 md:py-10 px-10 md:px-0">
            <div class="w-full md:w-6/12 md:text-left">
                <h1 style="color:var(--link-color);">Tempat Terbaik Belajar Pemrograman</h1>
                <p>
                    Kopidev merupakan portal yang sangat tepat bagi kalian yang ingin menjadi seorang Programmer Jagoan.
                </p>
            </div>
            <div class="w-full md:w-6/12 text-center">
                <picture class="inline-block" style="height: 330px;">
                    <source
                        srcset="https://res.cloudinary.com/kopi-dev/image/upload/c_scale,h_330,w_280/v1599111629/open-peeps-vwo0fj.webp"
                        type="image/webp">
                    <source
                        srcset="https://res.cloudinary.com/kopi-dev/image/upload/c_scale,h_330,w_280/v1599111402/open-peeps_ykty40.png"
                        type="image/png">
                    <img src="https://res.cloudinary.com/kopi-dev/image/upload/c_scale,h_330,w_280/v1599111629/open-peeps-vwo0fj.webp"
                        alt="Kopidev Belajar Pemrograman" style="height: 330px; margin:0px !important;">
                </picture>
            </div>
        </header>

    </div>
</div>
<?php endif;?>
<div class="container mx-auto grid md:grid-cols-3 grid-cols-1 gap-6 pt-10  md:px-0">
    <?php get_template_part('includes/section', 'archive', ['display' => 'small'])?>
</div>

<div class="mb-10 p-5 rounded-md text-center">
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

<?php get_footer();?>