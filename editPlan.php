<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edycja planu lekcji</title>
     <link rel="stylesheet" href="styl.css">
<!-- !!NOT WORKING -->
     <?php
    include "conn.php";
    include_once "func.php";
    include_once "planRender.php";
    include_once "getAll.php";
    global $conn;
    global $nauczany_przedmiot;
    $jsonNP = json_encode($nauczany_przedmiot);
    echo "<script>var nauczany_przedmiot = $jsonNP;</script>";
    ?>

     <script>
let x = window.matchMedia("(max-width: 870px)");
let desktopMode;
let y = 1;
let n = 0;

if (!x.matches) {
    desktopMode = y;
  } else {
    desktopMode = n;
  }

  document.cookie=`desktopMode=${desktopMode}; expires=Thu, 18 Dec 2090 12:00:00 UTC`;

window.addEventListener("resize", function() {
    if (!x.matches) {
        desktopMode = y;
  } else {
    desktopMode = n;
  }
  document.cookie=`desktopMode=${desktopMode}; expires=Thu, 18 Dec 2090 12:00:00 UTC`;

  location.reload();
}); 
    </script>
</head>
<body>
     <?php
     include_once "func.php";
     include_once "conn.php";
     include_once "getAll.php";
     addheader();?>
<h2 class="pageFunc">Edytowanie planu leckji </h2>
<!-- <p>Zmień przedmiot aby zobaczyć resztę nauczycieli</p> -->
<div class="dodKlase">

