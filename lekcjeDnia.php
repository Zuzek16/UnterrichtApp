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
          include 'getAll.php';
          foreach($przedmiot as $el){echo "<option value='".$el['nazwa']."'>".$el['nazwa']."</option>";}
          //!!TU NIE DZIALA ! spr getAll.php
          ?>
          </select>

          <!-- <label for="">Nauczyciel</label> -->

          <label for="">Sala</label>
     

          <button type="submit">Zatwierdź</button>
     </form>

     <?php
     // can we have it have an 'ghost' so it doesnt appear out of nowhere?
     if (isset($_POST['przedmiot'])) {
          ?>
          <form action="" method="post">
               <label for="nauczyciel">Nauczyciel: </label>
               <select name="nauczyciel" id="nauczyciel">
                    <!-- <option value="">HALO </option> -->
                    <?php
                    // $nauczyciuele = nauczycieleKtorzyUcza($_POST['przedmiot']); 
                    echo "<option value=''>$nauczyciele</option>";
                   foreach( $nauczyciuele as $nau){
                         echo "<option value='$nau'>$nau</option>";
                    }
                    ?>
               </select>
          </form>
          <!-- WYBRANY PRZEDMIOT ... -->
          <?php
     
}
echo "!!!!!";
echo $_POST['przedmiot'];
var_dump($_POST['przedmiot']);
     // echo nauczycie////leKtorzyUcza($_POST['przedmiot']);
     // var_dump(nauczycieleKtorzyUcza("fizyka"));
     $sql = "SELECT przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko FROM nauczany_przedmiot INNER JOIN nauczyciel ON nauczany_przedmiot.id_nauczyciela = nauczyciel.id INNER JOIN przedmiot ON nauczany_przedmiot.id_przedmiotu = przedmiot.id WHERE przedmiot.nazwa LIKE $przedmiot;";
     $result = mysqli_query($conn, $sql);
     $tabN = [];
     while ($row = mysqli_fetch_assoc($result)) {
           array_push($tabN, $row);
           echo $row;
          }

     ?>

     <script>

     </script>
</body>
</html>