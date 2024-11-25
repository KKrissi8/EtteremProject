<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=etterm', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Sikerült kapcsolódni az adatbázishoz!";
} catch (PDOException $e) {
    echo "Adatbázis kapcsolat nem sikerült: " . $e->getMessage();
}
?>
