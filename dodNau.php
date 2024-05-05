<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie nauczyciela</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<?php
include_once ("func.php");
addheader();
//wraz z nauczyanym przedmiotem
//mysqli_real_escape_string
//!!HERE NOW  $_POST['tresc'] = mysqli_real_escape_string($conn, $_POST['tresc']);
        // $_POST['autor'] = mysqli_real_escape_string($conn, $_POST['autor']);

        // $sql = "INSERT INTO `comment` (`id`, `content`, `user_id`) VALUES ('', '".htmlentities($_POST['tresc'])."', '".htmlentities($_POST['autor'])."');";
?>

</body>
</html>