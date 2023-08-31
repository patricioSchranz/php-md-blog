<?php

require __DIR__ . '/init.php';

$page = file_get_contents(__DIR__ . '/blog/test3.md');
$page = $converter->convert("{$page}")->getContent();

$author_pattern = '#<p class="author">(.+?)</p>#';
$date_pattern = '/<p class="creation-date">(.*?)<\/p>/s';
$image_pattern = '/<img class="image" (.*?)>/s';
$category_pattern = '/<p class="category">(.*?)<\/p>/s';
$sub_category_pattern = '/<p class="sub-category">(.*?)<\/p>/s';
$hashtags_pattern = '/<ul class="hashtags">(.*?)<\/ul>/s' ;

$patterns = [$author_pattern, $date_pattern, $image_pattern, $hashtags_pattern, $category_pattern, $sub_category_pattern];

preg_match($author_pattern, $page, $author);
preg_match($date_pattern, $page, $creation_date);
preg_match($image_pattern, $page, $image);
preg_match($hashtags_pattern, $page, $hashtags);

$clean_page = preg_replace($patterns, '', $page);
?>


<pre>
    <?php var_dump($hashtags[0]); ?>
    <?php var_dump($image[0]); ?>
    <?php var_dump($author[1]); ?>
    <?php var_dump($creation_date[1]); ?>
</pre>

<?= $clean_page ?>


