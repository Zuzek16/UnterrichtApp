<?php
if (!(isset($_GET['id']))) {
     echo '<p>Nie udało się znaleść żądanego planu lekcji,<a href="choosePlan.php"> wybierz ponownie</a></p>';
} else {
include "conn.php";
include "getAll.php";
include "planRender.php";
     ?>
<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Podgląd planu lekcji</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
<?php
include_once ("func.php");
addheader();
?>
     <div class="tableContainer">
          <div class="mobile">
          <?php
     global $dzien_tygodnia;
     foreach ($dzien_tygodnia as $key => $value) {
          mobilePlanShow($_GET['id'], $key);
     }
     ?>
          </div>
          <div class="desktop">
               <?php
               desktopPlanShow($_GET['id']);
               ?>
          </div>
     </div>
<?php addFooter();?>

</body>
</html>
     
<?php
}//zamknięcie głównego if'a
?>