<?php
include "conn.php";

// is this a good idea?
function nauczycieleKtorzyUcza($przedmiot){
     //do wszystkich przedmiotow $sql = "SELECT przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko FROM nauczany_przedmiot INNER JOIN nauczyciel ON nauczany_przedmiot.id_nauczyciela = nauczyciel.id INNER JOIN przedmiot ON nauczany_przedmiot.id_przedmiotu = przedmiot.id;";//do this querey now - wyklikać w phpmyadmin

     //[przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko]
     $sql = "SELECT przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko FROM nauczany_przedmiot INNER JOIN nauczyciel ON nauczany_przedmiot.id_nauczyciela = nauczyciel.id INNER JOIN przedmiot ON nauczany_przedmiot.id_przedmiotu = przedmiot.id WHERE przedmiot.nazwa LIKE $przedmiot;";
     $result = mysqli_query($conn, $sql);
     $tabN = [];
     while ($row = mysqli_fetch_assoc($result)) {
           array_push($tabN, $row);
           echo $row;
          }
     return $tabN;

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