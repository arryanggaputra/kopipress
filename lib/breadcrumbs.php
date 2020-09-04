<?php

function kopidev_breadcrumbs()
{
    if (function_exists('bcn_display') && is_single()) {
        echo '<div class="breadcrumbs px-4 py-2 mb-5 text-sm rounded-md"><div typeof="BreadcrumbList" vocab="https://schema.org/">';
        bcn_display();
        echo '</div></div>';
    }
}