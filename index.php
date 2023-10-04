<?php

// => get url without query string and "index.php"
$current_url = explode("?", $_SERVER['REQUEST_URI']);
$current_url = str_replace('index.php', '', $current_url);

// => open the blog
header("Location: {$current_url[0]}blog.php");