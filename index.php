<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>UnterrichtApp</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
<header>
     <p>Szybkie akcje</p>
     <nav>
          <ul>
               <li><a href="ucz.php?szuk=nau">Nauczyciele</a></li>
               <li><a href="ucz.php?szuk=klasy">Klasy</a></li>
          </ul>
          <ul>
               <li><a href="tworzPlan.php"><img src="zdj/plus.png" alt=""></a></li>
          </ul>
          <ul>
               <li><a href="edycjaPlan.php">Edytuj plan</a></li>
               <li><a href="dodNau.php">Dodaj nauczyciela</a></li>
          </ul>
          <!-- <ul>
               <li><a href=""></a></li>
               <li><a href=""></a></li>
               <li><a href=""></a></li>
               <li><a href=""></a></li>
               <li><a href=""></a></li>
          </ul> -->
     </nav>
</header>
<div class="main-bg">

     <div class="main">
          
          <h3>Aplikacja do tworzenia i zarządania planami lekcji twojej szkoły!</h3>
          <h2>UnterrichtApp</h2>
          
     </div>
</div>
     
     <footer>


     <?php
     include("conn.php");
     ?>


     <p>Autor: Zuzanna Zych 2024</p>
     

    

     </footer>
</body>
</html>