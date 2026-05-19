<?php
include "db.php";

if (!isset($_SESSION['uzytkownik_id'])) {
    header("Location: login.php");
    exit();
}

$and = "";
if($_POST){
    $filtr = $_POST['filtr'];
   
    if($filtr == "wszystkie"){
        $and = "AND produkty.status IS NOT NULL";
    }else{
        $and = "AND produkty.status = '$filtr'";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Marketplace</title>
    <link rel="stylesheet" href="style.css">
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

<div class="container">
    <h1 style='text-align: center;'>Moje Produkty</h1>
    <form method="POST">
        <p class='mojeProduktyFiltr'>
            <button class='dostepneFiltr' name='filtr' onclick='this.form.submit()' value='dostepny'>Dostępne</button>
            |
            <button class='wsztstkieFiltr' name='filtr' onclick='this.form.submit()' value='wszystkie'>Wszystkie</button>
            |
            <button class='niedostepneFiltr' name='filtr' onclick='this.form.submit()' value='sprzedany'>Sprzedane</button>
        </p>

    </form>

    <div class="grid">

            <?php
            $userId = $_SESSION['uzytkownik_id'];
            $query = "SELECT produkty.id, produkty.nazwa, produkty.opis, produkty.cena, produkty.status, produkty.uzytkownik_id, uzytkownicy.login 
                FROM produkty 
                INNER JOIN uzytkownicy ON produkty.uzytkownik_id = uzytkownicy.id 
                WHERE produkty.uzytkownik_id = ?"
                .$and
                ." ORDER BY produkty.id DESC";

            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            while($row = mysqli_fetch_array($result)){
                $statusTekst = ($row['status'] == 'dostepny') ? "Dostępny" : "Sprzedany";

                echo "<div class='produkt'>";

                echo "<h2>" .$row['nazwa'] ."</h2>";
                echo "<p>" .$row['opis'] ."</p>";
                echo "<h3 class='cena'>" . $row['cena'] ." zł</h3>";
                echo "<span class='status " .$row['status'] ."'>" .$statusTekst ."</span><br><br>";

                echo "<div class='buttonGrid'>";

                if($row['status'] == 'dostepny'){
                echo "<form method='POST' action='edytujProdukt.php'>";
                echo "  <input type='hidden' name='edytujProduktId' value='" . $row['id'] . "'>";
                echo "  <button type='submit' class='buttonEdit'>Edytuj produkt</button>";
                echo "</form>";
                } else {
                    echo "<button class='buttonEdit produktNiedostepny' disabled>Edytuj produkt</button>";
                }

                echo "<form method='POST' action='usunProdukt.php'>";
                echo "  <input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "  <button type='submit' class='buttonDelete'>Usuń produkt</button>";
                echo "</form>";

                echo "</div>";
                echo "</div>";
            }
            ?>
</div>
</div>

</body>
</html>