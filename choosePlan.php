<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Wybierz plan</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
<a class="skip-link" href="#firstEl">Przejdź do głównej treści</a>
     <?php
     include_once "func.php";
     include_once "conn.php";
     include_once "getAll.php";
     addheader();
     ?>
    <h2 class="pageFunc center">Podgląd planu leckji</h2>
    <div class="main longList">
        <ul>
        <?php
        $i = 1;
        foreach ($planyLekcji as $key => $value) {
          if (($i-1)%10 == 0) {
               echo "<div class='breakup'>";
          }

          if ($i == 1) {
               $anchor = "id='firstEl'";
          } else {
               $anchor = "";
          }
            echo "<li><a href='pokazPlan.php?id=".$value['id']."&src=show' $anchor>nr ".$value['id']."</a> -- <a href='usuPlan.php?id=".$value['id']."'>usuń</a></li>";

            if ($i%10 == 0) {
               echo "</div>";
          }
            $i++;
        }
        ?>
        <!-- BEBUG -->
        
        <!-- BEBUG -->
        </ul>
     </div>
<?php addFooter();?>
</body>
</html>