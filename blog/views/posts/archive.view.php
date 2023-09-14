<?php

require __DIR__ . '/../layout/header.view.php';

$offset = 1;
$limit = 2;
$page_count;

$pagination_number;
$pagination_limit = 4;

if (!isset ($_GET['page']) ) {  
    $page_count = 1;  
    $pagination_number = 1;
} 
else {  
    $page_count = (int) $_GET['page']; 
    $pagination_number = (int) $_GET['page' ];

    if($pagination_number >= (count($pages) / $limit) ){
        $pagination_number = (count($pages) / $limit);  
    }
   
}  


?>

<!-- HEADER -->
<header>
    <h1>A SIMPLE BLOG</h1>
</header>

<!-- MAIN / ARCHIVE -->
<main>
    <h2>Page <?= $page_count ?> </h2>
    
    <?php foreach($pages as $page) : ?>

        <!-- ARCHIVE CARD -->
         <article class="archive-card">
            <header>
                <p class="page-card_title"><?php echo $page->post_title ?></p>
            </header>
         </article>

    <?php endforeach; ?>

    <!-- PAGINATION --> 
    <div class="pagination-container">
        <a href="?page=<?php echo $page_count - 1 ; ?>">Previous</a>

        <?php 

            $loop_count = 1;
         
            for($i = 1; $i < count($pages); $i+= $limit){

                if($loop_count <= $pagination_limit){
                    echo "<a href='?page=$pagination_number'>$pagination_number</a>";
                    $loop_count++;

                    if($pagination_number < (count($pages) / $limit)){
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

        <a href="?page=<?php echo $page_count + 1; ?>">Next</a>
    </div>
</main>


<!-- SIDEBAR -->
<aside>
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