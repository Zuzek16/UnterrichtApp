<?php
global $conn;
$r_Sala = mysqli_query($conn, "SELECT * from sala");
$sala = [];
while ($row = mysqli_fetch_assoc($r_Sala)) array_push($sala, $row);

$r_przedmiot = mysqli_query($conn, "SELECT * from przedmiot");
$przedmiot = [];
while ($row = mysqli_fetch_assoc($r_przedmiot)) array_push($przedmiot, $row);

$r_dzien_tygodnia = mysqli_query($conn, "SELECT * from dzien_tygodnia");
$dzien_tygodnia = [];
while ($row = mysqli_fetch_assoc($r_dzien_tygodnia)) {
      global $dzien_tygodnia;
      $dzien_tygodnia[$row['nazwa']] = $row['id'];
}
      
$sqlSzkola = "SELECT * FROM szkola";
$r_szkola = mysqli_query($conn, $sqlSzkola);

$klasaSzkoly = [];//budowa - nazwa szkoly => [idklasy, nazwaklasy]
while ($rowSz = mysqli_fetch_assoc($r_szkola)) {
      $klasaSzkoly[$rowSz['nazwa']] = [];
      $klasaSzkoly[$rowSz['nazwa']]['idSzkoly'] = $rowSz['id']; 
      $sqlKlasa = 'SELECT szkola.id AS "idSzkoly", szkola.nazwa AS "nazwaSzkoly", klasa.id AS "idKlasy", klasa.nazwa AS "nazwaKlasy", klasa.id_planu_lekcji from szkola INNER JOIN klasa ON klasa.id_szkola = szkola.id WHERE szkola.nazwa = "'.$rowSz['nazwa'].'";';
      $r_klasa = mysqli_query($conn, $sqlKlasa);
      while ($rowK = mysqli_fetch_assoc($r_klasa)) {
            array_push($klasaSzkoly[$rowSz['nazwa']], [$rowK['idKlasy'], $rowK['nazwaKlasy']]);
      }
}

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

$nauczyciele = [];
$sql = "SELECT * from nauczyciel";
$r = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($r)) {
      array_push($nauczyciele, $row);
}

$przedmiotSelectIds = [];
$nauczycielSelectIds = [];
$salaSelectIds = [];

function lekcjaInput($licznikLekcji, $dzien){
      global $przedmiot;
      global $sala;
      global $przedmiotSelectIds;
      global $nauczycielSelectIds;
      global $salaSelectIds;

      $przedmiotName = $dzien."[".$licznikLekcji."]"."[przedmiot]";
      $nauczycielName = $dzien."[".$licznikLekcji."]"."[nauczyciel]";
      $salaName = $dzien."[".$licznikLekcji."]"."[sala]";

      array_push($przedmiotSelectIds, $przedmiotName);
      array_push($nauczycielSelectIds, $nauczycielName);
      array_push($salaSelectIds, $salaName);

      echo '<select name='.$przedmiotName.'>';
      echo '<option value="">Wybierz przedmiot</option>';
      foreach ($przedmiot as $el) {
            echo '<option value="'.$el['nazwa'].'">'.$el['nazwa'].'</option>';
            // echo '<option value="'.$el['nazwa'].'"selected>'.$el['nazwa'].'</option>';//DEBUG
      }
  echo "</select>
      <br>
      <select name=$salaName>
      <option value=''>Wybierz salę</option>
      ";
      foreach ($sala as $el) {
            echo '<option value="'.$el['numer'].'">'.$el['numer'].'</option>';
            // echo '<option value="'.$el['numer'].'"selected>'.$el['numer'].'</option>';//DEBUG
      }

  echo "</select><br    >";
  
  echo '<select name='.$nauczycielName.' class="nauczyciel"></select>';
};

function defAddLekcjaTd($id, $dzien){
      global $przedmiot;//! add global often
      global $sala;
      global $licznikPIL;
      $selectPrzedmiotId = "przedmiot".$dzien.$id;
      $przedmiotInputList[$licznikPIL] = $selectPrzedmiotId;
      $licznikPIL++;

      $selectSalaId = "sala".$dzien.$id;
      $selectNauId = "nauczyciel".$dzien.$id;

      echo '<form action="" method="post">
      <label for="'.$selectPrzedmiotId.'">Przedmiot</label>
      <select name="'.$selectPrzedmiotId.'" id="'.$selectPrzedmiotId.'">';
      echo "<option value=''>Wybierz</option>"; 
      if (isset($_POST[$selectPrzedmiotId])) {
            foreach($przedmiot as $el){
                  if ($_POST[$selectPrzedmiotId] == $el['nazwa']) {
                        echo "<option value='".$el['nazwa']."'selected>".$el['nazwa']."</option>";
                  } else {
                        echo "<option value='".$el['nazwa']."'>".$el['nazwa']."</option>";
                  }
            }
      
    } else {
      foreach($przedmiot as $el){
            echo "<option value='".$el['nazwa']."'>".$el['nazwa']."</option>";
      }
    }    
      if (isset($_POST[$selectPrzedmiotId]) ) {
            if ($_POST[$selectPrzedmiotId] != "") {
                  echo "<p>Wybrany przedmiot - ".$_POST[$selectPrzedmiotId]."</p>";
                  echo  '<form action="" method="post">
                  <label for="'.$selectNauId.'">Nauczyciel: </label>
                  <select name="'.$selectNauId.'" id="'.$selectNauId.'">';
                  foreach (nauczycieleKtorzyUcza($_POST[$selectPrzedmiotId]) as $nau) {
                        echo "<option value='$nau'>".$nau."</option>";
                        }
                  echo '</select>
                  <label for="'.$selectSalaId.'">Sala</label>
                     <select name="'.$selectSalaId.'" id="'.$selectSalaId.'">';
                     foreach ($sala as $elSala) {
                        echo "<option value='".$elSala['numer']."'>".$elSala['numer']."</option>";
                        }
                  echo '</select>
                  <button type="submit">Zapisz lekcję</button>
                  </form>';
            }
      }

      if (isset($_POST[$selectSalaId]) && isset($_POST[$selectNauId]) ) {
            if (($_POST[$selectSalaId] == "") &&
            ($_POST[$selectNauId]) == "") {
                  # code...
            } else {
                  //normalnie, czyli dodajemy do tablicy że to jest już gotowe i jak wszytkie sa gotowe to finish (puste lekcje moga byc tylko na koncu a nie w środku)
            }
      }
};
?>