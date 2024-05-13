<?php
// include "conn.php";
//dont import connection!

global $dzien_tygodnia;
function getDanePlanLekcji($idPlanuLekcji) {
     
     global $conn;

     $sqlIstniejePlan = "SELECT * FROM `plan_lekcji` WHERE id = $idPlanuLekcji";

     $r_istnieje = mysqli_query($conn, $sqlIstniejePlan);

     if (!($row = mysqli_fetch_assoc($r_istnieje))) {

          echo "<h3>Wystąpił błąd. Nie można znaleść nowego planu (nieistniejący identyfikator planu lekcji)</h3>";
         return false;
     }

     $dane = [];//assoc tablica
     $sqlPobierzDane = "SELECT DISTINCT dzien_tygodnia.nazwa AS 'dzienTyg', przyporzadkowanie_lekcji.nr_lekcji, przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko, sala.numer AS 'nr_sali' from lekcje_planu INNER JOIN przyporzadkowanie_lekcji ON przyporzadkowanie_lekcji.id = lekcje_planu.id_przyporzadkowanej_lekcji INNER JOIN dzien_tygodnia ON dzien_tygodnia.id = przyporzadkowanie_lekcji.id_dnia_tyg INNER JOIN lekcja ON lekcja.id = przyporzadkowanie_lekcji.id_lekcji INNER JOIN nauczyciel ON nauczyciel.id = lekcja.id_nauczyciela INNER JOIN przedmiot ON przedmiot.id = lekcja.id_przedmiotu INNER JOIN sala ON sala.id = lekcja.id_sali WHERE lekcje_planu.id_planu_lekcji = $idPlanuLekcji ORDER BY przyporzadkowanie_lekcji.nr_lekcji ASC, FIELD(dzien_tygodnia.nazwa, 'poniedziałek', 'wtorek', 'środa', 'czwartek', 'piątek');
     ";

     $r_dane = mysqli_query($conn, $sqlPobierzDane);
     
     while ($row = mysqli_fetch_assoc($r_dane)) {
          array_push($dane, $row);
     }
     //$dane = [[pon] => [[nrLekcji, przedmiot, nau, sala],
     //[nrLekcji, przedmiot, nau, sala]]
     return $dane;
}

function mobilePlanShow($idPlanuLekcji, $dzienTyg) {//każdy dzień we własnej tabelce - pojedyńczo
     $dane = getDanePlanLekcji($idPlanuLekcji);

     echo "<table>
     <tr>
     <th>nr</th>
     <th>$dzienTyg</th>
     </tr>";
     $counter = 0;
     echo "<tr>";
     foreach ($dane as $key => $v) {
          if ($v['dzienTyg'] == $dzienTyg) {
               echo "<td>".$v['nr_lekcji']."</td>";
               echo "<td>".$v['nazwa']."<br>".$v['imie']." ".$v['nazwisko']."<br>"."sala ".$v['nr_sali']."</td>";
               echo "</tr><tr>";
          }
     }
     echo "</tr>";
     echo"</table>";
}

function desktopPlanShow($idPlanuLekcji) {//całość na raz
     $dane = getDanePlanLekcji($idPlanuLekcji);
     echo "<table>
     <tr>
     <th>poniedziałek</th>
     <th>wtorek</th>
     <th>środa</th>
     <th>czwartek</th>
     <th>piątek</th>
     </tr>";
     $counter = 0;
     echo "<tr>";
     foreach ($dane as $key => $v) {
          echo "<td>".$v['nazwa']."<br>".$v['imie'].$v['nazwisko']."<br>"."sala ".$v['nr_sali']."</td>";
          $counter ++;
          if ($counter % 5 == 0) {echo "</tr><tr>";}
     }
     echo "</tr>";
     echo"</table>";
}
?>