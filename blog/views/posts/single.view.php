<?php

require __DIR__ . '/../layout/header.view.php';

$searched_post_title = $_GET["single"] ? $_GET["single"] : '' ;
$searched_post = '';

foreach($pages as $page){
    if($page->post_title === $searched_post_title){ 
        $searched_post = $page ; 
        $searched_post->get_content();
    }
}


if($searched_post === ''){
   header("Location: $current_path[0]");
   die('No post found');
}

?>

<header class="single-header">
  <?php echo $searched_post->snippet["image"][0] ?>

  <h1><?php echo $searched_post->post_title ?></h1>
</header>

<main>
    <?php echo $searched_post->content ?>
</main>

<?php require __DIR__ . '/../layout/footer.view.php'; ?>