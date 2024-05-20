<!DOCTYPE html>
<html lang="pl">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edycja planu lekcji</title>
     <link rel="stylesheet" href="styl.css">
</head>
<body>
     <?php
    include "conn.php";
    include_once "func.php";
    include_once "getAll.php";
    addheader();
    ?>

<div class="lewy">
<h2 class="pageFunc">Napisz do nas</h2>


<p class="contact">
     <a href="mailto:zzych22@zs1.nowotarski.edu.pl">E-mail: zzych22@zs1.nowotarski.edu.pl</a>
</p>

<p>
     <a href="tel:+48 000 000 000">Telefon: +48 000 000 000</a>
</p>


</div>
<div class="prawy last">
<h2 class="pageFunc">Zachęcamy do dzielenia się opiniami</h2>
<img src="zdj/dyrektor.jpeg" alt="zdjęcie symboliczne dyrektora szkoły">

</div>

<?php addFooter();?>
</body>
</html>