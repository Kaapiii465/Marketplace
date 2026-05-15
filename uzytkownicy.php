<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'marketplace');
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
        <a href="Uzytkownicy.php"><b>Użytkownicy</b></a>
        <a href="mojeProdukty.php">Moje produkty</a>
        <a href="historia.php">Historia</a>
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
    <h1>Zarejestrowani użytkownicy</h1>
    <ul>
        <?php
        $res = mysqli_query($conn, "SELECT login, email FROM uzytkownicy");
        while($user = mysqli_fetch_array($res)) {
            echo "<li><b>" . $user['login'] . "</b> (" . $user['email'] . ")</li>"; 
        }
        ?>
    </ul>
</div>

</body>
</html>