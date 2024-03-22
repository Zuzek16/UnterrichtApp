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

          <!-- <label for="">Nauczyciel</label> -->

          <label for="sala">Sala</label>
          <select name="sala" id="sala"></select>
     

          <button type="submit">Zatwierdź</button>
     </form>

     <?php
     // can we have it have an 'ghost' so it doesnt appear out of nowhere?
     if (isset($_POST['przedmiot'])) {
          ?>
               <!-- action można na .php ustawić -->
          <form action="" method="post">
               <label for="nauczyciel">Nauczyciel: </label>
               <select name="nauczyciel" id="nauczyciel">
                    <?php
                         foreach (nauczycieleKtorzyUcza($_POST['przedmiot']) as $nau) {
                         echo "<option value='$nau'>".$nau."</option>";
                         }
                         /////////////////////////////////////
                         // $sql = "SELECT przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko FROM nauczany_przedmiot INNER JOIN nauczyciel ON nauczany_przedmiot.id_nauczyciela = nauczyciel.id INNER JOIN przedmiot ON nauczany_przedmiot.id_przedmiotu = przedmiot.id WHERE przedmiot.nazwa ='".$_POST['przedmiot']."'";
                         // $result = mysqli_query($conn, $sql);
                         // $tabNau = [];
                         // while ($row = mysqli_fetch_assoc($result)) {
                         // array_push($tabNau, $row['imie']." ".$row['nazwisko']);
                         // echo "<option>".$row['imie']." ".$row['nazwisko']."</option>";
                         // }
                    ?>
               </select>
          </form>
          <?php
     echo"###";
     echo $_POST['przedmiot'];
     echo"###";

}
echo "!!!!!";
     // var_dump(nauczycieleKtorzyUcza("fizyka"));
     //*to dziolo
     $sql = "SELECT przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko FROM nauczany_przedmiot INNER JOIN nauczyciel ON nauczany_przedmiot.id_nauczyciela = nauczyciel.id INNER JOIN przedmiot ON nauczany_przedmiot.id_przedmiotu = przedmiot.id WHERE przedmiot.nazwa ='".$_POST['przedmiot']."';";
     $result = mysqli_query($conn, $sql);
     $tabN = [];
     while ($row = mysqli_fetch_assoc($result)) {
          echo $row['imie']." ".$row['nazwisko'];
          }

     ?>

     <script>

     </script>
</body>
</html>