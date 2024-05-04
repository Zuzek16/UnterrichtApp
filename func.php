<?php
function addheader () {
   echo "<header>
     <nav>
          <ul>
               <li><a href='szkola.php?edit=true'>Szkoły</a></li>
               <li><a href='ucz.php?szuk=nauczyciele'>Nauczyciele</a></li>
               <li><a href='ucz.php?szuk=klasy'>Klasy</a></li>
          </ul>
          <ul>
               <li><a href='tworzPlan.php'><img src='zdj/plus.png' alt=''></a></li>
          </ul>
          <ul>
               <li><a href='edycjaPlan.php'>Edytuj plan</a></li>
               <li><a href='dodNau.php'>Dodaj nauczyciela</a></li>
               <li><a href='dodNau.php'>Przełącz szkole</a></li>
          </ul>
     </nav>
</header>    ";
}
?>