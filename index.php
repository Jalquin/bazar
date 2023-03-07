<?php
require("connect.php");

$pages = $_GET["pages"] ?? "main";
$splitpage = (explode('?', $pages));
$pagename = $splitpage[0];
?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Studentský projekt - Bazarooooš" name="description">
    <title>Bazarooooš - <?= $pagename;?></title>
    <link href="css/style.css" rel="stylesheet">
    <link href="images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="images/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
    <link href="images/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">

    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="body">
<?php


include_once("includes/header.php");
?>
<?php
if (file_exists("templates/" . $splitpage[0] . ".php"))
    include_once("templates/" . $splitpage[0] . ".php");
else
    include_once("templates/404.php");
?>
<?php
include_once("includes/footer.php");


?>
</body>
</html>
