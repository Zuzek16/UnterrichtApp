<?php
// include "conn.php";
//dont import connection!

function getDanePlanLekcji($idPlanuLekcji) {
     
     global $conn;

     //upewnienie się czy na pewno istnieje ten plan_lekcji
     $sqlIstniejePlan = "SELECT * FROM `plan_lekcji` WHERE id = $idPlanuLekcji";

     $r_istnieje = mysqli_query($conn, $sqlIstniejePlan);

     if (!($row = mysqli_fetch_assoc($r_istnieje))) {
         return false;
     }

     $dane = [];//assoc tablica

     $sqlPobierzDane = "SELECT DISTINCT dzien_tygodnia.nazwa AS 'dzienTyg', przyporzadkowanie_lekcji.nr_lekcji, przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko, sala.numer AS 'nr_sali' from lekcje_planu INNER JOIN przyporzadkowanie_lekcji ON przyporzadkowanie_lekcji.id = lekcje_planu.id_przyporzadkowanej_lekcji INNER JOIN dzien_tygodnia ON dzien_tygodnia.id = przyporzadkowanie_lekcji.id_dnia_tyg INNER JOIN lekcja ON lekcja.id = przyporzadkowanie_lekcji.id_lekcji INNER JOIN nauczyciel ON nauczyciel.id = lekcja.id_nauczyciela INNER JOIN przedmiot ON przedmiot.id = lekcja.id_przedmiotu INNER JOIN sala ON sala.id = lekcja.id_sali WHERE lekcje_planu.id_planu_lekcji = $idPlanuLekcji;";

     $r_dane = mysqli_query($conn, $sqlPobierzDane);
     
     while ($row = mysqli_fetch_assoc($r_dane)) {
          var_dump($row);
          echo"<br>";
          echo"<br>";
          array_push($dane, $row);//???
     }

     //$dane = [[pon] => [[nrLekcji, przedmiot, nau, sala],
     //[nrLekcji, przedmiot, nau, sala]]]


     return $dane;
}

function mobilePlanShow($idPlanuLekcji, $dzienTyg) {//każdy dzień we własnej tabelce - pojedyńczo
     
     echo "<table>";



     echo"</table>";

}

function desktopPlanShow($idPlanuLekcji) {//całość na raz


}
?>