<?php

require __DIR__ . '/../layout/header.view.php';

$offset = 1;
$limit = 2;
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
    $offset = $_GET['page' ] == 1 
        ? (int) $_GET['page'] -1 
        : (int) $_GET['page'];

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

$page_selection = array_slice($pages, $offset, $limit);


?>

<!-- HEADER -->
<header>
    <h1>A SIMPLE BLOG</h1>
</header>



<!-- MAIN / ARCHIVE -->
<section class="main" role="main">
    <h2>Page <?= $page_count ?> </h2>
    
    <?php foreach($page_selection as $page) : ?>

        <!-- ARCHIVE CARD -->
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


            <!-- EXCERPT -->
            <div class="page-card_preview">

            <?php if(isset($page->snippet['image'][0]) ) :?>
                <figure>
                    <?php echo $page->snippet['image'][0] ?>
                </figure>
            <?php endif ; ?>
                
                <p class="page-card_excerpt"><?php echo $page->snippet['excerpt'][1] ?></p> 
            </div>
         </article>

    <?php endforeach; ?>

    <!-- PAGINATION --> 
    <div class="pagination-container">

        <?php if ($page_count > 1) : ?>
            <a href="?page=<?php echo $page_count - 1 ; ?>">Previous</a>

            <?php else : ?>
            <a href="#">Previous</a>

        <?php endif; ?>
        

        <?php 

            $loop_count = 1;
         
            for($i = 1; $i < count($pages); $i+= $limit){

                if($loop_count <= $pagination_limit){

                    if($pagination_number == $last_page){
                        echo "<a href='?page=$pagination_number' class='last-pagination-elem'>$pagination_number</a>";
                    }
                    else{
                        echo "<a href='?page=$pagination_number'>$pagination_number</a>";
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
    <!-- CATEGORIES -->
    <figure>
        <figcaption>Categories</figcaption>
        <ul>
            <?php foreach($categories as $category){ ?>
                <li>
                    <a href="?archive=<?php echo urlencode($category) ?>"><?= $category ?></a>
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
                    <a href="?archive=<?php echo urlencode($sub_category) ?>"><?= $sub_category ?></a>
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
                    <a href="?archive=<?php echo urlencode($author) ?>"><?= $author ?></a>
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
                    <a href="?archive=<?php echo urlencode($creation_date) ?>"><?= $creation_date ?></a>
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
                    <a href="?archive=<?php echo urlencode($hashtag) ?>"><?= $hashtag ?></a>
                </li>
            <?php } ?>
        </ul>
    </figure>
</aside>



<?php require __DIR__ . '/../layout/footer.view.php'; ?>