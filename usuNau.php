<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Usuwanie...</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
<?php
     include "conn.php";
     include_once "func.php";
     addheader();

     if (isset($_GET['id'])) {
          $sqlN = "DELETE FROM nauczyciel WHERE `nauczyciel`.`id` = ".$_GET['id'];

          $sqlP = "DELETE FROM nauczany_przedmiot WHERE nauczany_przedmiot.id_nauczyciela =".$_GET['id'];

          $sqlSz = "DELETE FROM nauczyciele_szkoly WHERE `nauczyciele_szkoly`.`id_nauczyciela` = ".$_GET['id'];
          if (mysqli_query($conn, $sqlP) && mysqli_query($conn, $sqlSz)) {
               
          if (mysqli_query($conn, $sqlN)) {
               echo "<p class='infZwrotna'>Pomyślnie usunięto nauczyciela.</p>";
          } else {
              echo "<p class='infZwrotna'>Nie udało się usunąć nauczyciela.</p>";
          }
          } else {
               echo "<p class='infZwrotna'>Nie udało się usunąć nauczyciela. Błąd:".mysqli_error($conn)."</p>";
          }

     }
?>
     <a href="nau.php">Powrót</a>
     <?php
     addFooter();
     ?>
</body>
</html>
