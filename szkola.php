<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Twoje szkoły</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <a class="skip-link" href="#toggle">Przejdź do głównej treści</a>
     <?php
     include_once "func.php";
     addheader();

     if (!isset($_GET['edit'])) {
          echo"<a id='toggle' class='toggle' href='szkola.php?edit=true'>Zarządzaj szkołami</a>";
     } else if ($_GET['edit'] == "true") {
          echo"<a id='toggle' class='toggle' href='szkola.php?edit=false'>Zobacz szkoły</a>";
     } else {
          echo"<a id='toggle' class='toggle' href='szkola.php?edit=true'>Zarządzaj szkołami</a>";
     }
     ?>

     <div id="editON">
          <div class="lewy">

     <h3>Dodawanie szkoły</h3>
     <form action="#" method="post">
     <label for="nowSzk">Pełna nazwa szkoły:</label>
     <input type="text" name="nowSzk" id="nowSzk">
     <button type="submit">Zapisz</button>
     </form>
     <?php
     include "conn.php";
     if (isset($_POST['nowSzk']) && trim($_POST['nowSzk']) != "") {
          if (!is_numeric($_POST['nowSzk'])) {    
               $_POST['nowSzk'] = mysqli_real_escape_string($conn, $_POST['nowSzk']);
               $sql = "INSERT INTO `szkola` (`id`, `nazwa`) VALUES (NULL, '".htmlentities($_POST['nowSzk'])."')";  
               if(mysqli_query($conn, $sql)){
                    echo "<p>Udało dodać się nową szkołę.</p>";
               } else {
                    echo "<p>Nie udało się dodać szkoły. Spróbuj ponownie</p>";
               }
          } else {
               echo "<p>Nie można nazwać szkoły tylko cyframi.</p>";
          }
     }
          ?>
          </div>
          <div class="prawy">
          <h3>Usuwanie szkoły</h3>
          <h4 class="danger">Tej decyzji nie można cofnąć! Zastanow się dobrze.</h2>
          <h4>Czynność da usuwa również wszystkie dane powiązane ze szkołą</h4>
          <form action="usuSz.php" method="GET">
               <label for="usuSz">Wybierz szkołę do usunięcia:</label>
               <select name="usuSz" id="usuSz">
                    <?php
                    include "getAll.php";
                    foreach ($klasaSzkoly as $key => $value) {
                         echo "<option value='".$value['idSzkoly']."'>".$key."</option>";
                    }
                    ?>
               </select>
               <button type="submit">Usuń</button>
          </form>
     </div>
     </div>
     
     <div id="editOFF">
          <div class="lewy">
               <h3>Lista szkół</h3>
               <table>
                    <tr>
                         <th>ID</th>
                         <th>Nazwa</th>
                    </tr>
                    <?php
$result = mysqli_query($conn, "SELECT * from szkola");
while ($row = mysqli_fetch_assoc($result)) {
     echo "<tr>" ;   
     foreach($row as $el){
          echo "<td>".$el."</td>";
     }
     echo "</tr>" ; 
}
?>
</table>
</div>
</div>
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
          if (edit == "true") {
               document.getElementById("editOFF").style.display = "none";
               document.getElementById("editON").style.display = "block";
          } else {
               document.getElementById("editOFF").style.display = "block";
               document.getElementById("editON").style.display = "none";
          }
     urlParams.set("edit", edit);
     </script>
     <?php addFooter();?>
</body>
</html>