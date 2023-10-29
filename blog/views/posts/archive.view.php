<?php

require __DIR__ . '/../layout/header.view.php';

$filtered_pages;
$filter;

$all_posts_count = count($pages);

if(isset($_GET['archive'])){
    $searched_meta = $_GET['archive'];
    $searched_term = $_GET['term'];

    $filtered_pages = array_filter($pages, function ($page) {
        global $searched_meta;
        global $searched_term;

        if($searched_meta === 'hashtags'){
           $page_hashtags = $page->snippet[$searched_meta][1];

        //    dump($page_hashtags);
        //    dump($searched_term);

           foreach($page_hashtags as $hashtag){
                $count = 0;

                $hashtag = trim(str_replace('#', '', $hashtag));

                // dump($hashtag);

                $hashtag === $searched_term 
                ? $count++
                : $count = $count;

                if( ($count === 1 ) && ( $hashtag === $searched_term )){ return $page ;}
           }

           return;
        }


        $category_term = $page->snippet[$searched_meta][1];

        if($category_term === $searched_term){  return $page; }
       
    });

    $pages = $filtered_pages;

    $filter_upper_chars = strtoupper($searched_meta);
    $filter_upper_chars = str_replace('_', ' ', $filter_upper_chars);
    $filter = "<span>Filter:</span> <span>{$filter_upper_chars}</span> / <span>{$searched_term}</span>";

}

$selected_posts_count = count($pages);


$offset = 0;
$limit = 4;
$page_count;

$pagination_number;
$pagination_limit = 3;

$last_page = ceil((count($pages) / $limit));

// print($last_page);


if (!isset ($_GET['page']) ) {  
    $page_count = 1;  
    $pagination_number = 1;
} 
else {  
    $page_count = (int) $_GET['page']; 
    $pagination_number = (int) $_GET['page' ];
    $offset = ((int) $_GET['page'] * $limit) - $limit;


    if($pagination_number > $last_page ){
        $pagination_number = 1;  
    }
   
}  

usort($pages, function($a, $b) {
    return strtotime($b->snippet['creation_date'][1]) - strtotime($a->snippet['creation_date'][1]);
});

// foreach($pages as $page){
//    dump($page->snippet['creation_date'][1]);
// }

// print($offset);
// print($limit);

$page_selection = array_slice($pages, $offset, $limit);


?>

<!-- HEADER -->
<header>
    <h1>
        A SIMPLE BLOG
    </h1>

    <p>
        <span>This blog has <?= $all_posts_count ?> posts </span>
        <span>/</span>
        <span>You have <?= $selected_posts_count ?> selected</span>
    </p>
   
</header>



