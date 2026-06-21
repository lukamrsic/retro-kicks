<?php

include 'connect.php';

$registriranKorisnik = false;
$msg = '';

if(isset($_POST['submit'])){

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $lozinka = $_POST['pass'];
    $lozinka2 = $_POST['passRep'];

    if($lozinka == $lozinka2){

        $hashed_password = password_hash($lozinka, PASSWORD_BCRYPT);

        $razina = 0;

        // Provjera postoji li korisničko ime
        $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime=?";

        $stmt = mysqli_stmt_init($dbc);

        if(mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        if(mysqli_stmt_num_rows($stmt) > 0){

            $msg = "Korisničko ime već postoji!";

        }else{

            $sql = "INSERT INTO korisnik
            (ime, prezime, korisnicko_ime, lozinka, razina)
            VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($dbc);

            if(mysqli_stmt_prepare($stmt, $sql)){

                mysqli_stmt_bind_param(
                    $stmt,
                    "ssssi",
                    $ime,
                    $prezime,
                    $username,
                    $hashed_password,
                    $razina
                );

                mysqli_stmt_execute($stmt);

                $registriranKorisnik = true;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
<title>Registracija</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
<h1>RETRO KICKS</h1>
<p>Registracija korisnika</p>
</header>

<nav>
<a href="index.php">Početna</a>
<a href="unos.html">Unos</a>
<a href="administrator.php">Administracija</a>
</nav>

<main>

<?php
if($registriranKorisnik == true){
    echo "<p>Korisnik je uspješno registriran!</p>";
    echo '<p><a href="administrator.php">Idi na prijavu</a></p>';
}else{
?>

<form method="POST" action="registracija.php">

<p>Ime</p>
<input type="text" name="ime" required>

<p>Prezime</p>
<input type="text" name="prezime" required>

<p>Korisničko ime</p>
<p><?php echo $msg; ?></p>
<input type="text" name="username" required>

<p>Lozinka</p>
<input type="password" name="pass" required>

<p>Ponovi lozinku</p>
<input type="password" name="passRep" required>

<button type="submit" name="submit">Registriraj se</button>

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