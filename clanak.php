<?php

include 'connect.php';

$id = $_GET['id'];

$query = "SELECT * FROM vijesti WHERE ID=$id";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['naslov']; ?></title>
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

<main class="product">

<section>

<p><?php echo $row['kategorija']; ?></p>

<h2><?php echo $row['naslov']; ?></h2>

<p>Objavljeno: <?php echo $row['datum']; ?></p>

<br>

<img src="images/<?php echo $row['slika']; ?>" alt="<?php echo $row['naslov']; ?>">

<br><br>

<p><strong><?php echo $row['sazetak']; ?></strong></p>

<br>

<p><?php echo $row['tekst']; ?></p>

</section>

</main>

<footer id="footer">

<p>Luka Mršić</p>
<p>lmrsic1@tvz.hr</p>
<p>2026.</p>

</footer>

</body>
</html>