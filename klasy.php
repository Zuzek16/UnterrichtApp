<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Klasy</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <?php
     include_once "func.php";
     include_once "conn.php";
     include_once "getAll.php";
     addheader();
     ?>
     <!-- dodawanie -->
     <div class="lewy">
    <h2 class="pageFunc">Dodawanie klasy</h2>
    
    <form action="" method="POST">
    <div class="dodKlase">

    <label for="nazwa">Nazwa klasy:</label>
    <input type="text" name="nazwa" id="nazwa" required>

    <label for="szkola">Do której szkoły dodać?</label>
    <select name="szkola" id="szkola">
        <option value="">Wybierz</option>
        <?php
        include_once "conn.php";
        foreach ($klasaSzkoly as $key => $value) {
            echo "<option value='".$value['idSzkoly']."'>".$key."</option>";
        }
        ?>
    </select>


    <label for="planL">Przypisz plan lekcji dla tworzonej klasy(opcjonalne):</label>
    <!-- !!NOT WORKING -->
    <select name="planL" id="planL">
        <option value="">Wybierz</option>
        <?php
        foreach ($planyLekcji as $key => $value) {
            echo "<option value='".$value['id']."'>nr ".$value['id']."</option>";
        }
        ?>
    </select>

    <button type="submit">Dodaj klasę</button>
</div>
</form>
<?php
    if (isset($_POST['nazwa']) && trim($_POST['nazwa']) != "" && isset($_POST['szkola']) && trim($_POST['szkola']) != "") {
        $nazwa = mysqli_real_escape_string($conn, trim($_POST['nazwa']));

        if (isset($_POST['planL']) && trim($_POST['planL']) != "") {
            $sqlK = "INSERT INTO `klasa` (`id`, `nazwa`, `id_szkola`, `id_planu_lekcji`) VALUES (NULL, '".$_POST['nazwa']."', '".$_POST['szkola']."', '".$_POST['planL']."')";
        } else {
            $sqlK = "INSERT INTO `klasa` (`id`, `nazwa`, `id_szkola`, `id_planu_lekcji`) VALUES (NULL, '".$_POST['nazwa']."', '".$_POST['szkola']."', 'NULL')";
        }

        if (mysqli_query($conn, $sqlK)) {
            echo "<p class='infZwrotna'>Pomyślnie dodano nową klasę do szkoły.</p>
            <a href ='klasy.php'>Odświerz</a>";
        } else {
            echo "<p class='infZwrotna'>Nie udało się dodać klasy.</p>";
        }
    }
?>
</div>
<!-- widok + zmiana planu i ususwanie -->
<div class="prawy">
    <h2 class="pageFunc center">Lista klas według szkół</h2>
    <?php
    foreach ($klasaSzkoly as $szkola => $value) {
        echo "<div class='showSzKlasy'>";
        renderKlasy($szkola);
        echo "</div>";
    }
    ?>
</div>
<?php addFooter();?>
</body>
</html>