<!-- MAIN / ARCHIVE -->
<section class="main" role="main">
    <h2>
        Page <?= $page_count ?>

        <?php if(isset($filter)) :?>
            <p><?= $filter ?></p>
        <?php endif; ?>
    </h2>

    <p>

        <?php if($page_count != $last_page) : ?>
            <strong>Post <?= $offset + 1 ?> - <?= ($offset +1)  + ($limit - 1) ?></strong>

            <?php else : ?>
                <?php 
                    $posts_per_page = count($pages) / (count($pages) / $limit);
                    $last_page_posts_count = $selected_posts_count - $posts_per_page * ($page_count - 1);
                ?>

                <strong>Post <?= $offset + 1 ?> - <?= $offset + $last_page_posts_count ?></strong>

        <?php endif; ?>
        
    </p>

    <?php foreach($page_selection as $page) : ?>

        <!-- ARCHIVE CARD -->
        <a href='<?php echo "{$current_path[0]}?single={$page->post_title}" ?>' class="card-link">
         <article class="archive-card">

           <!-- HEADER --> 
            <header>
                <h3 class="page-card_title"><?php echo $page->post_title ?></h3>
                <p class="page-card_meta">By : <?php echo $page->snippet['author'][1] ?></p>
                <p class="page-card_meta">Created : <?php echo $page->snippet['creation_date'][1] ?></p>
                <p class="page-card_meta">Category : <?php echo $page->snippet['category'][1] ?></p>
                <p class="page-card_meta">Sub category : <?php echo $page->snippet['sub_category'][1] ?></p>

                <figure class="page-card_meta hashtags">
                    <figcaption>Hashtags :</figcaption>
                    <ul >
                        <?php foreach($page->snippet['hashtags'][0] as $hashtag) {
                            echo $hashtag;
                        } 
                    ?>
                    </ul>
                </figure>
             
            </header>


            <!-- EXCERPT & IMAGE -->
            <div class="page-card_preview">

            <?php if(isset($page->snippet['image'][0]) ) :?>
                <figure>
                    <?php echo $page->snippet['image'][0] ?>
                </figure>
            <?php endif ; ?>
                
                <p class="page-card_excerpt"><?php echo $page->snippet['excerpt'][1] ?></p> 
            </div>
         </article>
        </a>

    <?php endforeach; ?>

    <!-- PAGINATION --> 
    <div class="pagination-container">

        <?php if ($page_count > 1) : ?>

            <?php if(count($_GET) < 2) : ?>
                <a href="?page=<?php echo $page_count - 1 ; ?>">Previous</a>

            <?php else :?> 
                <?php 
                    $params  = array_merge( $_GET, array( 'page' => $page_count - 1 ) ); 
                    $new_query_string = http_build_query( $params );
                ?>
                <a href="?<?= $new_query_string ?>">Previous</a>

            <?php endif; ?>
                
            <?php else : ?>
            <a href="#">Previous</a>

        <?php endif; ?>
        

        <?php 

            $loop_count = 1;

       
            for($i = 1; $i < count($pages); $i+= $limit){

                if($loop_count <= $pagination_limit){

                    if(count($_GET) < 2) {
                        $query_string = "page=$pagination_number"; 
                    }
                    else{
                        $params  = array_merge( $_GET, array( 'page' => $pagination_number ) ); 
                        $query_string = http_build_query( $params ); 
                    }

                   
                    if($pagination_number == $last_page){
                        echo "<a href='?$query_string' class='last-pagination-elem'>$pagination_number</a>";
                    }
                    else{
                        echo "<a href='?$query_string'>$pagination_number</a>";
                    }
                    
                    $loop_count++;

                    if($pagination_number < $last_page){
                        $pagination_number++;
                    }
                    else{
                        $pagination_number = 1; 
                    }
                    
                }
                else{
                    echo '...';
                    break;
                }
            
            }
        ?>

        <?php if ($page_count < (count($pages) / $limit) ) : ?>
            <a href="?page=<?php echo $page_count + 1; ?>">Next</a>

            <?php else : ?>
            <a href="#">Next</a>

        <?php endif; ?>
        
    </div>
</section>



<!-- SIDEBAR -->
<aside>
    <h3 class="hidden">Sidebar</h3>

    <a href="blog.php" class="all-posts">All Posts</a>

    <!-- CATEGORIES -->
    <figure>
        <figcaption>Categories</figcaption>
        <ul>
            <?php foreach($categories as $category){ ?>
                <li>
                    <a href="?archive=category&term=<?php echo urlencode($category) ?>"><?= $category ?></a>
                </li>
            <?php } ?>
        </ul>
    </figure>

    <!-- SUB CATEGORIES -->
    <figure>
        <figcaption>Sub Categories</figcaption>
        <ul>
            <?php foreach($sub_categories as $sub_category){ ?>
                <li>
                    <a href="?archive=sub_category&term=<?php echo urlencode($sub_category) ?>"><?= $sub_category ?></a>
                </li>
            <?php } ?>
        </ul>
    </figure>
    
    <!-- AUTHORS -->
    <figure>
        <figcaption>Authors</figcaption>
        <ul>
            <?php foreach($authors as $author){ ?>
                <li>
                    <a href="?archive=author&term=<?php echo urlencode($author) ?>"><?= $author ?></a>
                </li>
            <?php } ?>
        </ul>
    </figure>

    <!-- DATES -->
    <figure>
        <figcaption>Dates</figcaption>
        <ul>
            <?php foreach($creation_dates as $creation_date){ ?>
                <li>
                    <a href="?archive=creation_date&term=<?php echo urlencode($creation_date) ?>"><?= $creation_date ?></a>
                </li>
            <?php } ?>
        </ul>
    </figure>
    
    <!-- HASHTAGS -->
    <figure>
        <figcaption>Hashtags</figcaption>
        <ul>
            <?php foreach($hashtags as $hashtag){ ?>
                <li>
                    <a href="?archive=hashtags&term=<?php echo urlencode($hashtag) ?>"><?= $hashtag ?></a>
                </li>
            <?php } ?>
        </ul>
    </figure>
</aside>



<?php require __DIR__ . '/../layout/footer.view.php'; ?>