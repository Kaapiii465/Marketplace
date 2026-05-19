<?php
include "db.php";

if (!isset($_SESSION['uzytkownik_id'])) {
    header("Location: login.php");
}

$userId = $_SESSION['uzytkownik_id'];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Użytkownicy - Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Marketplace</h1>
    <nav>
        <a href="index.php">Ogłoszenia</a>
        <a href="uzytkownicy.php">Użytkownicy</a>
        <a href="mojeProdukty.php">Moje produkty</a>
        <a href="historia.php"><b>Historia</b></a>
        <a href="dodajProdukt.php">+ Dodaj produkt</a>
    </nav>
    <div class="konto">
        <?php if(isset($_SESSION['login'])): ?>
            <div class="nazwa"><?php echo $_SESSION['login'][0]; ?></div>
            <a href="logout.php"><button>Wyloguj</button></a>
        <?php else: ?>
            <a href="login.php"><button>Zaloguj się</button></a>
        <?php endif; ?>
    </div>
</header>

<div class="container">
    <h1>Historia zakupów</h1>
    
    <?php
        $query = "SELECT * FROM historia WHERE uzytkownik_id = $userId";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_array($result)){
            echo "<p>";
            echo "<b>" .$row['nazwa_produktu'] ."</b> - " .$row['opis_produktu'] .", " .$row['cena'] ." zł";
            echo "</p>";
        }
    ?>
</div>