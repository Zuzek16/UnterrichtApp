<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Usuwanie...</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
<a class="skip-link" href="#firstEl">Przejdź do głównej treści</a>
<?php
     include "conn.php";
     include_once "func.php";
     addheader();

     if (isset($_GET['id'])) {
          $sqlN = "DELETE FROM nauczyciel WHERE `nauczyciel`.`id` = ".$_GET['id'];

          $sqlP = "DELETE FROM nauczany_przedmiot WHERE nauczany_przedmiot.id_nauczyciela =".$_GET['id'];

          $sqlSz = "DELETE FROM nauczyciele_szkoly WHERE `nauczyciele_szkoly`.`id_nauczyciela` = ".$_GET['id'];
          try {
               if (@mysqli_query($conn, $sqlP) && @mysqli_query($conn, $sqlSz)) {
               
                    if (@mysqli_query($conn, $sqlN)) {
                         echo "<p class='infZwrotna'>Pomyślnie usunięto nauczyciela.</p>";
                    } else {
                        echo "<p class='infZwrotna'>Nie udało się usunąć nauczyciela.</p>";
                    }
                    } else {
                         echo "<p class='infZwrotna'>Nie udało się usunąć nauczyciela. Błąd:".mysqli_error($conn)."</p>";
                    }
           } catch (Exception $e) {
               echo "<p class='infZwrotna'>Nie udało się usunąć nauczyciela.</p>", "\n";
           }
     }
?>
     <a href="nau.php" id="firstEl">Powrót</a>
     <?php
     addFooter();
     ?>
</body>
</html>