<?php
include "conn.php";

// is this a good idea?
function nauczycieleKtorzyUcza($przedmiot){//zwraca tablice
     $sql = "SELECT * from nauczany_przedmiot WHERE";//do this querey now - wyklikać w phpmyadmin
     $result = mysqli_query($conn, $sql);

}

$r_Sala = mysqli_query($conn, "SELECT * from sala");
$sala = [];
while ($row = mysqli_fetch_assoc($r_Sala)) array_push($sala, $row);

$r_przedmiot = mysqli_query($conn, "SELECT * from przedmiot");
$przedmiot = [];
while ($row = mysqli_fetch_assoc($r_przedmiot)) array_push($przedmiot, $row);

$r_nauczyciel = mysqli_query($conn, "SELECT * from nauczyciel");
$nauczyciel = [];
while ($row = mysqli_fetch_assoc($r_nauczyciel)) array_push($nauczyciel, $row);

$r_nauczany_przedmiot = mysqli_query($conn, "SELECT * from nauczany_przedmiot");
$nauczany_przedmiot = [];
while ($row = mysqli_fetch_assoc($r_nauczany_przedmiot)) array_push($nauczany_przedmiot, $row);


?>