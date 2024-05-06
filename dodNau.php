<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie nauczyciela</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<a class="skip-link" href="#imie">Przejdź do głównej treści</a>

<?php
include_once ("func.php");
addheader();
?>
<h2 class="pageFunc">Dodawanie nauczyciela</h2>

<form action="" method="POST">
    <div class="dodNau">

    <label for="imie">Imię:</label>
    <input type="text" name="imie" id="imie" required>

    <label for="nazwisko">Nazwisko:</label>
    <input type="text" name="nazwisko" id="nazwisko" required>
    
    <label for="przedmioty">Nauczane przedmioty:</label>
    <?php
        include "conn.php"; include "getAll.php";
        global $przedmiot;

    foreach ($przedmiot as $el) {
        echo "<label for='".$el['id']."'>".$el['nazwa']."</label>";
        echo "<input type='checkbox' name='".$el['id']."' id='".$el['id']."' value='".$el['id']."'>";
    }
?>
    <button type="submit">Dodaj nauczyciela</button>
    </div>
</form>

<?php
    if (isset($_POST['imie']) && trim($_POST['imie']) != "" && isset($_POST['nazwisko']) && trim($_POST['nazwisko']) != "") {
        $setPrzed = [];
        foreach ($przedmiot as $el) {
                if (isset($_POST[$el['id']])) {
                    array_push($setPrzed, $el['id']);
                }
        }

        $imie = mysqli_real_escape_string($conn, trim($_POST['imie']));
        $nazwisko = mysqli_real_escape_string($conn, trim($_POST['nazwisko']));

        $sqlN = "INSERT INTO `nauczyciel` (`id`, `imie`, `nazwisko`) VALUES (NULL, '".htmlentities($imie)."', '".htmlentities($nazwisko)."')";

        if (mysqli_query($conn, $sqlN)) {
            echo "<p class='infZwrotna'>Pomyślnie dodano nowego nauczyciela do szkoły... Dodawanie nauczanych przedmiotów</p>";
        } else {
            echo "<p class='infZwrotna'>Nie udało się dodać nauczyciela.</p>";
        }
        $idNau = mysqli_insert_id($conn);
        $sqlP = "";
        foreach ($setPrzed as $idPrzed) {
            $sqlPGlowny = "INSERT INTO `nauczany_przedmiot` (`id`, `id_przedmiotu`, `id_nauczyciela`) VALUES (NULL, '$idPrzed', '$idNau')";
            $sqlPDrugi = ", (NULL, '$idPrzed', '$idNau')";
            if ($sqlP == "") {
                $sqlP .= $sqlPGlowny;
            } else {
                $sqlP .= $sqlPDrugi;
            }
        }
        if (mysqli_query($conn, $sqlP)) {
            echo "<p class='infZwrotna'>Pomyślnie dodano nauczane przedmioty.</p>";
        } else {
            echo "<p class='infZwrotna'>Wystąpił błąd podczas dodawnia nauczanych przedmiotów.</p>";
        }
    }
?>
</body>
</html>