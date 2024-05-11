<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Dodawanie przedmiotu</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <a class="skip-link" href="#nazwa">Przejdź do głównej treści</a>
          <?php include_once ("func.php");
          addheader();?>
<div class="lewy">
<h2 class="pageFunc">Dodawanie przedmiotu</h2>
<form action="#" method="POST">
    <label for="nazwa">Nazwa nowego przedmiotu:</label>
    <input type="text" name="nazwa" id="nazwa" required>
    <button type="submit">Dodaj</button>
</form>
     <?php
     include "conn.php";
     if (isset($_POST['nazwa']) && trim($_POST['nazwa']) != "") {
     $sql = "INSERT INTO `przedmiot` (`id`, `nazwa`) VALUES (NULL, '".$_POST['nazwa']."')";
     if (mysqli_query($conn, $sql)) {
          echo "<p class='infZwrotna'>Pomyślnie dodano nowy przedmiot.</p>";
        } else {
            echo "<p class='infZwrotna'>Nie udało się dodać przedmiotu.</p>";
        }
     }
     ?>
</div>
<div class="prawy">
<table>
     <tr>
          <th>ID</th>
          <th>nazwa</th>
     </tr>
     <?php
     include_once "getAll.php";
     foreach ($przedmiot as $key => $value) {
          echo "<tr>";
          echo "<td>".$value['id']."</td>";
          echo "<td>".$value['nazwa']."</td>";
          echo "<td> <a class='btn' href='usuPrzed.php?id=".$value['id']."'>usuń</a></td>";
          echo "</tr>";
     }
     ?>
</table>
</div>
</body>
</html>