<?php
$posts = $blog->get_last_posts();
?>
<section id="section-intro">
    <h1>Tom Marx - Blog</h1>
    <h3>Les derniers articles parus sur mon blog.</h3>
    <p>Je parle de programmation mise au service du créatif. Je présente aussi quelques sujets techniques. Vous y retrouverez des articles traitant du web, du python, d'IA ou encore de mes expérience de vie.</p>
</section>

<section id="posts-list">


    <?php foreach ($posts as $post) { ?>
    <div class="card">
        <span><?php echo $post->get_month_year()[0]; ?><span><?php echo $post->get_month_year()[1]; ?></span></span>
        <div class="tags"><?php foreach ($post->get_tags() as $tag) {
            echo '<span>' . $tag . '</span>';
        }?></div>
        <h3><?php echo $post->get_title(); ?></h3>
        <p>Réalisation d'un site web style "AirBnB" listant les locations pour une ville et les affichant sur une carte.</p>
        <div class="links">
            <a href="<?php echo $GLOBALS['url']; ?>blog/<?php echo $post->get_link(); ?>/" target="_blank" class="button">Lire<i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
<?php } ?>

</section>
