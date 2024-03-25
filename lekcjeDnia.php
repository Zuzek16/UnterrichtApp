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
           $postPrzed = $_POST['przedmiot'];
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
               <select name="sala" id="sala">
               <?php
                         foreach ($sala as $elSala) {
                         echo "<option value='".$elSala['numer']."'>".$elSala['numer']."</option>";
                         //TODO: - actually addingg the lesson
                         }
                    ?>
               </select>

          <button type="submit">Zapisz lekcję</button>
          </form>
          <?php
}
//maybe dodanie pustej opcji typu "wybierz" w select i dodać sprawdzanie czy opcja nie jest ""
if (isset($_POST['sala']) && trim($_POST['sala']) != "" && isset($_POST['nauczyciel']) && trim($_POST['nauczyciel']) != "") {
     global $postPrzed;
     // $_POST['sala'] = mysqli_real_escape_string($conn, $_POST['sala']);
     $_POST['nauczyciel'] = mysqli_real_escape_string($conn, $_POST['nauczyciel']);

     // $dodSale = "INSERT INTO `sala` (`id`, `numer`) VALUES (NULL, '".htmlentities($_POST['sala'])."')";
     // if (mysqli_query($conn, $dodSale)) {
          //could redo this to have the id already in select so i won't have to do this whole thing
          $sqlSala = "";
          $sqlNau = "";
          $sqlPrzedmi = "SELECT id from przedmiot WHERE nazwa = '".$postPrzed."'";
          // $rSala = mysqli_query($conn, $sqlSala);
          // $rNau = mysqli_query($conn, $sqlNau);
          $rPrzedmi = mysqli_query($conn, $sqlPrzedmi);
          $idSala;
          $idNauczyciela;
          $idPrzedmiotu = mysqli_fetch_assoc($rPrzedmi);

          echo "<h1>".$idPrzedmiotu."</h1>";
//!!!
          // $dodLekcje = "INSERT INTO `lekcja` (`id`, `id_sali`, `id_nauczyciela`, `id_przedmiotu`) VALUES (NULL, '$idSala', '$idNauczyciela', '$idPrzedmiotu');";

          // if (mysqli_query($conn, $dodLekcje)) {
          //      echo "<p>Dodawanie lekcji...</p>";
          //      unset($_POST['sala']);
          //      unset($_POST['nauczyciel']);
          // }    
          
     // } else {
     //      echo "<p>Błąd dodawanie sali!</p>";
     // }
     
}

     ?>
</body>
</html>