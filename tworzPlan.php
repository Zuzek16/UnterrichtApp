<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnterrichtApp - kreator</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<h2>Tworzenie planu</h2>

<?php
include "conn.php";

// przypisanie go klasie!
//1. pusty szablon planu gdzie dodajemy lekcje poprzez wciśnięcia w td linku który przenośi nas że można dodać

$sql = "SELECT * from szkola";
$wynik = mysqli_query($conn, $sql);
$tab = [];

while ($row = mysqli_fetch_assoc($wynik)) {
    if ($tab == NULL) array_push($tab, $row); //does it still work?
    else array_push($tab, $row);
}

if ($tab == NULL) {
    echo "<p>Nie ma żadnej szkoły!</p>
    <p><a href=szkola.php>Dodaj ją</a></p>";
} else {
//po 10? (lekcji pusty ch by defalt) lub że jeden rządek i dodajemy dobiero bo po co nam null 
//
// var_dump($tab[1]["nazwa"]);
// var_dump($tab);
?>
<form action="" method="post">
    <label for="szkolaAktyw">Dla ktorej szkoły chcesz zrobić plan?</label>
    <select name="szkolaAktyw" id="szkolaAktyw">
        <?php
        foreach($tab as $szkola){echo "<option value='".$szkola['nazwa']."'>".$szkola['nazwa']."</option>";}
        ?>
    </select>
    <button type="submit">Zatwierdź</button>
</form>

<p>
    <?php
    //set teh szkolaaktyw variabvle.
    echo "Wybrana szkoła: ".$szkolaAktyw;
    ?>
</p>

<table>
    <tr>
        <th>Pon</th>
        <th>Wt</th>
        <th>Śr</th>
        <th>Czw</th>
        <th>Pt</th>
    </tr>
    <tr>
        <td><a href="lekcjeDnia.php?dzien=pon">wybierz lekcje</a></td>
        <td><a href="lekcjeDnia.php?dzien=wt">wybierz lekcje</a></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>

<?php
}


?>
<!--  -->
</body>
</html>