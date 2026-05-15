<?php
include "db.php";

if(isset($_GET['id'])){
    $produktId = $_GET['id'];

    $query = "DELETE FROM `produkty` WHERE id = $produktId";

    $result = mysqli_query($conn, $query);

    header("Location: mojeProdukty.php");
}
?>