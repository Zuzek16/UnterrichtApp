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
     <!-- <p>Szybkie akcje</p> -->
     <nav>
          <ul>
               <li><a href="szkola.php">Szkoły</a></li>
               <li><a href="ucz.php?szuk=nauczyciele">Nauczyciele</a></li>
               <li><a href="ucz.php?szuk=klasy">Klasy</a></li>
          </ul>
          <ul>
               <li><a href="tworzPlan.php"><img src="zdj/plus.png" alt=""></a></li>
          </ul>
          <ul>
               <li><a href="edycjaPlan.php">Edytuj plan</a></li>
               <li><a href="dodNau.php">Dodaj nauczyciela</a></li>
               <li><a href="dodNau.php">Przełącz szkole</a></li>
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
          
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, odit ducimus voluptate libero eius aperiam vero animi quasi. Ipsam illo, possimus iste hic aliquid commodi provident omnis eos at cum!</p>
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