<?php
include('db.php');

try {
    $stmt = $pdo->query("SELECT 1");  // Egy egyszerű lekérdezés a kapcsolat tesztelésére
    echo "Adatbázis kapcsolat sikeresen létrejött!";
} catch (PDOException $e) {
    echo "Adatbázis kapcsolat nem sikerült: " . $e->getMessage();
}
?>
