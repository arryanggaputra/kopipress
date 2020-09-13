<?php
$theme = wp_get_theme();
define('THEME_VERSION', $theme->Version);

$theme_dir = get_template_directory();

require $theme_dir . '/lib/comments.php';
require $theme_dir . '/lib/general.php';
require $theme_dir . '/lib/miscellaneous.php';
require $theme_dir . '/lib/markup.php';