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
     <!-- <form action="" method="post"></form> -->
<?php
     if (!isset($_GET['id'])) {
          echo "<p>Nie udało się pobrać informacji. Proszę spróbować jescze raz</p>
          <a href='nau.php'>Powrót</a>
          ";
     } else {
          $imie = "";
          $nazwisko = "";
          foreach ($nauczyciele as $key => $value) {
               if ($value['id'] == $_GET['id']) {
                    $imie = $value['imie'];
                    $nazwisko = $value['nazwisko'];
               }
          }

          echo "<form action='#' method='post'>";
          echo "<label for='imie'>Imię: </label>";
          echo "<input type='text' value='$imie' name='imie' id='imie'>";
          echo "<label for='nazwisko'>Nazwisko: </label>";
          echo "<input type='text' value='$nazwisko' name='nazwisko' id='nazwisko'>";
          echo "<p>Nauczane przedmioty</p>";
          echo '<div class="checkboxes">';
          $nauPrzed = [];
          foreach ($nauczany_przedmiot as $key => $value) {//spr jakie przedmioty uczą / move to a fn
               foreach ($value as $key2 => $value2) {
                    if ($imie." ".$nazwisko == $value2[1] && $_GET['id'] == $value2[0]) {
                         array_push($nauPrzed, $key);
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
                    echo "<option value='".$value['idSzkoly']."' selected >".$key."</option>";          
               } else {
                    echo "<option value='".$value['idSzkoly']."' >".$key."</option>";          
               }
          }
          echo "</select>";
          echo "<button type='submit'>Zapisz</button></form>";
     }
     ?>
     <?php
     if (isset($_POST['imie']) && isset($_POST['nazwisko']) && trim($_POST['nazwisko']) != "" && isset($_POST['szkola'])) {

          if (maCyfre($_POST['imie']) || maCyfre($_POST['nazwisko'])) {
               echo "<p class='infZwrotna'>Imie oraz nazwisko nie może zawierać cyfr</p>";            
           } else {
           $setPrzed = [];
           foreach ($przedmiot as $el) {
                   if (isset($_POST[$el['id']])) {
                       array_push($setPrzed, $el['id']);
                   }
           }

           $imie = mysqli_real_escape_string($conn, trim($_POST['imie']));
           $nazwisko = mysqli_real_escape_string($conn, trim($_POST['nazwisko']));

          $sqlNau = "UPDATE `nauczyciel` SET `imie` = '".htmlentities($imie)."', `nazwisko` = '".htmlentities($nazwisko)."' WHERE `nauczyciel`.`id` =".$_GET['id'];

          $sqlNauPrzedDel = "DELETE FROM `nauczany_przedmiot` WHERE `nauczany_przedmiot`.`id_nauczyciela` =".$_GET['id'];

          $sqlNauPrzedSet = "";
          foreach ($setPrzed as $key => $value) {
               if ($sqlNauPrzedSet == "") {
                    $sqlNauPrzedSet = "INSERT INTO `nauczany_przedmiot` (`id`, `id_przedmiotu`, `id_nauczyciela`) VALUES (NULL, '$value', '".$_GET['id']."')";
               } else {
                    $sqlNauPrzedSet.=",(NULL, '$value', '".$_GET['id']."')";
               }
          }

          $sqlNauSz = "UPDATE `nauczyciele_szkoly` SET `id_szkoly` = '".$_POST['szkola']."' WHERE `nauczyciele_szkoly`.`id_nauczyciela` =".$_GET['id'];

          if (!mysqli_query($conn, $sqlNau)) {
               echo "<p class='infZwrotna'>Nie udało się zmenić danych nauczyciela</p>";
               echo"<a href='nau.php'>Powrót</a>"; 
          } else {
              if (!mysqli_query($conn, $sqlNauPrzedDel)) {
               echo "<p class='infZwrotna'>Nie udało się usunąć starych danych nauczyciela</p>";
               echo"<a href='nau.php'>Powrót</a>";
              } else {
               if (!mysqli_query($conn, $sqlNauPrzedSet)) {
                    echo "<p class='infZwrotna'>Nie udało się dodać nowych danych nauczyciela</p>";
               echo"<a href='nau.php'>Powrót</a>";
               } else {
                    if (!mysqli_query($conn, $sqlNauSz)) {
                         echo "<p class='infZwrotna'>Nie udało się zmenić danych o szkole w której uczy nauczyciel</p>";
               echo"<a href='nau.php'>Powrót</a>";
                    } else {
                         echo "<p class='infZwrotna'>Pomyślnie zmieniono dane nauczyciela</p>";
            echo"<a href='nau.php'>Powrót</a>";
                         ?>
                         <script>
                              //test this
                              location.replace("http://localhost/proKon/UnterrichtApp/nau.php");
                         </script>
                         <?php
                    }
               }
              }
          }
     }
}
     ?>
</div>
<?php addFooter();?>
</body>
</html>