<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Usuwanie...</title>
     <link rel="stylesheet" href="styl.css">
<a class="skip-link" href="#firstEl">Przejdź do głównej treści</a>
</head>
<body>
<?php
     include "conn.php";
     include_once "func.php";
     addheader();

     if (!isset($_GET['id'])) {
          echo "<p>Nie udało się pobrać informacji. Proszę spróbować jescze raz</p>
          ";
     } else {
          $sqlLPlanu = "DELETE FROM `lekcje_planu` WHERE lekcje_planu.id_planu_lekcji =".$_GET['id'];

               if (!mysqli_query($conn, $sqlLPlanu)) {
                    echo "<p>Nie udało się usunąć danych planu lekcji.</p>";
               } else {
                    $sqlSz = "DELETE FROM plan_lekcji WHERE `plan_lekcji`.`id` = ".$_GET['id'];
                    if (!mysqli_query($conn, $sqlSz)) {
                         echo "<p>Nie udało się usunąć planu lekcji.</p>";
                    } else {
                         echo "<p>Pomyślnie usunięto plan lekcji.</p>";
               }
          }
     }
?>
     <a id="firstEl" href="choosePlan.php">Powrót</a>
<?php addFooter();?>
</body>
</html>
