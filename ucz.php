<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Nauczyciele i klasy</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <?php
     include_once "func.php";
     include_once "conn.php";
     addheader();
     ?>
     

     <?php
     if (!isset($_GET['szuk'])) {
          $_GET['szuk'] = "nauczyciele";
     }

     if ($_GET['szuk'] == "klasy") {
          renderKlasy();
     } else if ($_GET['szuk'] == "nauczyciele") {
          renderNau();
     }
     ?>
</body>
</html>