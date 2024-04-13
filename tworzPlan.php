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

    $nauczany_przedmiot = [];

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
        console.log(nauczany_przedmiot);
    </script>
</head>
<body>
<h2>Tworzenie planu</h2>

<?php
$sql = "SELECT * from szkola";//change thus to make an array to use
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
<h5>Wskazówka: Jeśli potrzebujesz mieć mniej lekcji w danym dniu ostatnie z opcji pozostaw puste</h3>
<div class="tableContainer">
<form action="#" method="post">
<table class="calosc">
    <tr>
        <th>Pon</th>
        <th>Wt</th>
        <th>Śr</th>
        <th>Czw</th>
        <th>Pt</th>
    </tr>
    
    <?php
    global $nauczany_przedmiot;
    $licznik = 0;

    for ($i=0; $i < 9; $i++) { 
        echo "<tr>";
        for ($j=0; $j < 5; $j++) {
            $dzien;
            switch ($j) {//shortened?
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
            lekcjaInput($licznik, $dzien);
            echo "</td>";
            $licznik++;
        }
        
       echo "</tr>";
    }
    ?>

<tr class="desktop">
    <td colspan=5>
    <button class='desktop' type='submit'>Zapisz</button>
    </td>
</tr>

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
            $postKey = (explode("]",$postKey));
            $postKey = (implode("",$postKey));
            $postKey = (explode("[",$postKey));

            if (isset($_POST[$postKey[0]][$postKey[1]][$postKey[2]]) && $_POST[$postKey[0]][$postKey[1]][$postKey[2]] != "") {
                array_push($set, true);
            } else {
                array_push($set, false);
            }
        }

        if (in_array(false, $set)) {
            return "false";
        } else {
            return "true";
        }
    }

    global $przedmiotSelectIds;
    global $nauczycielSelectIds;
    global $salaSelectIds;
    echo "<h1>".allset($przedmiotSelectIds)."</h1>";
    echo "<h1>".allset($nauczycielSelectIds)."</h1>";
    echo "<h1>".allset($salaSelectIds)."</h1>";
    echo "<hr>";
    echo "<pre>".var_dump($_POST)."</pre>";
    // echo "<pre>".allset($przedmiotSelectIds)."</pre>";
    echo "<hr>";
    // echo "<pre>".var_dump($_POST['poniedziałek'][0]['przedmiot'])."</pre>";


    // if (allset($przedmiotSelectIds) && allset($nauczycielSelectIds)&& allset($salaSelectIds)) {
        if (true) {

        $idSali;
        $idNauczyciela;
        $idPrzedmiotu;

        $sqlTLekcja = "";//one big query!
        //export db! 

        //tabela 'lekcja' sql
        foreach ($_POST as $dzienTyg => $value) {
            foreach ($_POST[$dzienTyg] as $nrLekcji => $value){
                foreach ($_POST[$dzienTyg][$nrLekcji] as $key => $value){

                    if ($key == "nauczyciel") {
                        
                        $idNauczyciela = $value;
                    } else if ($key == "przedmiot"){
                        foreach ($przedmiot as $val) {
                            // echo $val['id'];
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
                    $sqlTLekcja = $sqlTLekcja.$dodLekcjeSzablonDrugi;
                }

        
                echo "<pre>".var_dump($sqlTLekcja)."</pre>";

            }

           

        }
        

        //sql do tabeli 'przyporzadkowanie_lekcji'
        //id, nr_lekcji, id_dnia_tyg, id_lekcji
       
    }
?>
</body>
</html>