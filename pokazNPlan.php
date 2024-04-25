<?php
//tu też jakikolwiek plan render i możliwość zmiany
if (!(isset($_GET['nowyPlan']))) {
     echo '<p>Nie ma nowych planów lekcji,<a href="tworzPlan.php"> stwórz go teraz</a>!</p>';
     
} else {
include "conn.php";
     ?>
     

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Nowy plan lekcji</title>
</head>
<body>
     <div class="tableContainer">
          <div class="mobile">

          </div>
          <div class="desktop"></div>
     </div>
     <div class="test">

     <?php
     include "planRender.php";
     var_dump(getDanePlanLekcji($_GET['nowyPlan']));
     
     ?>

     </div>
</body>
</html>
     

<?php
}//zamknięcie głównego if'a
?>