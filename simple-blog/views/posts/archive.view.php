<?php

require __DIR__ . '/../layout/header.view.php'

?>

<!-- HEADER -->
<header>
    <h1>A SIMPLE BLOG</h1>
</header>

<!-- MAIN / ARCHIVE -->
<main>
    <?php foreach($pages as $page) : ?>

        <!-- ARCHIVE CARD -->
         <article class="archive-card">
            <header>
                <p class="page-card_title"><?php echo $page->name ?></p>
            </header>
         </article>

    <?php endforeach; ?>
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