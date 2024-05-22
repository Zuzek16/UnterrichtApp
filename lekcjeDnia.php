<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <!-- TOBEROMOVED -->
     <!-- <a href="gotoweLekcje.php">Wybierz z poprzednich lekcji</a> -->
     <header>
     <?php include "conn.php";?>

     <nav>
          <ul>
               <li><a href="index.php">Strona główna</a></li>
          </ul>
     </nav>

     </header>
     <form action="" method="get">
          <label for="przedmiot">Przedmiot</label>
          <select name="przedmiot" id="przedmiot">
          <?php
          include('getAll.php');
          foreach($przedmiot as $el){echo "<option value='".$el['nazwa']."'>".$el['nazwa']."</option>";}
          ?>
          </select>
          <button type="submit">Zatwierdź</button>
     </form>

     <?php
     if (isset($_GET['przedmiot'])) {
          echo "<p>Wybrany przedmiot - ".$_GET['przedmiot']."</p>";
          ?>
          <form action="" method="post">
               <label for="nauczyciel">Nauczyciel: </label>
               <select name="nauczyciel" id="nauczyciel">
                    <?php
                         foreach (nauczycieleKtorzyUcza($_GET['przedmiot']) as $nau) {
                         echo "<option value='$nau'>".$nau."</option>";
                         }
                    ?>
               </select>
               <label for="sala">Sala</label>
               <select name="sala" id="sala">
               <?php
                         foreach ($sala as $elSala) {
                         echo "<option value='".$elSala['numer']."'>".$elSala['numer']."</option>";
                         }
                    ?>
               </select>
          <button type="submit">Zapisz lekcję</button>
          </form>
          <?php
}
if (isset($_POST['sala']) && trim($_POST['sala']) != "" && isset($_POST['nauczyciel']) && trim($_POST['nauczyciel']) != "") {
     $_POST['nauczyciel'] = mysqli_real_escape_string($conn, $_POST['nauczyciel']);
          $imieNau = explode(" ", $_POST['nauczyciel'])[0];
          $nazwiskoNau = explode(" ", $_POST['nauczyciel'])[1];
          $sqlSala = "SELECT id from sala WHERE numer =".$_POST['sala'];
          $sqlNau = "SELECT id from nauczyciel WHERE imie = '".$imieNau."'AND nazwisko = '$nazwiskoNau';";
          $sqlPrzedmi = "SELECT id from przedmiot WHERE nazwa = '".$_GET['przedmiot']."'";
          $rSala = mysqli_query($conn, $sqlSala);
          $rNau = mysqli_query($conn, $sqlNau);
          $rPrzedmi = mysqli_query($conn, $sqlPrzedmi);
          $idSala = mysqli_fetch_assoc($rSala);;
          $idNauczyciela  = mysqli_fetch_assoc($rNau);;
          $idPrzedmiotu = mysqli_fetch_assoc($rPrzedmi);

          echo "<h1>".$idSala['id']."</h1>";
          echo "<h1>".$idNauczyciela['id']."</h1>";
          echo "<h1>".$idPrzedmiotu['id']."</h1>";
          $dodLekcje = "INSERT INTO `lekcja` (`id`, `id_sali`, `id_nauczyciela`, `id_przedmiotu`) VALUES (NULL, '".$idSala['id']."', '".$idNauczyciela['id']."', '".$idPrzedmiotu['id']."');";

          if (mysqli_query($conn, $dodLekcje)) {
               header("Location: index.php?sus=true");//działą
          } else {
               echo "<h2>Błąd dodawania lekcji, proszę spróbować ponownie</h2>";
          }
}
     ?>
     <div class='prawy'>
          <form action="" method="post">
               <label for="gotowaLekcja">Wybierz z istniejących lekcji:</label>
               <select name="gotowaLekcja" id="gotowaLekcja">
                    <?php
                    $sql = "SELECT DISTINCT sala.numer, nauczyciel.imie, nauczyciel.nazwisko, przedmiot.nazwa FROM lekcja INNER JOIN nauczyciel ON lekcja.id_nauczyciela = nauczyciel.id INNER JOIN sala ON lekcja.id_sali = sala.id INNER JOIN przedmiot ON lekcja.id_przedmiotu = przedmiot.id;";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                         echo "<option value=".$row['imie'].">".$row['numer']."-".$row['imie']." ".$row['nazwisko']."-".$row['nazwa']."</option>";
                    }
                    ?>
               </select>
               <button type="submit">Zapisz</button>
          </form>
          <?php
          if (isset($_POST['gotowaLekcja'])) {
               echo "<p></p>";
          }
          ?>
     </div>
</body>
</html>