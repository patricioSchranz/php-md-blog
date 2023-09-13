<?php

require __DIR__ . '/../layout/header.view.php'

?>

<!-- HEADER -->
<header>
    <h1>A SIMPLE BLOG</h1>

    <!-- CATEGORIES -->
    <figure>
        <figcaption>Categories</figcaption>
        <ul>
            <?php foreach($categories as $category){ ?>
                <li>
                    <a href="?post=<?php echo urlencode($category) ?>"><?= $category ?></a>
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
                    <a href="?post=<?php echo urlencode($sub_category) ?>"><?= $sub_category ?></a>
                </li>
            <?php } ?>
        </ul>
    </figure>
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



<?php require __DIR__ . '/../layout/footer.view.php'; ?>