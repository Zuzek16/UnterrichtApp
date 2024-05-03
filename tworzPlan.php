<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnterrichtApp - kreator</title>
    <link rel="stylesheet" href="styl.css">
    <?php
    include "conn.php";
    include('getAll.php');
    global $conn;

    $nauczany_przedmiot = [];//add a message for when its empty

foreach ($przedmiot as $el) {
    $nauczany_przedmiot[$el['nazwa']] = [];

    //nauczyciel
    $sql = "SELECT przedmiot.nazwa, nauczyciel.id, nauczyciel.imie, nauczyciel.nazwisko FROM nauczany_przedmiot INNER JOIN nauczyciel ON nauczany_przedmiot.id_nauczyciela = nauczyciel.id INNER JOIN przedmiot ON nauczany_przedmiot.id_przedmiotu = przedmiot.id WHERE przedmiot.nazwa ='".$el['nazwa']."'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
          array_push($nauczany_przedmiot[$el['nazwa']], [$row['id'],$row['imie']." ".$row['nazwisko']]);
    }
}
    ?>
    <script>
        var nauczany_przedmiot = <?php echo json_encode($nauczany_przedmiot); ?>;

        //make a get global variable here that php can read and add an if inside the form so that it stays the same
        //css query
let x = window.matchMedia("(max-width: 700px)");
let desktop;
let y = 1;
let n = 0;

// Call listener function at run time
if (!x.matches) { // If media query matches
    desktop = y;
    // document.getElementById('calosc').className = "desktop";
  } else {
    desktop = n;

    // document.body.style.backgroundColor = "pink";
  }

// Attach listener function on state changes
x.addEventListener("change", function() {
    if (!x.matches) { // If media query matches
        desktop = y;
  } else {
    desktop = n;
  }

}); 

    </script>
</head>
<body>
<?php
ob_start();
echo "<script>document.writeln(desktop);</script>";
$desktopMode = ob_get_clean();//cant check it - no proper type fix this for line 148 to work
// echo $desktopMode;
var_dump(substr($desktopMode, 8));
var_dump(($desktopMode));
var_dump(((string)$desktopMode));
var_dump(((bool)$desktopMode));
var_dump(((int)$desktopMode));
var_dump(str_contains($desktopMode, "0"));
var_dump(str_contains($desktopMode, "1 "));

include_once ("func.php");
addheader();
?>

<h2>Tworzenie planu</h2>

<?php
$sql = "SELECT * from szkola";
$wynik = mysqli_query($conn, $sql);
$tab = [];

while ($row = mysqli_fetch_assoc($wynik)) {
    array_push($tab, $row);
}

