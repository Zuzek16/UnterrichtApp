<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edycja klasy</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <?php
     include_once "func.php";
     include_once "conn.php";
     include_once "getAll.php";
     addheader();?>
<h2 class="pageFunc center">Usuwanie klasy</h2>
<div class="dodKlase">
<?php
     if (!isset($_GET['id'])) {
          echo "<p>Nie udało się pobrać informacji. Proszę spróbować jescze raz</p>
          <a href='klasy.php'>Powrót</a>
          ";
     } else {
          $nazwaKlasy = "nr. ".$_GET['id'];
          global $planLekcjiKlasy;
          foreach ($planLekcjiKlasy as $key => $value) {
               if ($value['id'] == $_GET['id']) {
                    $nazwaKlasy = $value['nazwa'];
               }
          }

          $sql = "DELETE FROM `klasa` WHERE `klasa`.`id` =".$_GET['id'];
          if (mysqli_query($conn, $sql)) {
               echo "<p class='infZwrotna'>Pomyślnie usunięto klasę</p>";
            echo"<a href='klasy.php'>Powrót</a>";
          } else {
               echo "<p class='infZwrotna'>Nie udało się usunąć klasy</p>";
               echo"<a href='klasy.php'>Powrót</a>"; 
          }
     }
     ?>
</div>
<?php addFooter();?>
</body>
</html>