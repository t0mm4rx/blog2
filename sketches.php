<?php
$sketches = [];
$raw = file_get_contents("https://t0mm4rx.github.io/sketches/");
$parse1 = explode("<li>", $raw);
for ($i=1; $i < sizeof($parse1); $i++) {
    $parse2 = explode("</li>", $parse1[$i])[0];

    $url_post = explode('href="', $parse2)[1];
    $url_post = explode('"', $url_post)[0];

    $title = explode(">", $parse2)[1];
    $title = explode("<", $title)[0];

    $sketches[] = [
        "url" => $url_post,
        "title" => $title
    ];
}
?>

<section class="section-intro-dark">
    <h1>Sketches</h1>
    <p>Cette page regroupe mes expériences créatives. Ce sont des animations, faites en Javascript, avec la librairie p5.
    Pour plus d'informations techniques, ou pour accéder au code source : <a href="https://github.com/t0mm4rx/sketches" target="_blank" class="button">Repo Github</a></p>
</section>

<section id="section-list">

    <?php foreach ($sketches as $sketch) { ?>
    <div class="card">
        <h3><?php echo $sketch['title']; ?></h3>
        <p></p>
        <div class="links">
            <a href="#" class="button" onclick="open_modal('<?php echo $sketch['url']; ?>')">Voir<i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
    <?php } ?>
</section>

<div id="modal">
    <button class="button-icon" onclick="close_modal()"><i class="fas fa-times"></i></button>
    <button class="button-icon" onclick="refresh_modal()"><i class="fas fa-redo"></i></button>
    <iframe src="" frameborder="0"></iframe>
</div>
