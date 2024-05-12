<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Wybierz plan</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <?php
     include_once "func.php";
     include_once "conn.php";
     include_once "getAll.php";
     addheader();
     ?>
    <h2 class="pageFunc center">Podgląd planu leckji</h2>

    <!-- <form action="#" method="post" class='center'>

    <label for="planL">Wybierz plan lekcji który chcesz zobaczyć</label>
    <select name="planL" id="planL">
        <option value="">Wybierz</option> -->

        <!-- display it in row of a few -->

        <ul>
        <?php
        foreach ($planyLekcji as $key => $value) {
            echo "<li><a href='pokazPlan.php?id=".$value['id']."'>nr ".$value['id']."</a></li>";
        }
        ?>
        </ul>
    <!-- </select>

    <button type="submit">Zobacz plan</button>
     </form> -->

<?php addFooter();?>
</body>
</html>