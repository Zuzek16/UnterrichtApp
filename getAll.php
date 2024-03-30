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

$r_nauczyciel = mysqli_query($conn, "SELECT * from nauczyciel");
$nauczyciel = [];
while ($row = mysqli_fetch_assoc($r_nauczyciel)) array_push($nauczyciel, $row);

$r_nauczany_przedmiot = mysqli_query($conn, "SELECT * from nauczany_przedmiot");
$nauczany_przedmiot = [];
while ($row = mysqli_fetch_assoc($r_nauczany_przedmiot)) array_push($nauczany_przedmiot, $row);

function defAddLekcjaTd($id, $dzien){
      global $przedmiot;
      // $dzien;

      echo "zawartość do dodawania";
      echo '<form action="" method="get">
      <label for="przedmiot">Przedmiot</label>
      <select name="przedmiot" id="przedmiot">';
      //$id bedzie podawane przez  $j i $i (iterator) np. przedmiotpon(czyli 0)4)(piąta lekcja bo od 0) i to wkładamy do id i name select żeby każdy dało sie rozóżnić
      //wtedy dynamicznie również można tworzyć if ????? można każdy do tablicy dodawać i na niej patrzej po każdym (OBIEKTÓWKA zachęca wowowo)
    
      // include('getAll.php');
      foreach($przedmiot as $el){echo "<option value='".$el['nazwa']."'>".$el['nazwa']."</option>";}

      echo '</select><button type="submit">Zatwierdź</button></form>';
};
?>