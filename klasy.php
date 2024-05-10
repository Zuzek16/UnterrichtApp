<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Nauczyciele i klasy</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <?php
     include_once "func.php";
     include_once "conn.php";
     include_once "getAll.php";
     addheader();
     ?>

     <?php
     foreach ($klasaSzkoly as $nazwaSz => $value) {
          echo $nazwaSz;
          var_dump($value);
     }
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
        include_once "getAll.php";
        foreach ($klasaSzkoly as $key => $value) {
            echo "<option value='".$value['idSzkoly']."'>".$key."</option>";
        }
        ?>
    </select>
    <button type="submit">Dodaj klasę</button>
</div>
</form>
<?php
    if (isset($_POST['nazwa']) && trim($_POST['nazwa']) != "" && isset($_POST['szkola']) && trim($_POST['szkola']) != "") {
        $nazwa = mysqli_real_escape_string($conn, trim($_POST['nazwa']));

        $sqlN = "";

        if (mysqli_query($conn, $sqlN)) {
            echo "<p class='infZwrotna'>Pomyślnie dodano nową klasę do szkoły:".$_POST['szkola']."</p>";
        } else {
            echo "<p class='infZwrotna'>Nie udało się dodać klasy.</p>";
        }
       
        if (mysqli_query($conn, $sqlP)) {
            echo "<p class='infZwrotna'>Pomyślnie dodano nauczane przedmioty.</p>";

            $idSzkoly = $_POST['szkola'];

            $sqlNSz = "INSERT INTO `nauczyciele_szkoly` (`id`, `id_nauczyciela`, `id_szkoly`) VALUES (NULL, '$idNau', '$idSzkoly');";

            if (mysqli_query($conn, $sqlNSz)) {
                echo "<p class='infZwrotna'>Pomyślnie dodano nauczyciela do szkoły.</p>";

                echo "<p><a class='infZwrotna' href='nau.php'>Załaduj nowe dane</a></p>";
            } else {
                echo "<p class='infZwrotna'>Wystąpił błąd podczas dodawnia nauczyciela do szkoły.</p>";
            }

        } else {
            echo "<p class='infZwrotna'>Wystąpił błąd podczas dodawnia nauczanych przedmiotów.</p>";
        }

        $_POST['nazwa'] = "";
    }
?>
</div>
<!-- widok + zmiana planu i ususwanie -->

</body>
</html>