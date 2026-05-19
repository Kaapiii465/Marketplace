<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'marketplace');


if (isset($_SESSION['uzytkownik_id']) && isset($_POST['id'])) {
    $id_produktu = $_POST['id'];
    $id_kupujacego = $_SESSION['uzytkownik_id'];


    $query = "SELECT * FROM produkty WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produktu);
    $stmt->execute();
    $result = $stmt->get_result();

    $array = mysqli_fetch_array($result);

    if($array['status'] == "sprzedany"){
        exit();
    }

    $nazwa = $array['nazwa'];
    $opis = $array['opis'];
    $cena = $array['cena'];
    $kategoriaId = $array['kategoria_id'];

    $conn->begin_transaction();
    try{
        $query2 = "INSERT INTO historia (uzytkownik_id, nazwa_produktu, opis_produktu, kategoria_id, cena, data_zakupu) 
                VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("issid", $id_kupujacego, $nazwa, $opis, $kategoriaId, $cena);
        $stmt2->execute();
        $stmt2->close();

        $update = "UPDATE produkty SET status = 'sprzedany' WHERE id = ?";
        $stmt3 = $conn->prepare($update);
        $stmt3->bind_param('i', $id_produktu);
        $stmt3->execute();
        $stmt3->close();

        $conn->commit();
        
    } catch (Exception $e){
        $conn->rollback();
    }
}

header("Location: index.php");
exit();
?>