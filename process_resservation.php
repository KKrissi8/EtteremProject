<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=etterm', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // űrlap adatainak bekérése
        $name = $_POST['name'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        // Adatbevitel a foglalások táblába
        $stmt = $pdo->prepare("INSERT INTO reservations (name, email, date, time) VALUES (:name, :email, :date, :time)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->execute();

        echo "Sikeres foglalás!";
    } catch (PDOException $e) {
        echo "Hiba történt: " . $e->getMessage();
    }
}
?>
