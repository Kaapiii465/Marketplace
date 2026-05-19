<?php
include "db.php";

if (!isset($_SESSION['uzytkownik_id'])) {
    header("Location: login.php");
}

if ($_POST) {
    $nazwa = $_POST['nazwa'];
    $opis = $_POST['opis'];
    $kategoria = $_POST['kategoria'];
    $cena = $_POST['cena'];
    $userId = $_SESSION['uzytkownik_id'];

    $query = "INSERT INTO produkty (nazwa, opis, cena, kategoria_id, status, uzytkownik_id) 
              VALUES (?, ?, ?, ?, 'dostepny', ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssdii', $nazwa, $opis, $cena, $kategoria, $uid);
    $stmt->execute();
    $stmt->close();

    header("Location: mojeProdukty.php");
    exit();
    
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj produkt - Marketplace</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css"> </head>
<body>

<header>
    <h1>Marketplace</h1>
    <nav>
        <a href="index.php">Ogłoszenia</a>
        <a href="uzytkownicy.php">Użytkownicy</a>
        <a href="mojeProdukty.php">Moje produkty</a>
        <a href="historia.php">Historia</a>
        <a href="dodajProdukt.php"><b>+ Dodaj produkt<b></a>
    </nav>
    <div class="konto">
        <div class="nazwa"><?php echo $_SESSION['login'][0]; ?></div>
        <a href="logout.php"><button>Wyloguj</button></a>
    </div>
</header>

<div class="container auth-container">
    <h1>Dodaj nowy produkt</h1>
    <form method="POST">
        <label>Nazwa produktu</label><br>
        <input type="text" name="nazwa" required><br>

        <label>Opis</label><br>
        <textarea name="opis"></textarea><br><br>

        <label>Kategoria</label><br>
        <select name='kategoria'>
            <?php
                $query = "SELECT id, nazwa FROM kategorie GROUP BY nazwa ORDER BY id";

                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_array($result)){
                    echo "<option value='" . $row['id'] . "' $selected>";
                    echo $row['nazwa'];
                    echo "</option>";
                }
                ?>  
        </select><br><br>

        <label>Cena (zł)</label><br>
        <input type="number" step="0.01" name="cena" required min=0><br>

        <button type="submit" class="buttonLogin">Wystaw ogłoszenie</button>
    </form>
</div>

</body>
</html>