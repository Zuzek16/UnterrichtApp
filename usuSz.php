<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Usuwanie...</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
<?php include_once "func.php";
     include_once "conn.php";
     include_once "getAll.php";
     addheader();

     if (!isset($_GET['usuSz'])) {
          echo "<p>Nie udało się znaleść żądanej szkoły,<a href='szkola.php'> wybierz ponownie</a></p>";
     } else {
          $idSzkoly = $_GET['usuSz'];
          ?>
<div class="main">
<form action='#' method='post'>
<p>Czy na pewno chcesz usunąć dane powiązane ze szkołą "<?php
     foreach ($klasaSzkoly as $nazwa => $value) {
          if ($value['idSzkoly'] == $_GET['usuSz']) {
               echo $nazwa;
          }
     }
 ?>"?</p>
<p>Tej czynności nie da się cofnąć!</p>
<label for='potwierdzenie'>Wiem co robię</label>
<input type='checkbox' name='potwierdzenie' id='potwierdzenie'>
<button type='submit'>Potwierdzam</button>
</form> 
</div>
<?php
     }
     if (isset($_POST['potwierdzenie']) && trim($_POST['potwierdzenie']) != "") {//check if it goes through when the checkbox is empty
          global $idSzkoly;
          $nazwaSzkoly = "";
          foreach ($klasaSzkoly as $key => $value) {
               if ($idSzkoly == $value['idSzkoly']) {
                   $nazwaSzkoly = $key;
               }
          }
          
          $sqlDelNauSz = "DELETE FROM nauczyciele_szkoly WHERE nauczyciele_szkoly.id_szkoly =".$idSzkoly;
          $sqlDelKl = "DELETE FROM klasa WHERE `klasa`.`id_szkola` =".$idSzkoly;
          $sqlDelSz = "DELETE FROM szkola WHERE `szkola`.`id` =".$idSzkoly;

          if (mysqli_query($conn, $sqlDelNauSz)) {
               if (mysqli_query($conn, $sqlDelKl)) {
                    if (mysqli_query($conn, $sqlDelSz)) {
                         echo "<p>Usunięto szkołę $nazwaSzkoly.</p>";
                    } else {
                         echo "<p>Wystąpił błąd.</p>";
                    }
               } else {
                    echo "<p>Wystąpił błąd.</p>";
               }
          } else {
               echo "<p>Wystąpił błąd.</p>";
          }

     }
?>
     <a href="szkola.php?edit=false">Powrót</a>
<?php addFooter();?>
</body>
</html>
