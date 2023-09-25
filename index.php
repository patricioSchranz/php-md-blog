<?php

$current_url = explode("?", $_SERVER['REQUEST_URI']);

header("Location: {$current_url[0]}blog.php");