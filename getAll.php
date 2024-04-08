<?php
function nauczycieleKtorzyUcza($przedmiot){
     global $conn;//!! czasami nie widzi połączenia
     //[przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko]
     // $sql = "SELECT przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko FROM nauczany_przedmiot INNER JOIN nauczyciel ON nauczany_przedmiot.id_nauczyciela = nauczyciel.id INNER JOIN przedmiot ON nauczany_przedmiot.id_przedmiotu = przedmiot.id WHERE przedmiot.nazwa ='".$_POST['przedmiot']."';";
     $sql = "SELECT przedmiot.nazwa, nauczyciel.imie, nauczyciel.nazwisko FROM nauczany_przedmiot INNER JOIN nauczyciel ON nauczany_przedmiot.id_nauczyciela = nauczyciel.id INNER JOIN przedmiot ON nauczany_przedmiot.id_przedmiotu = przedmiot.id WHERE przedmiot.nazwa ='".$przedmiot."'";
     $result = mysqli_query($conn, $sql);
     $tabN = [];
     while ($row = mysqli_fetch_assoc($result)) {
           array_push($tabN, $row['imie']." ".$row['nazwisko']);
     }
     return $tabN;
}

$r_Sala = mysqli_query($conn, "SELECT * from sala");
$sala = [];
while ($row = mysqli_fetch_assoc($r_Sala)) array_push($sala, $row);

$r_przedmiot = mysqli_query($conn, "SELECT * from przedmiot");
$przedmiot = [];
while ($row = mysqli_fetch_assoc($r_przedmiot)) array_push($przedmiot, $row);

// $r_nauczyciel = mysqli_query($conn, "SELECT * from nauczyciel");
// $nauczyciel = [];
// while ($row = mysqli_fetch_assoc($r_nauczyciel)) array_push($nauczyciel, $row);

// $r_nauczany_przedmiot = mysqli_query($conn, "SELECT * from nauczany_przedmiot");
// $nauczany_przedmiot = [];
// while ($row = mysqli_fetch_assoc($r_nauczany_przedmiot)) array_push($nauczany_przedmiot, $row);

$ponLekcjeFormularzGotowy = [];//might need to give this to the url so JS can read it 
//save the info to somevhere and read it instad of relying on post (like cookies/session/get)
$wtLekcjeFormularzGotowy = [];
$srLekcjeFormularzGotowy = [];
$czwLekcjeFormularzGotowy = [];
$ptLekcjeFormularzGotowy = [];

function lekcjaInput($licznikLekcji, $dzien){//mabye add id's to inputs
      global $przedmiot;
      global $sala;

      $przedmiotName = $dzien."[".$licznikLekcji."]"."[przedmiot]";
      $nauczycielName = $dzien."[".$licznikLekcji."]"."[nauczyciel]";
      $salaName = $dzien."[".$licznikLekcji."]"."[sala]";

      echo '<select name='.$przedmiotName.'>';
      echo '<option value="">Wybierz przedmiot</option>';
      foreach ($przedmiot as $el) {
            echo '<option value="'.$el['nazwa'].'">'.$el['nazwa'].'</option>';
      }
  echo "</select>
      <select name=$salaName>
      <option value=''>Wybierz salę</option>
      ";
      foreach ($sala as $el) {
            echo '<option value="'.$el['numer'].'">'.$el['numer'].'</option>';
      }

  echo "</select>";
  

  echo '<select name='.$nauczycielName.' class="nauczyciel"></select>';
};



function defAddLekcjaTd($id, $dzien){
      global $przedmiot;//! add global often
      global $sala;
      global $licznikPIL;
      $selectPrzedmiotId = "przedmiot".$dzien.$id;
      $przedmiotInputList[$licznikPIL] = $selectPrzedmiotId;
      $licznikPIL++;
      // if ($przedmiotInputList == NULL) {
            
      // }
      // // $przedmiotInputList[] += $selectPrzedmiotId;
      // array_push($przedmiotInputList, $selectPrzedmiotId);

      $selectSalaId = "sala".$dzien.$id;
      $selectNauId = "nauczyciel".$dzien.$id;
      // $postPrzedmiot

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
            //if this ends up not working as intended then scrap this and make the user input everyting without hints
            // echo "<p>Wybrany przedmiot - ".$_POST['przedmiot']."</p>";
            if ($_POST[$selectPrzedmiotId] != "") {
                  echo "<p>Wybrany przedmiot - ".$_POST[$selectPrzedmiotId]."</p>";

                  echo  '<form action="" method="post">
                  <label for="'.$selectNauId.'">Nauczyciel: </label>
                  <select name="'.$selectNauId.'" id="'.$selectNauId.'">';
      
                  //! add an empty option to each
      
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
            } else {
            //?do we need anythung here?
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