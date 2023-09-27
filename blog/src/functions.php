<?php

// ***************************
// COMMON FUNCTIONS
//

function dump($value, $title = '---'){
    echo "<h1>$title</h1>";
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}


// ***************************
// POST FUNCTIONS
//

function get_all_pages($path, $md_converter){
    $files = scandir($path);
    $mds = [];
    $pages = [];
    $id = 0;

    foreach($files as $file){
        if(preg_match('/.md/', $file)){
            $mds[] = $file;
        }
    }

    foreach($mds as $md){
        $id++;
        $md_content = file_get_contents("{$path}/{$md}");
        $md_name = str_replace('.md', '', $md);

        $pages[] = new Page($md_content, $md_name, $md_converter, $id);
    }

    return $pages;
}


function get_all_snippets($pages){
    $snippets = [];

    foreach($pages as $page){
        $snippet = $page->get_snippet();
    
        $snippets[] = $snippet;
    }

    return $snippets;
}


function get_blog_metas($snippets){
    $categories = [];
    $sub_categories = [];
    $hashtags = [];
    $authors = [];
    $creation_dates = [];

    foreach($snippets as $snippet){

        $category = $snippet['category'][1];
        $sub_category = $snippet['sub_category'][1];
        $author = $snippet['author'][1];
        $creation_date = $snippet['creation_date'][1];
    
        if(!in_array($category, $categories) ) { $categories[] = $category; }
        if(!in_array($sub_category, $sub_categories) ) { $sub_categories[] = $sub_category; }
        if(!in_array($author, $authors) ) { $authors[] = $author; }
        if(!in_array($creation_date, $creation_dates) ) { $creation_dates[] = $creation_date; }
    
        $all_hashtags = $snippet['hashtags'][1];

        foreach($all_hashtags as $hashtag){
            if(!in_array($hashtag, $hashtags)){ $hashtags[] = $hashtag ; }
        }
    }

    sort($categories);
    sort($sub_categories);
    sort($authors);
    sort($creation_dates);

    $cleaned_hashtags = [];

    foreach($hashtags as $hashtag){ 
        $clean_hashtag = trim(str_replace('#', ' ', $hashtag)); 
        $cleaned_hashtags[] = $clean_hashtag;
    }

    sort($cleaned_hashtags);

    return [
        'categories' => $categories,
        'sub_categories' => $sub_categories,
        'hashtags' => $cleaned_hashtags,
        'authors' => $authors,
        'creation_dates' => $creation_dates
    ];
}


