<?php

include 'connect.php';

$title = $_POST['title'] ?? '';
$about = $_POST['about'] ?? '';
$content = $_POST['content'] ?? '';
$category = $_POST['category'] ?? '';
$image = $_FILES['pphoto']['name'] ?? '';

$date = date('d.m.Y.');

if(isset($_POST['archive'])){
    $archive = 1;
}
else{
    $archive = 0;
}

$target = 'images/' . $image;

move_uploaded_file($_FILES['pphoto']['tmp_name'], $target);

$query = "INSERT INTO vijesti
(datum, naslov, sazetak, tekst, slika, kategorija, arhiva)
VALUES
('$date', '$title', '$about', '$content', '$image', '$category', '$archive')";

$result = mysqli_query($dbc, $query);

mysqli_close($dbc);

?>

<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $title; ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>RETRO KICKS</h1>
</header>

<nav>
    <a href="index.php">Početna</a>
    <a href="unos.html">Novi unos</a>
</nav>

<main class="product">

<section>

<p><?php echo $category; ?></p>

<h2><?php echo $title; ?></h2>

<?php
if($image != ''){
    echo "<img src='images/$image' width='400'>";
}
?>

<br><br>

<p><?php echo $about; ?></p>

<br>

<p><?php echo $content; ?></p>

</section>

</main>

<footer>
<p>Retro Kicks Archive</p>
</footer>

</body>
</html>