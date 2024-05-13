<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>UnterrichtApp</title>
     <link rel="stylesheet" href="styl.css">
     <link rel="icon" type="image/x-icon" href="/zdj/UnterrichtAppLOGO.png">
     <!--
          -add edit to teachers and plan leckji
          get to responsivity 
          try to make createing the timetable responsive
     -!failsafe so that someone doesnt add a timetable for a school with teachers that dont teach there
     -skip-link on other pages
          -jeśli input przedmiot jest pusty to nie dodajemy lekcji
          -plan lekcji dodaje się do szkoły!
      -->
     </head>
     <body>
          <!-- NO SKIP-LINK -->
     <?php
     include_once ("func.php");
     addheader(false);
     ?>
<div class="main-bg">
     <div class="main">
          <div class="wstep">
          <h2>Nowoczesna aplikacja do tworzenia oraz zarządania planami lekcji twojej szkoły!</h2>
          <p>I nie tylko...</p>
          <h3 class="title">UnterrichtApp</h3>
          </div>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, odit ducimus voluptate libero eius aperiam vero animi quasi. Ipsam illo, possimus iste hic aliquid commodi provident omnis eos at cum!</p>
          <h1>Użyte technologie</h1>
          <p>Przy użyciu połączenia klasycznych technologi, PHP oraz baz danych mySQL, stworzyłam aplikaję internetową, która ma za zamiar w przystępny sposób pozwolić Tobie tworzyć i zarządzać planami lekcji.
          PHP pozwala na niemalże natychmiastowe połączenia z bazą danych. A zapytania języka mySQL umożliwa na dokładne wyszukiwanie danych oraz ich jednoczesne sortowanie i filtrowanie.</p>
          <h1>Najważniejsze czynności na wyciągnięcie ręki</h1>
          <p>Łatwo i szybko zapisuj nauczycieli wraz z ich zakresem nauczania. Stworzone w aplikacji plany lekcji przypisuj klasom. Używaj stworzone już wcześniej plany dla oszczędzenia Twojego cennego czasu. Masz więcej na głowie? Spokojnie! Możesz w jednej aplikacji zarządzać wszytkimi swoimi zarządanymi szkołami bez opóźnień.</p>
     </div>
</div>
<?php
include "conn.php";
addFooter($connInfo, "zzych22@zs1.nowotarski.edu.pl");
?>
</body>
</html>