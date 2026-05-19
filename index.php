<?php include "db.php" ?>

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
        <a href="index.php"><b>Ogłoszenia</b></a>
        <a href="uzytkownicy.php">Użytkownicy</a>
        <a href="mojeProdukty.php">Moje produkty</a>
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
    <div class="filtr">
        <h2>Kategoria: </h2>
        <form method="POST" class='filterForm'>
            <select onchange='this.form.submit()' name='kategoria'>
                <option value="wszystkie">Wszystkie</option>
                <?php
                    $query = "SELECT id, nazwa FROM kategorie GROUP BY nazwa ORDER BY id";

                    $result = mysqli_query($conn, $query);

                    while($row = mysqli_fetch_array($result)){
                        $selected = (isset($_POST['kategoria']) && $_POST['kategoria'] == $row['id']) ? "selected" : "";

                        echo "<option value='" . $row['id'] . "' $selected>";
                        echo $row['nazwa'];
                        echo "</option>";
                    }
                ?>  
            </select>
        </form>
    </div>
        

    <div class="grid">
            <input type="hidden" value='<?php $_SESSION['uzytkownik_id'] ?>'>
            <?php
            $kat = null;

            if (isset($_POST['kategoria'])) {
                if ($_POST['kategoria'] !== "wszystkie" && $_POST['kategoria'] !== "") {
                    $kat = $_POST['kategoria'];
                }
            }

            $where = $kat ? "WHERE produkty.kategoria_id = $kat" : "";
                
            $query = "SELECT produkty.id, produkty.nazwa, produkty.opis, produkty.cena, produkty.status, 
                produkty.uzytkownik_id, uzytkownicy.login, kategorie.nazwa as 'nazwaKategorii'
                FROM produkty 
                INNER JOIN uzytkownicy ON produkty.uzytkownik_id = uzytkownicy.id 
                INNER JOIN kategorie ON kategorie.id = produkty.kategoria_id
                $where
                ORDER BY produkty.id DESC";

                $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_array($result)){
                $statusTekst = ($row['status'] == 'dostepny') ? "Dostępny" : "Sprzedany";
        
                echo "<div class='produkt'>";
                echo "<h2>" .$row['nazwa'] ."</h2>";
                echo "<span>(" .$row['nazwaKategorii'] .")</span>";
                echo "<p>" .$row['opis'] ."</p>";
                echo "<h3 class='cena'>" . $row['cena'] ." zł</h3>";
                echo "<p>Sprzedawca: <b>" .$row['login'] . "</b></p>";
                echo "<span class='status " .$row['status'] ."'>" .$statusTekst ."</span><br><br>";

                if ($row['status'] == 'sprzedany') {
                    echo "<button disabled  class='buttonSelled'>Produkt sprzedany</button>";
                } 
                elseif (!isset($_SESSION['uzytkownik_id'])) {
                    echo "<a href='login.php'><button>Zaloguj się, aby kupić</button></a>";
                } 
                elseif ($_SESSION['uzytkownik_id'] == $row['uzytkownik_id']) {
                    echo "<button disabled style=background:lightgray>Twój produkt</button>";
                } 
                else {
                    echo "<form method=POST action=buy.php>";
                    echo "<input type=hidden name=id value=" .$row['id'] .">";
                    echo "<button class='buttonBuy'>Kup produkt</button>";
                    echo "</form>";
                }

                echo "</div>";
            }
            ?>
    </div>
</div>

</body>
</html>