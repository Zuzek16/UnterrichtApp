<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>UnterrichtApp</title>
     <link rel="stylesheet" href="styl.css">
     <link rel="icon" type="image/x-icon" href="/zdj/UnterrichtAppLOGO.png">
     <!--
          -add edit to teachers
          get to responsivity 
     -skip-link on other pages
          -jeśli input przedmiot jest pusty to nie dodajemy lekcji
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
          <h1>Użyte technologie</h1>
          <p>Przy użyciu połączenia klasycznych technologi, PHP oraz baz danych mySQL, stworzyłam aplikaję internetową, która ma za zamiar w przystępny sposób pozwolić Tobie tworzyć i zarządzać planami lekcji.
          PHP pozwala na niemalże natychmiastowe połączenia z bazą danych. A zapytania języka mySQL umożliwa na dokładne wyszukiwanie danych oraz ich jednoczesne sortowanie i filtrowanie.</p>
          <h1>Najważniejsze czynności na wyciągnięcie ręki</h1>
          <p>Łatwo i szybko zapisuj nauczycieli wraz z ich zakresem nauczania. Stworzone w aplikacji plany lekcji przypisuj klasom. Używaj stworzone już wcześniej plany dla oszczędzenia Twojego cennego czasu. Masz więcej na głowie? Spokojnie! Możesz w jednej aplikacji zarządzać wszytkimi swoimi zarządanymi szkołami bez opóźnień.</p>
          <p class='email mobile'>Email kontaktowy - zzych22@zs1.nowotarski.edu.pl</p>
     </div>
</div>
<?php
include "conn.php";
addFooter($connInfo, "<p class='email'>zzych22@zs1.nowotarski.edu.pl</p>");
?>
</body>
</html>