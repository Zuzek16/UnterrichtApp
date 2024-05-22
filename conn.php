<?php
     $user = "root";
     $pass = "";
     $db = "plan_lekcji";
     $host = "localhost";
     $conn = mysqli_connect($host, $user, $pass, $db);
     $connInfo;
     $connected;
     if ($conn) {
          $connected = true;
          $connInfo = "<p class='conn'>Połączenie z bazą danych powiodło się\n</p>";
     } else {
          $connected = false;
          $connInfo = "<p class='conn'>Błąd połączenia: ". mysqli_connect_error()."</p>";
     }
?>