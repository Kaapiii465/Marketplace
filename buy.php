<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'marketplace');


if (isset($_SESSION['uzytkownik_id']) && isset($_GET['id'])) {
    $id_produktu = $_GET['id'];
    $id_kupujacego = $_SESSION['uzytkownik_id'];


    $query = "SELECT * FROM produkty WHERE id = $id_produktu";
    $result = mysqli_query($conn, $query);

    $array = mysqli_fetch_array($result);

    $nazwa = $array['nazwa'];
    $opis = $array['opis'];
    $cena = $array['cena'];
    $kategoria = $array['kategoria_id'];

    $query2 = "INSERT INTO historia (uzytkownik_id, nazwa_produktu, opis_produktu, kategoria_id, cena, data_zakupu) 
        VALUES ('$id_kupujacego', '$nazwa', '$opis', $kategoria, $cena, CURRENT_TIMESTAMP)";
    mysqli_query($conn, $query2);


    $update = "UPDATE produkty SET status = 'sprzedany' WHERE id = $id_produktu";
    mysqli_query($conn, $update);
}

header("Location: index.php");
exit();
?>