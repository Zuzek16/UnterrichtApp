<?php
function addheader ($includeIndexLink = true) {
   echo "<header>
     <nav>
          <ul>
               <li><a href='szkola.php?edit=false'>Szkoły</a></li>
               <li><a href='nau.php?edit=false'>Nauczyciele</a></li>
               <li><a href='klasy.php'>Klasy</a></li>
          </ul>";
          if ($includeIndexLink) {
               echo "<ul>
               <li><a href='index.php'><img class='icon'  src='zdj/bialy_dom.png' alt='ikona białego domu'></a></li>
          </ul>";
          } else {
               echo "<ul>
               <li><a href='tworzPlan.php'><img class='icon' src='zdj/plus.png' alt='plus'></a></li>
          </ul>";
          }
          echo "<ul>
               <li><a href='kontakt.php'>Kontakt</a></li>
               <li><a href='choosePlan.php'>Plany lekcji</a></li>
               <li><a href='dodPrzed.php'>Przedmioty</a></li>
          </ul>
     </nav>
</header>";
if ($includeIndexLink) {
     echo "<a id='toggle' class='toggle indexBtn' href='index.php'>Strona główna</a>";
} else {
     echo "<a id='toggle' class='toggle indexBtn' href='tworzPlan.php'>Twórz plan</a>";
}
}

function addFooter($startC = "", $endC = "") {
     echo "<footer>";
     echo $startC;
     echo "<p>UnterrichtApp - Autor: Zuzanna Zych 2024</p>";
     echo $endC;
     echo "</footer>";
}

function isSelected($inputName, $value, $planLekcji = false) {
     if ($planLekcji) {
              $postKey = $inputName;
              $postKey = (explode("]",$postKey));
              $postKey = (implode("",$postKey));
              $postKey = (explode("[",$postKey));
  
              if (isset($_POST[$postKey[0]][$postKey[1]][$postKey[2]]) && $_POST[$postKey[0]][$postKey[1]][$postKey[2]] == $value) {
               return "selected";
              }
     } else {
          if(isset($_POST[$inputName]) && $_POST[$inputName] == $value) {
               return "selected";
          } 
     }
}
?>