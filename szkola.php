<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Twoje szkoły</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <div id="editON">
     <h3>Dodawanie szkoły</h3>
     <form action="#" method="post">
     <label for="nowSzk">Pełna nazwa szkoły:</label>
     <input type="text" name="nowSzk" id="nowSzk">
     <button type="submit">Zapisz</button>
     </form>
     <?php
     //check if isnt only numbers
     if (isset($_POST['nowSzk']) && trim($_POST['nowSzk']) != "") {
          $_POST['nowSzk'] = mysqli_real_escape_string($conn, $_POST['nowSzk']);
          $sql = "INSERT INTO `szkola` (`id`, `nazwa`) VALUES (NULL, '".htmlentities($_POST['nowSzk'])."')";

          if(mysqli_query($conn, $sql)){
               echo "<p>Dodawanie szkoły do bazy danych...</p>";
           }
     }
     // herer now
     ?>
     <!--  -->
     <!--  -->
     <!--  -->
     <!--  -->

     <div class="prawy">
          <h3>Usuwanie szkoły</h3>
          <h4 class="danger">Tej decyzji nie można cofnąć! Zastanow się dobrze.</h2>
     </div>
     </div>
     <div id="editOFF">
          <h3>Lista szkół</h3>

          <table>
               
          </table>
     </div>
     
     <script>
          const queryString = window.location.search;
          const urlParams = new URLSearchParams(queryString);
          let edit;
          if (urlParams.has('edit')) {
               edit = urlParams.get('edit');
          } else {
               edit = "false";
          }

          if (edit == "true") {//włączamy odd i usuwanie szkoly/edit szkoy
               document.getElementById("editOFF").style.display = "none";//could also do an class of displaing and toggle it on and off
               document.getElementById("editON").style.display = "block";

          } else if (edit == "false"){
               document.getElementById("editOFF").style.display = "block";
               document.getElementById("editON").style.display = "none";
          }
     </script>
</body>
</html>