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
<h2 class="pageFunc">Edytowanie nauczyciela</h2>
<div class="dodKlase">
<?php
     if (!isset($_GET['id'])) {
          echo "<p>Nie udało się pobrać informacji. Proszę spróbować jescze raz</p>
          <a href='klasy.php'>Powrót</a>
          ";
     } else {
          $nazwaKlasy = "nr. ".$_GET['id'];

          global $planLekcjiKlasy;
          foreach ($nauczyciele as $key => $value) {
               if ($value['id'] == $_GET['id']) {
                    $nazwaKlasy = $value['nazwa'];
               }
          }
          echo "<form method='POST' action='#'>
          <label for='nowyPlan'>Wybierz nowy plan lekcji dla klasy ".$nazwaKlasy."</label>
          <select name='nowyPlan' id='nowyPlan'>";
          
          foreach ($planyLekcji as $key => $value) {
               echo "<option value='".$value['id']."'>".$value['id']."</option>";
          }
          
          echo "</select><button type='submit'>Zapisz</button></form>";
     }
     ?>
     <?php
     if (isset($_POST['nowyPlan'])) {
          $sql = "UPDATE `klasa` SET `id_planu_lekcji` = '".$_POST['nowyPlan']."' WHERE `klasa`.`id` =".$_GET['id'];
          if (mysqli_query($conn, $sql)) {
               echo "<p class='infZwrotna'>Pomyślnie zmieniono plan lekcji</p>";
            echo"<a href='klasy.php'>Powrót</a>";
          } else {
               echo "<p class='infZwrotna'>Nie udało się zmenić planu</p>";
               echo"<a href='klasy.php'>Powrót</a>"; 
          }
     }
     ?>
</div>
<?php addFooter();?>
</body>
</html>