if ($tab == NULL) {
    echo "<p>Nie ma żadnej szkoły!</p>
    <p><a href=szkola.php>Dodaj ją</a></p>";
} else {
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
    if (isset($_POST['szkolaAktyw'])) {
        echo "<p>Wybrana szkoła: ".($_POST['szkolaAktyw'])."</p>";
    } else {
        echo "<p>Proszę wybrać szkołę</p>";
    }
    ?>
</p>
<!-- only if school is set -->
<form action="" method="post">
    <label for="klasaAktyw">Dla ktorej klasy chcesz zrobić plan?</label>
    <select name="klasaAktyw" id="klasaAktyw">
        <?php
        foreach($klasaSzkoly as $szkola => $value1){
            //TYLKO dla aktywnej szkoły!!!
            //tak samo jak nauczycieli

            foreach ($klasaSzkoly[$szkola] as $key => $value2) {
            echo "<option value='".$value2[1]."'>".$value2[1]."</option>";
            }
        }
        ?>
    </select>
    <button type="submit">Zatwierdź</button>
</form>

<p>
    <?php
    if (isset($_POST['klasaAktyw'])) {
        echo "<p>Wybrana szkoła: ".($_POST['klasaAktyw'])."</p>";
    } else {
        echo "<p>Proszę wybrać szkołę</p>";
    }
    var_dump($desktopMode);
    ?>
</p>
<h5>Wskazówka: Jeśli potrzebujesz mieć mniej lekcji w danym dniu ostatnie z opcji pozostaw puste [WIP]</h3>
<div class="tableContainer">
    <div class="mobile">

    </div>
    
<form action="#" method="post">
    <table class="calosc" id="calosc">
    <?php
    if (str_contains($desktopMode, "true")) {//problem here
        echo "<tr>
        <th>Pon</th>
        <th>Wt</th>
        <th>Śr</th>
        <th>Czw</th>
        <th>Pt</th>
    </tr>";
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
            echo "<td>";
            lekcjaInput($i, $dzien);
            echo "</td>";
        }
       echo "</tr>";
    }
    echo "<tr class='desktop'>
    <td colspan=5>
    <button class='desktop' type='submit'>Zapisz</button>
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
            <th>$dzien</th>
            </tr>";
            for ($i=0; $i < 6; $i++) { 
                # code...
                echo "<tr>";
                echo "<td>";
                lekcjaInput($i, $dzien);
                echo "</td>";
                echo "</tr>";

            }
        }
       echo "</tr>";
    }//liczba lekcji
    echo "<tr class='mobile'>
    <td>
    <button class='mobile' type='submit'>Zapisz</button>
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
    let allSelect = document.querySelectorAll("select");

    allSelect.forEach(el => {
        el.addEventListener('change', ()=>{
            console.log(el.value);
            let form = '';
            nauczany_przedmiot[`${el.value}`].forEach(el => {
               form += `<option value="${el[0]}" >${el[1]}</option>`;
                // form += `<option value="${el[0]}" selected>${el[1]}</option>`;//DEBUG
            });
            el.parentElement.querySelector('.nauczyciel').innerHTML = form;
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
                                //JEŚLI PRZEDMIOT NULL TO NIE DODAJEMY!
                                //można zrobić bez spr czy jest po kolei żeby tylko przeskoczyło samo
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
            
            // var_dump($dzien_tygodnia);
            //$dzien_tygodnia['poniedziałek']
            $idDniaTyg = $dzien_tygodnia[$selectEl[0]];
            
           //
            // foreach ($dzien_tygodnia as $value) {//!!
            //     if ($value['nazwa'] == $selectEl[0]) {
            //         $idDniaTyg = $value['id'];//this is funky - pon twice at start
            //     }
            // }
           
            $nrLekcji = $selectEl[1];
            $idLekcji = $idsLekcji[$idLekcjiCounter];

            //

            if ($lastAddedDay == $idDniaTyg) {//didnt change
                echo "<p>Znowu to samo </p>";
            } 

            //

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

        // var_dump($sqlTPrzypLek);

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
                    // $idPrzyporzadkowanejLekcji = $el;
                    global $idPlanuLekcji;
    
                    if ($sqlLekcjePlanu == "") {
                        $sqlLekcjePlanu = "INSERT INTO `lekcje_planu` (`id`, `id_planu_lekcji`, `id_przyporzadkowanej_lekcji`) VALUES (NULL, '$idPlanuLekcji', '$el')";
                    } else {
                        $sqlLekcjePlanu .= ",(NULL, '$idPlanuLekcji', '$el')";
                    }
                }
                if ( mysqli_multi_query($conn,$sqlLekcjePlanu)) {
                    // if (false){
                    echo "||||||                |||||GOTOWE";
                    echo "Udało Ci się storzyć nowy plan lekcji!";
                    echo "<p>Przypisać go klasie?</p>
                    <button class ='odpY'><a href='edycjaPlan.php'>TAK</a></button>/ 
                    <button class ='odpN'>NIE</button>
                    <br><br><a class='button' href='pokazNPlan.php?nowyPlan=".$idPlanuLekcji."' >Zobacz twój nowo stworzony plan tutaj</a>
                    ";
                    //tutaj dać dwa przyciśki jesli tak to wyświetlamy formularz a jak nie to przenosimy na index.php
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
</body>
</html>