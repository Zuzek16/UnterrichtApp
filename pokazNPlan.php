<?php
if (isset($_GET['nowyPlan'])) {
     # we show the new bad boy
} else {
     echo '<p>Nie ma nowych planów lekcji,<a href="tworzPlan.php"> stwórz go teraz</a>!</p>';
}
?>