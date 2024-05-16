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
<div class="lewy">
    <h2 class="pageFunc">Dodawanie nauczyciela</h2>
    
    <form action="" method="POST">
    <div class="dodNau">

    <label for="imie">Imię:</label>
    <input type="text" name="imie" id="imie" required value="<?php echo isset($_POST["imie"]) ? $_POST["imie"] : ''; ?>">

    <label for="nazwisko">Nazwisko:</label>
    <input type="text" name="nazwisko" id="nazwisko" required value="<?php echo isset($_POST["nazwisko"]) ? $_POST["nazwisko"] : ''; ?>">
    
    <label for="szkola">Do której szkoły dodać?</label>
    <select name="szkola" id="szkola">
        <option value="">Wybierz</option>
        <?php
        include_once "conn.php";
        include_once "getAll.php";
        foreach ($klasaSzkoly as $key => $value) {
            echo "<option value='".$value['idSzkoly']."' ".isSelected("szkola", $value['idSzkoly']).">".$key."</option>";
        }
        ?>
    </select>

    <label for="przedmioty">Nauczane przedmioty:</label>
    <div class="checkboxes">

        <?php
        global $przedmiot;
        foreach ($przedmiot as $el) {
            echo "<input type='checkbox' name='".$el['id']."' id='".$el['id']."' value='".$el['id']."'>";
            echo "<label for='".$el['id']."'>".$el['nazwa']."</label><br>";
        }
        ?>
</div>
    <button type="submit">Dodaj nauczyciela</button>
</div>
</form>
<?php
    if (isset($_POST['imie']) && trim($_POST['imie']) != "" && isset($_POST['nazwisko']) && trim($_POST['nazwisko']) != "" && isset($_POST['szkola']) && trim($_POST['szkola']) != "") {

        if (maCyfre($_POST['imie']) || maCyfre($_POST['nazwisko'])) {
            echo "<p class='infZwrotna'>Imie oraz nazwisko nie może zawierać cyfr</p>";            
        } else {
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

        } else {
            echo "<p class='infZwrotna'>Nie udało się dodać nauczyciela.</p>";
        }
        
        $_POST['imie'] = "";
        $_POST['nazwisko'] = "";
        }//end of else for digit check
    } else {
        echo "<p class='infZwrotna'>Imie, nazwisko ani szkoła nie mogą być puste.</p>";
    }
?>
</div>

<div class="prawy">
<table>
     <tr>
          <th>ID</th>
          <th>imię</th>
          <th>nazwisko</th>
          <th>nauczane przedmioty</th>
          <th>nazwa szkoły w której uczy</th>
     </tr>
     <?php
     include_once "getAll.php";
     foreach ($nauczyciele as $key => $nauczyciel) {
            echo "<tr>";
            echo "<td>".$nauczyciel['id']."</td>";
            echo "<td>".$nauczyciel['imie']."</td>";
            echo "<td>".$nauczyciel['nazwisko']."</td>";
        $czegoUczy;
    echo "<td>";
    foreach ($nauczany_przedmiot as $key => $value) {
        foreach ($value as $key2 => $value2) {
            if ($nauczyciel['imie']." ".$nauczyciel['nazwisko'] == $value2[1] && $nauczyciel['id'] == $value2[0]) {
                echo "<p>$key</p>";
            }
        }
    }
    echo "</td>";
    echo "<td>";//szkola w której uczy
    foreach ($nauSzkoly as $row => $value) {
        if ($nauczyciel['id'] == $value['id_nauczyciela']) {
            if (trim($value['nazwa']) == "") {
                echo "<a href='nauSzZmien.php'>Brak szkoły - zmień</a>";
            } else {
                echo $value['nazwa'];
            }
        }
    }
    echo"</td>";
    echo "<td> <a class='btn' href='usuNau.php?id=".$nauczyciel['id']."'>usuń</a>/";
    echo "<a class='btn' href='editNau.php?id=".$nauczyciel['id']."'>edytuj</a></td>";
    echo "</tr>";
     }
     ?>
</table>
</div>
<?php addFooter();?>
</body>
</html>