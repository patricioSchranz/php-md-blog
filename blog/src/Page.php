<?php


class Page {

    public $md_content;
    public $html_content;
    public $snippet;
    public $content;
    public $name;
    public $converter;
    public $post_title;
    public $id;
    
    protected $patterns = [
        'author' => '#<p class="author">(.+?)</p>#',
        'creation_date' => '/<p class="creation-date">(.*?)<\/p>/s',
        'image' => '/<img class="image" (.*?)>/s',
        'category' => '/<p class="category">(.*?)<\/p>/s',
        'sub_category' => '/<p class="sub-category">(.*?)<\/p>/s',
        'hashtags' => '/<ul class="hashtags">(.*?)<\/ul>/s',
        'first_paragraph' => '/<p class="first-paragraph">(.*?)<\/p>/s',
        'title' =>' /<p class="title">(.*?)<\/p>/s'
    ];

    protected $content_patterns = [
        'author' => '#<p class="author">(.+?)</p>#',
        'creation_date' => '/<p class="creation-date">(.*?)<\/p>/s',
        'image' => '/<img class="image" (.*?)>/s',
        'category' => '/<p class="category">(.*?)<\/p>/s',
        'sub_category' => '/<p class="sub-category">(.*?)<\/p>/s',
        'hashtags' => '/<ul class="hashtags">(.*?)<\/ul>/s',
        'title' =>' /<p class="title">(.*?)<\/p>/s'
    ];

    function __construct($md_content, $md_name, $converter, $id){
        $this->md_content = $md_content;
        $this->name = $md_name;
        $this->converter = $converter;
        $this->id = $id;
    }

    public function get_html_content($md, $converter){
        $this->html_content = $converter->convert($md)->getContent();
    }

    public function get_snippet(){

        $this->get_html_content($this->md_content, $this->converter);

        foreach($this->patterns as $pattern_name => $pattern){

            preg_match($pattern, $this->html_content, $extracted);

            if($pattern_name === 'hashtags'){
                // => go deeper => the li element and his content is what we needed (not the ul)
                $hashtag_content_pattern = '/<li>(.*?)<\/li>/s';

                preg_match_all($hashtag_content_pattern, $extracted[1], $clean_hashtags);

                $this->snippet['hashtags'] = $clean_hashtags;
            } 
            else if($pattern_name === 'first_paragraph'){

                $word_array = explode(' ', $extracted[1]);
                $split_length = 20;

                if(sizeof($word_array) > $split_length){
                    $sliced_word_array = array_slice($word_array, 0, $split_length);
                    $the_excerpt = implode(' ', $sliced_word_array) . '...';

                    $extracted[1] = $the_excerpt;

                    $this->snippet['excerpt'] = $extracted;
                }
           
            }
            else if($pattern_name === 'title'){
                $this->post_title = $extracted[1];
                $this->snippet[$pattern_name] = $extracted;
            }
            else{
                $this->snippet[$pattern_name] = $extracted;
            }
        }

        $this->snippet['id'] = $this->id;

        return $this->snippet;
    }

    public function get_content(){
        $this->content = preg_replace($this->content_patterns, '', $this->html_content);
    }
    
}