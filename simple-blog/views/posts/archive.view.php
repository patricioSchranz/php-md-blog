<?php

require __DIR__ . '/../layout/header.view.php'

?>

<header>
    <h1>A SIMPLE BLOG</h1>

    <?php echo count($snippets) ?>
    <pre>
        <!-- <?php var_dump($pages) ?> -->
    </pre>
    

    <ul>
       <?php 
            // foreach($snippets as $snippet){
            //     foreach($snippet as $snippet_entry){
            //        foreach($snippet_entry as $entry_value){
            //             echo $entry_value;
            //        }
            //     }
            // }

         foreach($pages as $page){
            // var_dump($page->snippet);
         }
       
       ?>
    </ul>
</header>

<main>
    <?php foreach($pages as $page) : ?>
         <article class="page-card">
            <header>
                <p class="page-card_title"><?php echo $page->name ?></p>
            </header>
         </article>
    <?php endforeach; ?>
</main>



<?php require __DIR__ . '/../layout/footer.view.php'; ?>