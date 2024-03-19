<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Twoje szkoły</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <?php
     include "conn.php";
     ?>
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

          <div class="prawy">
               <h3 class="editToggle"><a href="szkola.php?edit=true">Zarządzaj szkołami</a></h3>
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

          

          if (edit == "true") {//włączamy odd i usuwanie szkoly/edit szkoy
               document.getElementById("editOFF").style.display = "none";//could also do an class of displaing and toggle it on and off
               document.getElementById("editON").style.display = "block";

          } else {
               document.getElementById("editOFF").style.display = "block";
               document.getElementById("editON").style.display = "none";
          }

          const btns = document.querySelectorAll(".editToggle");//nie dizala

          btns.forEach(element => {
               element.addEventListener("click", ()=>{
               if (edit == "true") {
                    edit = "false"
               } else if (edit == "false") {
                    edit = "true"
               }})     
          });

          for (let i = 0; i < btns.length; i++) {
btns[i].addEventListener("click", ()=>{
     if (edit == "true") {
                    edit = "false"
               } else if (edit == "false") {
                    edit = "true"
               }
     
})
}
          

          urlParams.set("edit", edit);

     </script>
</body>
</html>