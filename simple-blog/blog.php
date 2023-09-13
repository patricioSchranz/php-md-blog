<?php

require __DIR__ . '/blog_functions.php';
require __DIR__ . '/converter_init.php';
require __DIR__ . '/Page.php';

$pages_path = __DIR__  . '/../blog';
$pages = get_all_pages($pages_path, $md_converter);
$snippets = [];


// $snippet = $pages[0]->get_snippet();
// print_r($snippet);

// print_r($pages);

foreach($pages as $page){
    $snippet = $page->get_snippet();

    $snippets[] = $snippet;
}

require __DIR__ . '/views/posts/archive.view.php';



