<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=etterm', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lekérdezés a felhasználók adatainak megjelenítésére
    $stmt = $pdo->query("SELECT name, email FROM users");

    // Kiírjuk az eredményt
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Név: " . $row['name'] . " - Email: " . $row['email'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Hiba történt: " . $e->getMessage();
}
?>
