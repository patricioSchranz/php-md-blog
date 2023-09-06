<?php

require __DIR__ . '/converter_init.php';
require __DIR__ . '/blog_regex_patterns.php';
require __DIR__ . '/blog_functions.php';

$metadatas = get_all_metadatas('./../blog', $md_converter, $patterns);
$clean_page = get_clean_page('./../blog/test.md', $patterns);

var_dump($metadatas);
echo $clean_page;


