<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=etterm', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);

    
    $name = 'John Doe';
    $email = 'john@example.com';
    $stmt->execute();

    echo "Sikeres adatbevitel!";
} catch (PDOException $e) {
    echo "Hiba történt: " . $e->getMessage();
}
?>
