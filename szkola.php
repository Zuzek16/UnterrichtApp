<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Twoje szkoły</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <div id="editON" class="lewy">
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
          <div class="prawo">
          <h3>Usuwanie szkoły</h3>
          <h4 class="danger">Tej decyzji nie można cofnąć! Zastanow się dobrze.</h2>
          <form action="#" method="post">
               <label for="usuSz">Wybierz szkołę do usunięcia:</label>
               <select name="usuSz" id="usuSz">
                    <?php
                    include "getAll.php";
                    foreach ($klasaSzkoly as $key => $value) {
                         echo "<option value='".$value['idSzkoly']."'>".$key."</option>";
                    }
                    ?>
               </select>
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
     <?php
     echo "<pre>".var_dump($klasaSzkoly)."</pre>";
     include "func.php";
     if ($_GET['edit'] == "true") {
          addFooter("<a href='szkola.php?edit=false'>Zobacz szkoły</a>");
     } else {
          addFooter("<a href='szkola.php?edit=true'>Zarządzaj szkołami</a>");
     }
     ?>
</body>
</html>