<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = "";
if ($_SERVER['SERVER_NAME'] == 'localhost')
{
    $url = "http://localhost/blog2/";
}
else if (strpos($_SERVER['SERVER_NAME'], '192.168.') !== false)
{
    $url = 'http://' . $_SERVER['SERVER_NAME'] . 'blog2/';
}
else {
    $url = "https://tommarx.fr/";
}

header( "refresh:3;url=" . $url );

$is_error = false;

function send_mail()
{
    $to = 'tom@tommarx.fr';
    $from = 'tom@tommarx.fr';
    $object = 'Message envoyé depuis le site';
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $message = "Message : " . htmlspecialchars($_POST['message']) . "<br />";
    $message .= "\nNom : <b>$name</b>" . "<br />";
    $message .= "\nMail : <b>$mail</b>" . "<br />";

    $headers  = "From: $from"."\r\n";
    $headers .= "Reply-To: $mail"."\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    return mail($to, $object, $message, $headers);
}

if (!isset($_POST["name"]) || !isset($_POST["mail"]) || !isset($_POST["message"]) || !isset($_POST["g-recaptcha-response"])) {
    $is_error = true;
}

if (!$is_error) {
    $captcha = $_POST['g-recaptcha-response'];
    $url_c = 'https://www.google.com/recaptcha/api/siteverify?secret=6LdIF7gUAAAAAF2NqW8DXSDgSUZuCroCpI_kTzb8&response=' . $captcha;
    $response = json_decode(file_get_contents($url_c), true)['success'];
    if (!$response) {
        $is_error = true;
    }
}

if (!$is_error) {
    ini_set('SMTP', 'SSL0.OVH.NET');
    ini_set("sendmail_from", "tom@tommarx.fr");
    $is_error = !send_mail();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta name="googlebot" content="noindex">
        <meta charset="utf-8">
        <title>Envoi de mail</title>
    </head>
    <body>

        <?php if ($is_error) { ?>
            <h2>Le mail n'a pas pu être envoyé, vous allez être redirigé...</h2>
        <?php } else { ?>
            <h2>Le mail a été envoyé ! Vous allez être redirigé...</h2>
        <?php } ?>

    </body>
</html>
