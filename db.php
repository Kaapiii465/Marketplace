<?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'marketplace');

    if (!$conn) {
        die("Błąd połączenia: " . mysqli_connect_error());
    }
?>