<?php
     if (!isset($_GET['id'])) {
          echo "<p>Nie udało się pobrać informacji. Proszę spróbować jescze raz</p>
          <a href='chooseEditPlan.php'>Powrót</a>
          ";
     } else {
          ?>
       <div class="tableContainer">
<form action="#" method="post">
    <table class="calosc" id="calosc">
    <?php
    $dane = getDanePlanLekcji($_GET['id']);
    if ($dane == false) {
        echo "<p class='infZwrotna'>Wystąpił błąd. Nie można znaleść nowego planu (nieistniejący identyfikator planu lekcji)</p>";
        echo"<a href='chooseEditPlan.php'>Powrót</a>";
    } else {
        if (str_contains($_COOKIE['desktopMode'], "1")) {
            echo "<tr>
            <th>nr</th>
            <th>Pon</th>
            <th>Wt</th>
            <th>Śr</th>
            <th>Czw</th>
            <th>Pt</th>
        </tr>";
        global $nauczany_przedmiot;
        for ($i=0; $i < 8; $i++) {//liczba lekcji
            echo "<tr>";
            echo "<td>";
            echo $i+1;
            echo"</td>";
            for ($j=0; $j < 5; $j++) {//dni tyg
                $dzien;
                switch ($j) {
                    case 0:
                        $dzien = "poniedziałek";
                        break;
                    case 1:
                        $dzien = "wtorek";
                        break;
                    case 2:
                        $dzien = "środa";
                        break;
                    case 3:
                        $dzien = "czwartek";
                        break;
                    case 4:
                        $dzien = "piątek";
                        break;
                }
                echo "<td>";
                lekcjaInput($i, $dzien, true, $dane);
                echo "</td>";
            }
           echo "</tr>";
        }
        echo "<tr>
        <td colspan=6>
        <button class='desktopbtn' type='submit'>Zapisz</button>
        </td>
    </tr>";
        } else {
        global $nauczany_przedmiot;
        for ($i=0; $i < 2; $i++) {//liczba lekcji
            echo "<tr>";
            for ($j=0; $j < 5; $j++) {//dni tyg
                $dzien;
                switch ($j) {
                    case 0:
                        $dzien = "poniedziałek";
                        break;
                    case 1:
                        $dzien = "wtorek";
                        break;
                    case 2:
                        $dzien = "środa";
                        break;
                    case 3:
                        $dzien = "czwartek";
                        break;
                    case 4:
                        $dzien = "piątek";
                        break;
                }
                echo "<tr>
                <th></th>
                <th>$dzien</th>
                </tr>";
                for ($i=0; $i < 6; $i++) { 
                    echo "<tr>";
                    echo "<td>";
                    echo $i + 1;
                    echo "</td>";
                    echo "<td>";
                    lekcjaInput($i, $dzien, true,  getDanePlanLekcji($_GET['id']));
                    echo "</td>";
                    echo "</tr>";
                }
            }
           echo "</tr>";
        }//liczba lekcji
        echo "<tr>
        <td colspan=2>
        <button class='mobilebtn' type='submit'>Zapisz</button>
        </td>
    </tr>";
    }        
    }
    

    ?>
</table>
</form>
</div>
<script>
    let allSelect = document.querySelectorAll("select");

    allSelect.forEach(el => {
        el.addEventListener('change', ()=>{
            console.log(el.value);
            let form = '';
            nauczany_przedmiot[`${el.value}`].forEach(el => {
               form += `<option value="${el[0]}" >${el[1]}</option>`;
            });
            el.parentElement.querySelector('.nauczyciel').innerHTML = form;
        })        
    });
</script>
     <?php
     if (isset($_POST['nowyPlan'])) {
          $sql = "";
          if (mysqli_query($conn, $sql)) {
               echo "<p class='infZwrotna'>Pomyślnie zmieniono plan lekcji</p>";
            echo"<a href='chooseEditPlan.php'>Powrót</a>";
          } else {
               echo "<p class='infZwrotna'>Nie udało się zmenić planu</p>";
               echo"<a href='chooseEditPlan.php'>Powrót</a>"; 
          }
     }
     ?>
</div>   
     <?php
     }//główny if 
     ?>
     <?php
    function allSet($tab){
        $set = [];
        foreach ($tab as $el) {
            $postKey = $el;
            $postKey = (explode("]",$postKey));//rozdzielanie name select
            $postKey = (implode("",$postKey));
            $postKey = (explode("[",$postKey));

            if (isset($_POST[$postKey[0]][$postKey[1]][$postKey[2]]) && $_POST[$postKey[0]][$postKey[1]][$postKey[2]] != "") {
                array_push($set, true);
            } else {
                array_push($set, false);
            }
        }

        if (in_array(false, $set)) {
            return false;
        } else {
            return true;
        }
    }

    global $przedmiotSelectIds;
    global $nauczycielSelectIds;
    global $salaSelectIds;

    if (allset($przedmiotSelectIds) && allset($nauczycielSelectIds)&& allset($salaSelectIds)) {
        $idSali;
        $idNauczyciela;
        $idPrzedmiotu;

        $sqlTLekcja = "";
        $editLekcjiDoWykonania = [];
        foreach ($_POST as $dzienTyg => $value) {
            foreach ($_POST[$dzienTyg] as $nrLekcji => $value){
                foreach ($_POST[$dzienTyg][$nrLekcji] as $key => $value){

                    if ($key == "nauczyciel") {
                        $idNauczyciela = $value;
                    } else if ($key == "przedmiot"){
                        foreach ($przedmiot as $val) {
                            if ($value == $val['nazwa']) {
                                $idPrzedmiotu = $val['id'];
                            }
                        }
                    } else if ($key == "sala") {
                        foreach ($sala as $val) {
                            if ($value == $val['numer']) {
                                $idSali = $val['id'];
                            }
                        }
                    }
                }
                global $editLekcjiDoWykonania;
                $idLekcji = "?";
                $editLekcjaSql = "UPDATE `lekcja` SET `id_sali` = '$idSali', `id_nauczyciela` = '$idNauczyciela', `id_przedmiotu` = '$idPrzedmiotu' WHERE `lekcja`.`id` = $idLekcji";

                array_push($editLekcjiDoWykonania);
            }
        }//koniec przejścia po wartościach $_POST
        if (mysqli_query($conn, $sqlTLekcja)){
        $sqlTPrzypLek = "";
        $nrLekcji;
        $idDniaTyg;
        $idLekcji;
        $idsLekcji = [];
        $idOstatLek = mysqli_insert_id($conn);
         $liczbaLekcji = count($przedmiotSelectIds);
            for ($i=$liczbaLekcji; $i >= 0; $i--) { 
                if ($i == $liczbaLekcji) {
                    $idsLekcji[$i]=$idOstatLek;
                } else {
                    $idsLekcji[$i]=$idsLekcji[$i+1]-1;
                }
            }
        $idLekcjiCounter = 0;
        $idsCounter = 0;
        $idsPrzyporzadkowanejLekcji[0] = 0;
        $lastAddedDay = -1;
        foreach ($przedmiotSelectIds as $el) {
            global $lastAddedDay;
            $selectEl = $el;
            $selectEl = (explode("]",$selectEl));
            $selectEl = (implode("",$selectEl));
            $selectEl = (explode("[",$selectEl));
            global $dzien_tygodnia;
            $idDniaTyg = $dzien_tygodnia[$selectEl[0]];
            $nrLekcji = $selectEl[1];
            $idLekcji = $idsLekcji[$idLekcjiCounter];
            if ($lastAddedDay == $idDniaTyg) {//didnt change
                echo "<p>Znowu to samo </p>";
            } 
            $PrzypLekGlowny = "ALTER `przyporzadkowanie_lekcji` (`id`, `nr_lekcji`, `id_dnia_tyg`, `id_lekcji`) VALUES (NULL, '".$nrLekcji."', '".$idDniaTyg."', '".$idLekcji."')"; 
            $PrzypLekDrugi = ", (NULL, '".$nrLekcji."', '".$idDniaTyg."', '".$idLekcji."')";
            if ($sqlTPrzypLek == "") {
                $sqlTPrzypLek .= $PrzypLekGlowny;
            } else {
                $sqlTPrzypLek .= $PrzypLekDrugi;
            }
            $lastAddedDay = (int)$idDniaTyg;
            $idLekcjiCounter ++;
            $idsCounter ++; 
        }
        if (mysqli_query($conn, $sqlTPrzypLek)){
            global $idsPrzyporzadkowanejLekcji;
            global $liczbaLekcji;
            $idOstatPrzypLekcji = mysqli_insert_id($conn);
            for ($i=$liczbaLekcji; $i >= 0; $i--) { 
                if ($i == $liczbaLekcji) {
                    $idsPrzyporzadkowanejLekcji[$i]=$idOstatPrzypLekcji;
                } else {
                    $idsPrzyporzadkowanejLekcji[$i]=$idsPrzyporzadkowanejLekcji[$i+1]-1;
                }
            }
            $sqlPlanLekcji = "ALTER `plan_lekcji` (`id`) VALUES (NULL)";
            $sqlLekcjePlanu="";
            if (mysqli_query($conn, $sqlPlanLekcji)) {
                $idPlanuLekcji = mysqli_insert_id($conn);
                foreach ($idsPrzyporzadkowanejLekcji as $el) {
                    global $idPlanuLekcji;
                    if ($sqlLekcjePlanu == "") {
                        $sqlLekcjePlanu = "ALTER `lekcje_planu` (`id`, `id_planu_lekcji`, `id_przyporzadkowanej_lekcji`) VALUES (NULL, '$idPlanuLekcji', '$el')";
                    } else {
                        $sqlLekcjePlanu .= ",(NULL, '$idPlanuLekcji', '$el')";
                    }
                }
                if ( mysqli_multi_query($conn,$sqlLekcjePlanu)) {
                    echo "<p>GOTOWE</p>";
                    echo "<p>Udało Ci się storzyć nowy plan lekcji!</p>";
                    echo "<p>Przypisać go klasie?</p>
                    <button class ='odpY'><a href='klasa.php'>TAK</a></button>/ 
                    <button class ='odpN'>NIE</button>
                    <br><br><a class='button' href='pokazNPlan.php?nowyPlan=".$idPlanuLekcji."' >Zobacz twój nowo stworzony plan tutaj</a>
                    ";
                } else {
                    echo "<p>Wystąpił błąd w tworzeniu planu lekcji..</p>";
                }
            } else {
                echo "<p>Wystąpił błąd przy tworzeniu planu lekcji</p>";
            }
        } else {
            echo "<p>Wystąpił błąd w przyporządkowywaniu lekcji</p>";
        }
        } else {
            echo "<p>Błąd dodawania lekcji</p>";
        }
    }
?>
<?php addFooter();?>
</body>
</html>