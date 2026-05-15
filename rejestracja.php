<?php
include "db.php";

if ($_POST) {
    $login = $_POST['login'];
    $email = $_POST['email'];

    $haslo = password_hash($_POST['haslo'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO uzytkownicy (login, email, haslo) VALUES ('$login', '$email', '$haslo')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja - Marketplace</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css"> </head>
<body>

<header>
    <h1>Marketplace</h1>
    <nav>
        <a href="index.php">Ogłoszenia</a>
        <a href="Uzytkownicy.php">Użytkownicy</a>
        <a href="mojeProdukty.v">Moje produkty</a>
        <a href="historia.php">Historia</a>
        <a href="dodajProdukt.php">+ Dodaj produkt</a>
    </nav>
    <div class="konto">
        <a href="login.php"><button>Zaloguj się</button></a>
    </div>
</header>

<div class="container auth-container">
    <h1>Zarejestruj się</h1>
    <p>Masz już konto? <a href="login.php">Zaloguj się</a></p>

    <form method="POST">
        <label>Nazwa użytkownika</label> <br>
        <input type="text" name="login" required> <br>

        <label>Email</label> <br>
        <input type="email" name="email" required> <br>

        <label>Hasło</label> <br>
        <input type="password" name="haslo" required> <br>

        <button type="submit" class="btn-login">Załóż konto</button>
    </form>
</div>

</body>
</html>