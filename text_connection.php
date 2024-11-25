<?php
include('db.php');

try {
    $stmt = $pdo->query("SELECT 1");  
    echo "Adatbázis kapcsolat sikeresen létrejött!";
} catch (PDOException $e) {
    echo "Adatbázis kapcsolat nem sikerült: " . $e->getMessage();
}
?>
