<?php

require __DIR__ . '/init.php';

// echo $converter->convert('# Hello World!');

$page = file_get_contents(__DIR__ . '/blog/test3.md');
$page = $converter->convert("{$page}")->getContent();

$author_pattern = '#<p class="author">(.+?)</p>#';
$date_pattern = '/<p class="creation-date">(.*?)<\/p>/s';

$patterns = [$author_pattern, $date_pattern];

preg_match($author_pattern, $page, $author);
preg_match($date_pattern, $page, $creation_date);

$clean_page = preg_replace($patterns, '', $page);
?>


<pre>
    <?php var_dump($author[1]); ?>
    <?php var_dump($creation_date[1]); ?>
    <?php var_dump($clean_page); ?>
</pre>

<?= $clean_page ?>


