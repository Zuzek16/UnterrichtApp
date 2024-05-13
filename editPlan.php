<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edycja planu lekcji</title>
     <link rel="stylesheet" href="styl.css">

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
<p>Zmień przedmiot aby zobaczyć resztę nauczycieli</p>
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
            lekcjaInput($i, $dzien, true,  getDanePlanLekcji($_GET['id']));
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

<?php addFooter();?>
</body>
</html>