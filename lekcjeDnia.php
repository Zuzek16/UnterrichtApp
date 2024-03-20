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
     <form action="" method="post">
          <label for="przedmiot">Przedmiot</label>
          <select name="przedmiot" id="przedmiot">
          <?php
          include 'getAll.php';
          foreach($przedmiot as $el){echo "<option value='".$el['nazwa']."'>".$el['nazwa']."</option>";}
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
                    <?php
               //     foreach(nauczycieleKtorzyUcza($_POST['przedmiot'])){
// !! dok this function in getAll.php
                    // }
                    ?>
               </select>
          </form>
          
          <?php
     }
     ?>

     <script>

     </script>
</body>
</html>