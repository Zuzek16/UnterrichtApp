<?php
     $user = "root";
     $pass = "";
     $db = "plan_lekcji";
     $host = "localhost";
     
     $conn = mysqli_connect($host, $user, $pass, $db);

     if ($conn) {
          echo "<p class='conn'>Połączenie powiodło się\n</p>";
     } else {
          echo "<p class='conn'>Błąd połączenia: ". mysqli_connect_error()."</p>";
     }
?>