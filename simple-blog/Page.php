<?php

require __DIR__ . '/converter_init.php';

class Page {

    public $md_content;
    public $snippet;
    public $content;
    public $name;

    protected $patterns = [
        'author' => '#<p class="author">(.+?)</p>#',
        'creation_date' => '/<p class="creation-date">(.*?)<\/p>/s',
        'image' => '/<img class="image" (.*?)>/s',
        'category' => '/<p class="category">(.*?)<\/p>/s',
        'sub_category' => '/<p class="sub-category">(.*?)<\/p>/s',
        'hashtags' => '/<ul class="hashtags">(.*?)<\/ul>/s' 
    ];

    function __construct($md_content, $md_name)
    {
        $this->md_content = $md_content;
        $this->name = $md_name;
    }
}