<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnterrichtApp - kreator</title>
    <link rel="stylesheet" href="styl.css">
    
</head>
<body>
<h2>Tworzenie planu</h2>

<?php
include "conn.php";
//1. pusty szablon planu gdzie dodajemy lekcje poprzez wciśnięcia w td linku który przenośi nas że można dodać

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
<div class="tableContainer">

<table class="calosc">
    <tr>
        <th>Pon</th>
        <th>Wt</th>
        <th>Śr</th>
        <th>Czw</th>
        <th>Pt</th>
    </tr>
    <tr>
        
        <td>
        <?php
        if (isset($_GET['ponL'])) {
            echo "lekcja pierwsza";

        } else {
            echo '<a href="lekcjeDnia.php?dzien=pon">wybierz lekcje</a>';
            
        }
        
        ?>
        <!-- TESTOWY FORMULARZ -->
        <hr>
        <form action="" method="get">
          <label for="przedmiot">Przedmiot</label>
          <select name="przedmiot" id="przedmiot">
          <?php
          include('getAll.php');
          foreach($przedmiot as $el){echo "<option value='".$el['nazwa']."'>".$el['nazwa']."</option>";}
          ?>
          </select>
          <button type="submit">Zatwierdź</button>
     </form>
        <?php
        
        echo "";//lekcje dnia notatka - spróbować na jednej stronie zrobić dodawanie, można pobawić się w include'owanie plików jako funcjie oddzielne żeby było czytlenie
        ?>
        </td>
            
        <td>
          
        <a href="lekcjeDnia.php?dzien=wt">wybierz lekcje</a></td>
        <td>
        </td>
        <td>
        </td>
        <td>
        </td>
    </tr>
    <?php

    $licznik = 0;
    

    for ($i=0; $i < 8; $i++) { 
        echo "<tr>";
        for ($j=0; $j < 1; $j++) { //ZMIENIĆ NA 5555

            $dzien;
            switch ($j) {
                case 0:
                    $dzien = "poniedziałek";
                    break;
                case 1:
                    $dzien = "wtorek";
                    break;//finish tis
            }

            echo "<td>";
            defAddLekcjaTd($licznik, $dzien);
            echo "</td>";
            $licznik++;
        }
        
       echo "</tr>";
    }
    //za każdym jak dodajemy żeby miało to
    // echo "<tr><td><button class='add'>Dodaj lekcje</button></td>
    // <td></td>
    // <td></td>
    // <td></td>
    // <td></td>
    // </tr>";
    
    ?>
</table>
</div>


<?php
}


?>
<script>

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
</script>
<!--  -->
</body>
</html>