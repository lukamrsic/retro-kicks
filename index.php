<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retro Kicks Archive</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>RETRO KICKS</h1>
    <p>Legende koje nikad ne izlaze iz mode</p>
</header>

<nav>
    <a href="index.php">Početna</a>
    <a href="kategorija.php?id=Retro">Retro</a>
    <a href="kategorija.php?id=Basketball">Basketball</a>
    <a href="unos.html">Unos</a>
    <a href="administrator.php">Administracija</a>
</nav>

<main>

<section class="hero">
    <h2>Retro tenisice kroz generacije</h2>
</section>

<section id="collection">

<?php

$query = "SELECT * FROM vijesti WHERE arhiva=0 ORDER BY id DESC";
$result = mysqli_query($dbc, $query);

while($row = mysqli_fetch_array($result)){

    echo '<article class="card">';

    if($row["slika"] != ""){
        echo '<img src="images/'.$row["slika"].'" alt="'.$row["naslov"].'">';
    }

    echo '<h2>'.$row["naslov"].'</h2>';
    echo '<p>'.$row["sazetak"].'</p>';
    echo '<a href="clanak.php?id='.$row["ID"].'">Pogledaj više</a>';

    echo '</article>';
}

?>

</section>

</main>

<footer id="footer">

<p>Luka Mršić</p>

<p>lmrsic1@tvz.hr</p>

<p>2026.</p>

</footer>

</body>
</html>