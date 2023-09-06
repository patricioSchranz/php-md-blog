<?php

function convert_to_html($page){
    
}

function get_all_markdowns($path){
    $path_content = scandir($path);
    $mds = [];

    foreach($path_content as $content){
        if(preg_match('/.md/', $content)){
            $mds[] = $content;
        }
    }

    return $mds;
}

function get_all_metadatas($path, $md_converter, $patterns){
    $mds = get_all_markdowns($path);

    var_dump($path);

    $metadatas = [];

    foreach($mds as $md){
        // => get the content of md as string
        $page = file_get_contents(__DIR__ . "{$path}/{$md}");

        // => convert to html
        $page = $md_converter->convert("{$page}")->getContent();

        // => get the metadatas
        foreach($patterns as $pattern_name => $pattern){

            preg_match($pattern, $page, $metadata);
            $metadatas[$md][$pattern_name] = $metadata;
        }
        
    }

    return $metadatas;
}

function get_clean_page($page, $patterns){
    return $clean_page = preg_replace($patterns, '', $page);
}

