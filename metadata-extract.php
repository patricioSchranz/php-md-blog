<?php

require __DIR__ . '/init.php';

// => get the content of md as string
$page = file_get_contents(__DIR__ . '/blog/test3.md');

// => convert to html string
$page = $converter->convert("{$page}")->getContent();


// => patterns to find the metadatas
$patterns = [
    'author' => '#<p class="author">(.+?)</p>#',
    'creation_date' => '/<p class="creation-date">(.*?)<\/p>/s',
    'image' => '/<img class="image" (.*?)>/s',
    'category' => '/<p class="category">(.*?)<\/p>/s',
    'sub_category' => '/<p class="sub-category">(.*?)<\/p>/s',
    'hashtags' => '/<ul class="hashtags">(.*?)<\/ul>/s' 
];

$metadatas = [];

// => get the metadatas
foreach($patterns as $pattern_name => $pattern){
    preg_match($pattern, $page, $result_array);
    $metadatas[$pattern_name] = $result_array;
}

// => delete the metadatas from the html string
$clean_page = preg_replace($patterns, '', $page);
?>


<pre>
    <!-- <?php var_dump($metadatas); ?> -->
    <?php var_dump($metadatas['hashtags'][0]); ?>
    <?php var_dump($metadatas['image'][0]) ; ?>
    <?php var_dump($metadatas['author'][1]); ?>
    <?php var_dump($metadatas['creation_date'][1]); ?>
    <?php var_dump($metadatas['category'][1]); ?>
    <?php var_dump($metadatas['sub_category'][1]); ?>
</pre>

<?= $clean_page ?>


