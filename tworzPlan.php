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
<h5>Wskazówka: Jeśli potrzebujesz mieć mniej lekcji w danym dniu ostatnie z opcji pozostaw puste</h3>
<div class="tableContainer">
<form action="#" method="post">
    <!-- whole form -->

<table class="calosc">
    <tr>
        <th>Pon</th>
        <th>Wt</th>
        <th>Śr</th>
        <th>Czw</th>
        <th>Pt</th>
    </tr>
    
    <?php
    //FORMULARZE LEKCJI
    $licznik = 0;
    

    for ($i=0; $i < 9; $i++) { 
        // global $licznik;
        echo "<tr>";
        for ($j=0; $j < 1; $j++) { //ZMIENIĆ NA 5555

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
            lekcjaInput($licznik, $dzien);
            // defAddLekcjaTd($licznik, $dzien);
            echo "</td>";
            $licznik++;
        }
        
       echo "</tr>";
    }
    ?>

    <tr>
    <?php
    for ($i=0; $i < 5; $i++) { 
        echo "<td><button id=wszystLekcje$i>Zatwierdz dzień<button></td>";
    }
    ?>
    </tr>

</table>
</form>

</div>


<?php
}
global $przedmiotInputList;


echo "<h1>Testy</h1>";
echo "<pre>";
var_dump($nauczany_przedmiot);

echo "</pre>";

// echo "<h1>".implode($przedmiotInputList)."</h1>";
echo "<h1>Testy</h1>";

?>
<!-- <script>

    let btns = document.querySelector('button.add');

    btns.forEach(el => {
        el.addEventListener('click', ()=>{
        
        const tr = document.createElement("tr");
        const td = document.createElement("td");
        
        const btn = document.createElement("button");
        btn.innerText = "Dodaj lekcje";
        btn.classList.add("add");
        // btn.addEventListener('click', ()=>{
        //     alert("sus")
        // })
    
        td.appendChild(btn);
        //?
        tr.appendChild(td);
        tr.appendChild(td);
        tr.appendChild(td);
        tr.appendChild(td);
        tr.appendChild(td);
        
        const tableAll = document.querySelector('table.calosc');
        tableAll.appendChild(tr);
    
        })
    });

    document.querySelector('button.add').addEventListener('click', ()=>{
        
    const tr = document.createElement("tr");
    const td = document.createElement("td");
    
    const btn = document.createElement("button");
    btn.innerText = "Dodaj lekcje";
    btn.classList.add("add");
    // btn.addEventListener('click', ()=>{
    //     alert("sus")
    // })

    td.appendChild(btn);
    //?
    tr.appendChild(td);
    tr.appendChild(td);
    tr.appendChild(td);
    tr.appendChild(td);
    tr.appendChild(td);
    
    const tableAll = document.querySelector('table.calosc');
    tableAll.appendChild(tr);

    })
</script> -->
<!--  -->
</body>
</html>