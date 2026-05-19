<?php
include "db.php";

if (!isset($_SESSION['uzytkownik_id'])) {
    header("Location: login.php");
    exit();
}

$produktId = $_POST['edytujProduktId'];

if($_POST && isset($_POST['zapiszEdycje'])){
    $nazwa = $_POST['nazwa'];
    $opis = $_POST['opis'];
    $kategoria = $_POST['kategoria'];
    $cena = $_POST['cena'];

    $query = "UPDATE produkty
              SET nazwa = ?, opis = ?, cena = ?, kategoria_id = ?
              WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssiii', $nazwa, $opis, $cena, $kategoria, $produktId);
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
    <title>Marketplace</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
    <style>
    </style>
</head>
<body>

<header>
    <h1>Marketplace</h1>
    <nav>
        <a href="index.php">Ogłoszenia</a>
        <a href="uzytkownicy.php">Użytkownicy</a>
        <a href="mojeProdukty.php"><b>Moje produkty</b></a>
        <a href="historia.php">Historia</a>
        <a href="dodajProdukt.php">+ Dodaj produkt</a>
    </nav>
    <div class="konto">
        <?php if(isset($_SESSION['login'])): ?>
            <div class="nazwa"><?php echo $_SESSION['login'][0];?></div>
            <a href="logout.php"><button>Wyloguj</button></a>
        <?php else: ?>
            <a href="login.php"><button>Zaloguj się</button></a>
        <?php endif; ?>
    </div>
</header>

<div class="container auth-container">
    <h1>Edytuj produkt</h1>
    <form method="POST">
        <input type='hidden' name='zapiszEdycje'>
        <input type='hidden' name='edytujProduktId' value='<?php echo $produktId; ?>'>
            <?php
            $userId = $_SESSION['uzytkownik_id'];
            $produktId = $_POST['edytujProduktId'];

            $query = "SELECT produkty.id, produkty.nazwa, produkty.opis, produkty.cena, produkty.status, produkty.uzytkownik_id, produkty.kategoria_id, uzytkownicy.login, kategorie.id, kategorie.nazwa 
                      FROM produkty 
                      INNER JOIN uzytkownicy ON produkty.uzytkownik_id = uzytkownicy.id 
                      INNER JOIN kategorie ON produkty.kategoria_id = kategorie.id 
                      WHERE produkty.id= ? 
                      ORDER BY produkty.id DESC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $produktId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $query2 = "SELECT * FROM kategorie GROUP BY id";
            $result2 = mysqli_query($conn, $query2);

            while($row = mysqli_fetch_array($result)){
                echo "<label>Nazwa produktu </label> <br>";
                echo "<input type='text' name='nazwa' value='" .$row[1] ."'> <br>";

                echo "<label>Opis </label> <br>";
                echo "<textarea name='opis' >" .$row[2] ."</textarea> <br><br>";

                echo "<label>Kategoria </label> <br>"; 
                echo "<select name='kategoria'>";
                while($row2 = mysqli_fetch_array($result2)){
                    $selected = ($row2['id'] == $row['kategoria_id']) ? "selected" : "";

                    echo "<option value='" . $row2['id'] . "' $selected>";
                    echo $row2['nazwa'];
                    echo "</option>";
                }
                echo "</select> <br><br>";

                echo "<label>Cena (zł)</label> <br>";
                echo "<input type='number' name='cena' step=0.01 min=0 value='" .$row[3] ."' <br>";
            }
            ?>
            <input type='submit' class='buttonEdit' value='Potwierdź'>
    </form>
</div>

</body>
</html>
