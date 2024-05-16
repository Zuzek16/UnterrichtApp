<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edycja przedmiotu</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
<?php
     include "conn.php";
     include_once "func.php";
     addheader();
     if (isset($_GET['id']) && isset($_GET['nazwa'])) {
          ?>
          <form action="#" method="post">
               <div class="dodKlase">
                    <label for="nazwa">Nazwa: </label>
                    <input type="text" name="nazwa" id="nazwa" value="<?php echo isset($_POST["nazwa"]) ? htmlentities($_POST["nazwa"]) : $_GET['nazwa']; ?>">
                    <button type="submit">Zapisz</button>               
               </form>
          </div>
          <?php
          if (isset($_POST['nazwa']) && trim($_POST['nazwa']) != "") {
               $sql = "UPDATE `przedmiot` SET `nazwa` = '".$_POST['nazwa']."' WHERE `przedmiot`.`id` = ".$_GET['id'];

          if (mysqli_query($conn, $sql)) {
               echo "<p class='infZwrotna'>Pomyślnie zmeniono przedmiot.</p><a href='dodPrzed.php'>Powrót</a>";
          } else {
              echo "<p class='infZwrotna'>Nie udało się zmienić przedmiotu.</p><a href='dodPrzed.php'>Powrót</a>";
          }
          } else {
               echo "<p class='infZwrotna'>Nazwa nie może być pusta.</p>";
          }
          
     } else {
          echo "<p>Nie udało się pobrać informacji. Proszę spróbować jescze raz</p>
          <a href='dodPrzed.php'>Powrót</a>
          ";
     }
?>
     <?php addFooter();?>
</body>
</html>
