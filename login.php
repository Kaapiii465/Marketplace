<?php
include "db.php";

$error = "";

if ($_POST) {
    $login = $_POST['login'];
    $res = mysqli_query($conn, "SELECT * FROM uzytkownicy WHERE login = '$login'");
    $user = mysqli_fetch_array($res);

    if ($user && password_verify($_POST['haslo'], $user['haslo'])) {
        $_SESSION['uzytkownik_id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        header("Location: index.php");
    } else {
        $error = "Błędny login lub hasło!";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie - Marketplace</title>
    <link rel="stylesheet" href="style.css"> <link rel="stylesheet" href="login.css">
</head>
<body>

<header>
    <h1>Marketplace</h1>
    <nav>
        <a href="index.php">Ogłoszenia</a>
        <a href="uzytkownicy.php">Użytkownicy</a>
        <a href="mojeProdukty.php">Moje produkty</a>
        <a href="historia.php">Historia</a>
        <a href="dodajProdukt.php">+ Dodaj produkt</a>
    </nav>
    <div class="konto">
        <button><a href="rejestracja.php" style='text-decoration:none; color:black;'>Zarejestruj się</a></button>
    </div>
</header>

<div class="container auth-container">
    <h1>Zaloguj się</h1>
    <p>Nie masz konta? <a href="rejestracja.php">Zarejestruj się</a></p>
    <form method="POST">
        <label>Nazwa</label> <br>
        <input type="text" name="login" required> <br>

        <label>Hasło</label> <br>
        <input type="password" name="haslo" required> <br>

        <button type="submit" class="btn-login">Zaloguj się</button>
        <?php if ($error): ?>
            <p style="color: red; text-align: center; margin-top: 15px; font-weight: bold;">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>