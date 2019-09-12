<?php
$post = $blog->get_post_by_link($article);
?>

<section id="intro">
    <h1><?php echo $post->get_title(); ?></h1>
    <p><?php echo $post->get_full_preview(); ?></p>
    <span><i class="fas fa-clock"></i> <b><?php echo $post->get_time_to_read(); ?></b> minutes</span>
</section>

<section id="article-body">
    <?php include_once("ressources/articles/" . $article . ".php"); ?>
</section>
