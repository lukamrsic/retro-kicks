<?php
session_start();
include 'connect.php';

$uspjesnaPrijava = false;
$admin = false;
$poruka = '';

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: administrator.php");
    exit;
}

if(isset($_POST['prijava'])){

    $username = $_POST['username'];
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT ime, korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);

    if(mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $korisnickoIme, $hashLozinka, $razina);
        mysqli_stmt_fetch($stmt);

        if(mysqli_stmt_num_rows($stmt) > 0 && password_verify($lozinka, $hashLozinka)){

            $_SESSION['username'] = $korisnickoIme;
            $_SESSION['ime'] = $imeKorisnika;
            $_SESSION['razina'] = $razina;

            if($razina == 1){
                $admin = true;
            }else{
                $poruka = "Bok " . $imeKorisnika . "! Uspješno ste prijavljeni, ali niste administrator.";
            }

        }else{
            $poruka = 'Korisnik ne postoji ili lozinka nije ispravna. <a href="registracija.php">Registrirajte se</a>.';
        }
    }
}

if(isset($_SESSION['razina']) && $_SESSION['razina'] == 1){
    $admin = true;
}

if($admin == true){

    if(isset($_POST['delete'])){
        $id = $_POST['id'];

        $sql = "DELETE FROM vijesti WHERE ID = ?";
        $stmt = mysqli_stmt_init($dbc);

        if(mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
        }
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $about = $_POST['about'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $archive = isset($_POST['archive']) ? 1 : 0;

        if($_FILES['pphoto']['name'] != ""){
            $image = $_FILES['pphoto']['name'];
            move_uploaded_file($_FILES['pphoto']['tmp_name'], 'images/'.$image);

            $sql = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, slika=?, kategorija=?, arhiva=? WHERE ID=?";
            $stmt = mysqli_stmt_init($dbc);

            if(mysqli_stmt_prepare($stmt, $sql)){
                mysqli_stmt_bind_param($stmt, "sssssii", $title, $about, $content, $image, $category, $archive, $id);
                mysqli_stmt_execute($stmt);
            }

        }else{

            $sql = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, kategorija=?, arhiva=? WHERE ID=?";
            $stmt = mysqli_stmt_init($dbc);

            if(mysqli_stmt_prepare($stmt, $sql)){
                mysqli_stmt_bind_param($stmt, "ssssii", $title, $about, $content, $category, $archive, $id);
                mysqli_stmt_execute($stmt);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<title>Administracija</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
<h1>RETRO KICKS</h1>
<p>Administracija članaka</p>
</header>

<nav>
<a href="index.php">Početna</a>
<a href="kategorija.php?id=Retro">Retro</a>
<a href="kategorija.php?id=Basketball">Basketball</a>
<a href="unos.html">Unos</a>
<a href="registracija.php">Registracija</a>
<a href="administrator.php">Administracija</a>
</nav>

<main>

<?php
if($admin == true){
?>

<form method="POST" action="administrator.php">
<p>Prijavljeni ste kao administrator: <?php echo $_SESSION['ime']; ?></p>
<button type="submit" name="logout">Odjava</button>
</form>

<?php
$query = "SELECT * FROM vijesti ORDER BY ID DESC";
$result = mysqli_query($dbc, $query);

while($row = mysqli_fetch_array($result)){
?>

<form enctype="multipart/form-data" method="POST" action="administrator.php">

<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">

<p>Naslov</p>
<input type="text" name="title" value="<?php echo $row['naslov']; ?>">

<p>Kratki sažetak</p>
<textarea name="about"><?php echo $row['sazetak']; ?></textarea>

<p>Sadržaj</p>
<textarea name="content"><?php echo $row['tekst']; ?></textarea>

<p>Slika</p>
<img src="images/<?php echo $row['slika']; ?>" width="150">
<br><br>
<input type="file" name="pphoto">

<p>Kategorija</p>
<select name="category">
<option value="Retro" <?php if($row['kategorija']=="Retro") echo "selected"; ?>>Retro</option>
<option value="Basketball" <?php if($row['kategorija']=="Basketball") echo "selected"; ?>>Basketball</option>
<option value="Streetwear" <?php if($row['kategorija']=="Streetwear") echo "selected"; ?>>Streetwear</option>
</select>

<p>
<input type="checkbox" name="archive" <?php if($row['arhiva']==1) echo "checked"; ?>>
Arhiviraj
</p>

<button type="submit" name="update">Izmijeni</button>
<button type="submit" name="delete">Izbriši</button>

</form>

<?php
}

}else{
    if($poruka != ''){
        echo "<p>$poruka</p>";
    }
?>

<form method="POST" action="administrator.php">

<p>Korisničko ime</p>
<input type="text" name="username" required>

<p>Lozinka</p>
<input type="password" name="lozinka" required>

<button type="submit" name="prijava">Prijava</button>

</form>

<?php
}
?>

</main>

<footer>
<p>Luka Mršić</p>
<p>lmrsic1@tvz.hr</p>
<p>2026.</p>
</footer>

</body>
</html>