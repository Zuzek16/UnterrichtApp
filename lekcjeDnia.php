<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <!-- <a href="gotoweLekcje.php">Wybierz z poprzednich lekcji</a> -->
     <?php
include "conn.php";
?>
     <form action="" method="post">
          <label for="przedmiot">Przedmiot</label>
          <select name="przedmiot" id="przedmiot">
          <?php
          include('getAll.php');
          foreach($przedmiot as $el){echo "<option value='".$el['nazwa']."'>".$el['nazwa']."</option>";}
          //!!TU NIE DZIALA ! spr getAll.php
          ?>
          </select>


          <button type="submit">Zatwierdź</button>
     </form>

     <?php
     // can we have it have an 'ghost' so it doesnt appear out of nowhere?
     if (isset($_POST['przedmiot'])) {
          echo "<p>Wybrany przedmiot - ".$_POST['przedmiot']."</p>";
          ?>
               <!-- action można na .php ustawić -->
          <form action="" method="post">
               <label for="nauczyciel">Nauczyciel: </label>
               <select name="nauczyciel" id="nauczyciel">
                    <?php
                         foreach (nauczycieleKtorzyUcza($_POST['przedmiot']) as $nau) {
                         echo "<option value='$nau'>".$nau."</option>";
                         }
                    ?>
               </select>

               <label for="sala">Sala</label>
          <input type="text" name="sala" id="sala" size="5">

          <button type="submit">Zapisz lekcję</button>
          </form>
          <?php
}
//walidacja i unieszkodliwienie sala 
//maybe dodanie pustej opcji typu "wybierz" w select i dodać sprawdzanie czy opcja nie jest ""
if (isset($_POST['sala']) && trim($_POST['sala']) != "" && isset($_POST['nauczyciel']) && trim($_POST['nauczyciel']) != "") {
     
     $dodLekcje = "";
if (mysqli_query($con, $dodLekcje)) {
     # code...
}

     unset($_POST['sala']);
     unset($_POST['nauczyciel']);
}

     ?>
</body>
</html>