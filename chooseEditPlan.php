<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnterrichtApp - edycja</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <?php
    include_once "conn.php";
    include_once "getAll.php";
    include_once "func.php";
    addheader();
    ?>
    <h2 class="pageFunc center">Wybierz plan do edycji</h2>

    <div class="main longList">
        <ul>
        <?php
        $i = 1;
        foreach ($planyLekcji as $key => $value) {
          if (($i-1)%10 == 0) {
               echo "<div class='breakup'>";
          }
            echo "<li><a href='pokazPlan.php?id=".$value['id']."'>nr ".$value['id']."</a> -- <a href='editPlan.php?id=".$value['id']."'>edytuj</a></li>";

            if ($i%10 == 0) {
               echo "</div>";
          }
            $i++;
        }
        ?>
        </ul>
     </div>
<?php addFooter();?>
</body>
</html>