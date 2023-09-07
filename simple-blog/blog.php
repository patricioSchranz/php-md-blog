<?php

require __DIR__ . '/blog_functions.php';
require __DIR__ . '/converter_init.php';
require __DIR__ . '/Page.php';

$pages_path = __DIR__  . '/../blog';
$pages = get_all_pages($pages_path, $md_converter);


// $snippet = $pages[0]->get_snippet();
// print_r($snippet);

foreach($pages as $page){
    $snippet = $page->get_snippet();

    print_r($snippet);
}



