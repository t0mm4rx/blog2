<?php

if ($_SERVER['SERVER_NAME'] == 'localhost')
{
    $GLOBALS["url"] = "http://localhost/blog2/";
}
else if (strpos($_SERVER['SERVER_NAME'], '192.168.') !== false)
{
    $GLOBALS["url"] = 'http://' . $_SERVER['SERVER_NAME'] . 'blog2/';
}
else {
    $GLOBALS["url"] = "https://tommarx.fr/";
}
if (!isset($_GET["page"]))
{
    header('Location: ' . $GLOBALS['url']);
    exit();
}

$page = $_GET['page'];
if ($page == "me")
{

}
elseif ($page == "cv") {

}
elseif ($page == "blog_home") {

}
elseif ($page == "sketches") {

}
elseif ($page == "contact") {

}
else {
    header('Location: ' . $GLOBALS['url']);
    exit();
}

$titles = [];
$titles["me"] = "Tom Marx, développeur freelance passionné";
$titles["blog_home"] = "Blog de Tom Marx, développeur freelance";
$titles["contact"] = "Contacter Tom Marx";
$titles["sketches"] = "Collection d'expériences graphiques numériques de Tom Marx";

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=PT+Mono&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha256-UzFD2WYH2U1dQpKDjjZK72VtPeWP50NoJjd26rnAdUI=" crossorigin="anonymous" />
        <link rel="stylesheet" href="<?php echo $GLOBALS["url"]; ?>css/style.css">
        <link rel="stylesheet" href="<?php echo $GLOBALS["url"]; ?>css/<?php echo $page; ?>.css">
        <title><?php echo $titles[$page]; ?></title>
    </head>
    <body>
        <button id="menu-button"><i class="fas fa-bars"></i></button>
        <?php include_once("nav.php"); ?>
        <canvas id="menu-animation"></canvas>
        <h2 id="main-title">Tom<br/>Marx<br/><span>><span id="blinking-thing">_</span></span></h2>
        <div id="content">

            <?php include_once($page . ".php"); ?>
        </div>
    </body>
    <script src="<?php echo $GLOBALS["url"]; ?>js/nav.js"></script>
    <script src="<?php echo $GLOBALS["url"]; ?>js/<?php echo $page; ?>.js"></script>
</html>
