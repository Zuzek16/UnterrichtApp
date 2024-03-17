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

$sql = "SELECT * from szkola";
$wynik = mysqli_query($conn, $sql);
$tab = [];

while ($row = mysqli_fetch_assoc($wynik)) {
    if ($tab == NULL) array_push($tab, $row); //does it still work?
    else array_push($tab, $row);
    
}

if ($tab == NULL) {
    echo "<p>Nie ma żadnej szkoły!</p>
    <p><a href=szkola.php>Dodaj ją</a></p>
    ";
}

// var_dump($tab[1]["nazwa"]);
var_dump($tab);
?>
    
</body>
</html>