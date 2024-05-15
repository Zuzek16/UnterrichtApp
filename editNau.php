<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edycja danych nauczyciela</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <?php
     include_once "func.php";
     include_once "conn.php";
     include_once "getAll.php";
     addheader();?>
<h2 class="pageFunc">Edytowanie danych nauczyciela</h2>
<div class="dodKlase">
<?php
     if (!isset($_GET['id'])) {
          echo "<p>Nie udało się pobrać informacji. Proszę spróbować jescze raz</p>
          <a href='nau.php'>Powrót</a>
          ";
     } else {
          $imie = "";
          $nazwisko = "";
          // var_dump($nauczyciele);
          foreach ($nauczyciele as $key => $value) {
               if ($value['id'] == $_GET['id']) {
                    $imie = $value['imie'];
                    $nazwisko = $value['nazwisko'];
               }
          }

          echo "<form method='POST' action='#'>";
          echo "<label for='imie'>Imię: </label>";
          echo "<input type='text' value='$imie'>";

          echo "<label for='nazwisko'>Nazwisko: </label>";
          echo "<input type='text' value='$nazwisko'>";
          echo "<p>Nauczane przedmioty</p>";
          echo '<div class="checkboxes">';
          $nauPrzed = [];
          foreach ($nauczany_przedmiot as $key => $value) {//spr jakie przedmioty uczą / move to a fn
               foreach ($value as $key2 => $value2) {
                    if ($imie." ".$nazwisko == $value2[1] && $_GET['id'] == $value2[0]) {
                         array_push($nauPrzed, $key);
                    //    echo "<p>$key</p>";
                   }
               }
          }

          global $przedmiot;
          foreach ($przedmiot as $el) {
               $printed = false;
               foreach ($nauPrzed as $key => $value) {
                    if ($el['nazwa'] == $value) {
                         echo "<input type='checkbox' name='".$el['id']."' id='".$el['id']."' value='".$el['id']."' checked>";
              echo "<label for='".$el['id']."'>".$el['nazwa']."</label><br>";
              $printed = true;
                    }
               }
               if ($printed == false) {
                    echo "<input type='checkbox' name='".$el['id']."' id='".$el['id']."' value='".$el['id']."'>";
              echo "<label for='".$el['id']."'>".$el['nazwa']."</label><br>";
               }
              
          }



          echo "</div>";
          //  echo "<input type='checkbox' checked>";

          echo "<label for='szkola'>Szkoła w której uczy:</label>";
          echo "<select name='szkola' id='szkola'>";

          $aktSzkola = "";
          foreach ($nauSzkoly as $row => $value) {
               if ($_GET['id'] == $value['id_nauczyciela']) {
                   if (trim($value['nazwa']) != "") {
                    $aktSzkola = $value['nazwa'];
                   }
               }
          }

          foreach ($klasaSzkoly as $key => $value) {
               if ($key == $aktSzkola) {
                    echo "<option value='".$key."' selected >".$key."</option>";          
               } else {
                    echo "<option value='".$key."' >".$key."</option>";          
               }
          }
          echo "</select>";
          echo "<button type='submit'>Zapisz</button></form>";
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