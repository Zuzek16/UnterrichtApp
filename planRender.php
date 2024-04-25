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

     $sqlPrzypLek = "SELECT * FROM `lekcje_planu` WHERE id_planu_lekcji = $idPlanuLekcji;";//!odczytać i do $dane[]???;czy odrazu lekcjie tylko?


     return $dane;
}

function mobilePlanShow($idPlanuLekcji, $dzienTyg) {//każdy dzień we własnej tabelce - pojedyńczo
     
     echo "<table>";



     echo"</table>";

}

function desktopPlanShow($idPlanuLekcji) {//całość na raz


}
?>