<?php
include "db.php";

if (!isset($_SESSION['uzytkownik_id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['id'])){
    $produktId = $_POST['id'];

    $query = "DELETE FROM `produkty` WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $produktId);
    $stmt->execute();

    header("Location: mojeProdukty.php");
}
?>