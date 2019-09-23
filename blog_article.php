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
    <div id="disqus_thread"></div>
    <script>
    var disqus_config = function () {
    this.page.url = '<?php echo $post->get_url(); ?>';
    this.page.identifier = '<?php echo $post->get_link(); ?>';
    };
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://tom-marx.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</section>
