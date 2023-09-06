<?php

$patterns = [
    'author' => '#<p class="author">(.+?)</p>#',
    'creation_date' => '/<p class="creation-date">(.*?)<\/p>/s',
    'image' => '/<img class="image" (.*?)>/s',
    'category' => '/<p class="category">(.*?)<\/p>/s',
    'sub_category' => '/<p class="sub-category">(.*?)<\/p>/s',
    'hashtags' => '/<ul class="hashtags">(.*?)<\/ul>/s' 
];