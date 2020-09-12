<?php

function insertLinkPrefetch()
{
    echo '<script>function prefetch(e){if("A"==e.target.tagName&&e.target.origin==location.origin){var t=document.createElement("link");t.rel="prefetch",t.href=e.target.href,document.head.appendChild(t)}}window.onload=function(){document.documentElement.addEventListener("mouseover",prefetch,{capture:!0,passive:!0}),document.documentElement.addEventListener("touchstart",prefetch,{capture:!0,passive:!0})};</script>';
}
add_action('wp_footer', 'insertLinkPrefetch');