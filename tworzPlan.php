<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnterrichtApp - kreator</title>
    <link rel="stylesheet" href="styl.css">
    <?php
    include "conn.php";
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
    let reload = false;
    
    if (!x.matches) {
        if (desktopMode != y) {
            reload = false;
        }
        desktopMode = y;
    } else {
        if (desktopMode != n) {
            reload = false;
        }
        desktopMode = n;
    }

  document.cookie=`desktopMode=${desktopMode}; expires=Thu, 18 Dec 2090 12:00:00 UTC`;

    if (reload == true) {
        location.reload();
    }

}); 

    </script>
</head>
<body>
<a class="skip-link" href="#firstEl">Przejdź do głównej treści</a>
<?php
include_once ("func.php");
addheader();
?>
<h2 class="pageFunc">Tworzenie planu</h2>
<?php
$sql = "SELECT * from szkola";
$wynik = mysqli_query($conn, $sql);
$tab = [];
while ($row = mysqli_fetch_assoc($wynik)) {
    array_push($tab, $row);
}

if ($tab == NULL) {
    echo "<p>Nie ma żadnej szkoły!</p>
    <p><a href=szkola.php?edit=true>Dodaj ją</a></p>";
} else {
?>

<p>Wszystkie pola muszą być uzupełnione</p>

<div class="tableContainer">
<form action="#" method="post">
    <table class="calosc" id="calosc">
    <?php
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
            if ($i == 0) {
                echo "<td id='firstEl'>";
            } else {
                echo "<td>";
            }
            lekcjaInput($i, $dzien);
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
    for ($i=0; $i < 2; $i++) {
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
            for ($i=0; $i < 8; $i++) {//liczba lekcji
                echo "<tr>";
                echo "<td>";
                echo $i + 1;
                echo "</td>";
                if ($i == 0) {
                    echo "<td id='firstEl'>";
                } else {
                    echo "<td>";
                }
                lekcjaInput($i, $dzien);
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
    ?>
</table>
</form>
</div>
<?php
}
?>
<script>
    console.log(nauczany_przedmiot);
    let allSelect = document.querySelectorAll("select.przedmiot");
    allSelect.forEach(el => {
        let form = '';

        <?php
        foreach ($przedmiotSelectIds as $key => $value) {
            $postKey = $value;
            $postKey = (explode("]",$postKey));
            $postKey = (implode("",$postKey));
            $postKey = (explode("[",$postKey));
            if (isset($_POST[$postKey[0]][$postKey[1]][$postKey[2]]) && $_POST[$postKey[0]][$postKey[1]][$postKey[2]] != "") {
                //isset przedmiot
                ?>
            if (el.value != "") {
                <?php
                foreach ($nauczycielSelectIds as $key => $value) {
                    $postKey = $value;
                    $postKey = (explode("]",$postKey));//rozdzielanie name select
                    $postKey = (implode("",$postKey));
                    $postKey = (explode("[",$postKey));
                    if (isset($_POST[$postKey[0]][$postKey[1]][$postKey[2]]) && $_POST[$postKey[0]][$postKey[1]][$postKey[2]] != "") {
                        //isset nau
                    $jsonNauId = json_encode($_POST[$postKey[0]][$postKey[1]][$postKey[2]]);
                    $jsonNauIdNr = json_encode($postKey[0].$postKey[1]);
                    echo "var idNauPost = $jsonNauId;";
                    echo "var idNauPostNr = $jsonNauIdNr;";
?>
                document.cookie = `idNau${idNauPostNr}=${idNauPost}`;
<?php
                    }//check nauczyciel
                }
?>
function getCookieValue(name) 
    {
      const regex = new RegExp(`(^| )${name}=([^;]+)`)
      const match = document.cookie.match(regex)
      if (match) {
        return match[2]
      }
   }
                if (typeof nauczany_przedmiot[`${el.value}`] !== "undefined") {

                    let postKey = el.name;
                    postKey = postKey.split("]");
                    postKey = postKey.join("");
                    postKey = postKey.split("[");                

                    let idNau = getCookieValue(`idNau${postKey[0]}${postKey[1]}`);
            
            nauczany_przedmiot[`${el.value}`].forEach((el, i) => {
                    if (parseInt(el[0]) == parseInt(idNau)) {
                        form += `<option value="${el[0]}" selected>${el[1]}</option>`;
                    } else {
                        form += `<option value="${el[0]}" >${el[1]}</option>`;
                    }
                });
             
    
                el.parentElement.querySelector('.nauczyciel').innerHTML = form;
                form = '';
                }
                } else {
                    el.parentElement.querySelector('.nauczyciel').innerHTML = "";    
                }
<?php
            }//check przedmiot
        }
        ?>
        el.addEventListener('change', ()=>{//working solution
            console.log("from changed");
            let nauczycielName = el.name;
            form = '';
          
            if (el.value != "") {
            if (typeof nauczany_przedmiot[`${el.value}`] !== "undefined") {
                nauczany_przedmiot[`${el.value}`].forEach(el => {
               form += `<option value="${el[0]}" >${el[1]}</option>`;
            });

            el.parentElement.querySelector('.nauczyciel').innerHTML = form;
            form = '';
            }
            } else {
                el.parentElement.querySelector('.nauczyciel').innerHTML = "";    
            }
            ///working /solution
        })        
    });
</script>
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

    // var_dump($przedmiotSelectIds);
    if (allset($przedmiotSelectIds) && allset($nauczycielSelectIds)&& allset($salaSelectIds)) {
        // if (false) {
        $idSali;
        $idNauczyciela;
        $idPrzedmiotu;

        $sqlTLekcja = "";
        //tabela 'lekcja' sql
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
                $dodLekcjeSzablonGlowny = "INSERT INTO `lekcja` (`id`, `id_sali`, `id_nauczyciela`, `id_przedmiotu`) VALUES (NULL, '".$idSali."', '".$idNauczyciela."', '".$idPrzedmiotu."')";

                $dodLekcjeSzablonDrugi = ",(NULL, '".$idSali."', '".$idNauczyciela."', '".$idPrzedmiotu."')";

                if ($sqlTLekcja == "") {
                    $sqlTLekcja = $dodLekcjeSzablonGlowny;
                } else {
                    $sqlTLekcja .= $dodLekcjeSzablonDrugi;
                }
            }
        }
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
            // echo "<pre>IDS LEKCJI".var_dump($idsLekcji)."</pre>";
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

            // if ($lastAddedDay == $idDniaTyg) {//didnt change
            //     echo "<p>Znowu to samo </p>";
            // } 
            $PrzypLekGlowny = "INSERT INTO `przyporzadkowanie_lekcji` (`id`, `nr_lekcji`, `id_dnia_tyg`, `id_lekcji`) VALUES (NULL, '".$nrLekcji."', '".$idDniaTyg."', '".$idLekcji."')"; 
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
        // if (false){
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

            $sqlPlanLekcji = "INSERT INTO `plan_lekcji` (`id`) VALUES (NULL)";
            $sqlLekcjePlanu="";
            if (mysqli_query($conn, $sqlPlanLekcji)) {
                $idPlanuLekcji = mysqli_insert_id($conn);
                foreach ($idsPrzyporzadkowanejLekcji as $el) {
                    global $idPlanuLekcji;
                    if ($sqlLekcjePlanu == "") {
                        $sqlLekcjePlanu = "INSERT INTO `lekcje_planu` (`id`, `id_planu_lekcji`, `id_przyporzadkowanej_lekcji`) VALUES (NULL, '$idPlanuLekcji', '$el')";
                    } else {
                        $sqlLekcjePlanu .= ",(NULL, '$idPlanuLekcji', '$el')";
                    }
                }
                echo "<h1>$sqlLeckcjePlanu</h1>";
                if (mysqli_multi_query($conn,$sqlLekcjePlanu)) {
                    // if (false){
                        echo "<div class='infZwrotna top'>";
                    echo "<p>GOTOWE</p>";
                    echo "<p>Udało Ci się storzyć nowy plan lekcji!</p>";
                    echo "<a class='button' href='pokazNPlan.php?nowyPlan=".$idPlanuLekcji."' >Zobacz twój nowo stworzony plan tutaj</a>
                    <a href='index.php'><button>OK</button></a>
                    ";
                    echo "</div>";
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