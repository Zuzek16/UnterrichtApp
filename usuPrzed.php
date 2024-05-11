<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Usuwanie...</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
<?php
     include "conn.php";
     if (isset($_GET['id'])) {
          $sql = "DELETE FROM przedmiot WHERE `przedmiot`.`id` = ".$_GET['id'];

          if (mysqli_query($conn, $sql)) {
               echo "<p class='infZwrotna'>Pomyślnie usunięto przedmiot.</p>";
          } else {
              echo "<p class='infZwrotna'>Nie udało się usunąć przedmiotu.</p>";
          }
     }
?>
     <a href="dodPrzed.php">Powrót do podglądu przedmiotów</a>
</body>
</html>
