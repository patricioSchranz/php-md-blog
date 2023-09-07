<?php

require __DIR__ . '/blog_functions.php';
require __DIR__ . '/Page.php';

$pages_path = __DIR__  . '/../blog';
$pages = get_all_pages($pages_path);

var_dump($pages);

// require __DIR__ . '/converter_init.php';
// require __DIR__ . '/blog_regex_patterns.php';
// require __DIR__ . '/blog_functions.php';

// $metadatas = get_all_metadatas('./../blog', $md_converter, $patterns);
// $clean_page = get_clean_page('./../blog/test.md', $patterns);

// var_dump($metadatas);
// echo $clean_page;


