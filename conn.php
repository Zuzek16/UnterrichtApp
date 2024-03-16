<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Łączenie...</title>
</head>
<body>
     <?php
     $user = "root";
     $pass = "";
     $db = "plan_lekcji";
     $host = "localhost";
     

     $conn = mysqli_connect($host, $user, $pass, $db);

     if ($conn) {
          echo "Połączenie powiodło się\n";
     } else {
          echo "Błąd połączenia: ". mysqli_connect_error();
     }
     ?>
</body>
</html>