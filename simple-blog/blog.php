<?php

require __DIR__ . '/blog_functions.php';
require __DIR__ . '/converter_init.php';
require __DIR__ . '/Page.php';

$pages_path = __DIR__  . '/../blog';
$pages = get_all_pages($pages_path, $md_converter);
$snippets = [];
$categories = [];
$sub_categories = [];


foreach($pages as $page){
    $snippet = $page->get_snippet();

    $snippets[] = $snippet;
}

foreach($snippets as $snippet){

    $category = $snippet['category'][1];
    $sub_category = $snippet['sub_category'][1];

    if(!in_array($category, $categories) ) { $categories[] = $category; }
    if(!in_array($sub_category, $sub_categories) ) { $sub_categories[] = $sub_category; }
}


require __DIR__ . '/views/posts/archive.view.php';



