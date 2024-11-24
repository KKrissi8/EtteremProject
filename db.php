<?php
try {
    // Itt módosítjuk az adatbázis nevét 'etterm'-re
    $pdo = new PDO('mysql:host=localhost;dbname=etterm', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Adatbázis kapcsolat nem sikerült: " . $e->getMessage();
}
?>
