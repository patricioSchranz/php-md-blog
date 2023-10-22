<?php

// => get the domain
$current_url = explode("?", $_SERVER['REQUEST_URI']);
$current_domain = str_replace('index.php', '', $current_url);

// var_dump($_SERVER);
// var_dump($_SERVER['REQUEST_URI']);
// var_dump($current_url);
// var_dump($current_domain);

// => open the blog
header("Location: {$current_domain[0]}blog.php");