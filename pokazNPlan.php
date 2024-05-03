<?php
//tu też jakikolwiek plan render i możliwość zmiany
if (!(isset($_GET['nowyPlan']))) {
     echo '<p>Nie ma nowych planów lekcji,<a href="tworzPlan.php"> stwórz go teraz</a>!</p>';
     
} else {
include "conn.php";
include "getAll.php";
include "planRender.php";

     ?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Nowy plan lekcji</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <div class="tableContainer">
          <div class="mobile">
          <?php
     global $dzien_tygodnia;
     foreach ($dzien_tygodnia as $key => $value) {
          mobilePlanShow($_GET['nowyPlan'], $key);
     }

     ?>
          </div>
          <div class="desktop">
               <?php
               desktopPlanShow($_GET['nowyPlan']);
               ?>

          </div>
     </div>
     <div class="test">
     

     </div>
</body>
</html>
     

<?php
}//zamknięcie głównego if'a
?>