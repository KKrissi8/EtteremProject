<?php

include('db.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $people = $_POST['people'];
    $location = $_POST['helyszin'];

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        
        $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);
        $user_id = $pdo->lastInsertId(); 
    } else {
        
        $user_id = $user['user_id'];
    }

    
    $stmt = $pdo->prepare("SELECT * FROM tables WHERE location = ? AND status = 'szabad' LIMIT 1");
    $stmt->execute([$location]);
    $table = $stmt->fetch();

    if ($table) {
        
        $stmt = $pdo->prepare("INSERT INTO reservations (user_id, table_id, reservation_date, reservation_time, num_people) 
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $table['table_id'], $date, $time, $people]);

        
        $stmt = $pdo->prepare("UPDATE tables SET status = 'foglalt' WHERE table_id = ?");
        $stmt->execute([$table['table_id']]);

        echo "A foglalás sikeresen megtörtént!";
    } else {
        echo "Nincs szabad asztal a választott helyszínen.";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Étterem Asztalfoglalás</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Étterem Asztalfoglalás</h1>
</header>

<div class="container">
    <h2>Foglalja le asztalát!</h2>
    <form action="index.php" method="post">
        <label for="name">Név:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email cím:</label>
        <input type="email" id="email" name="email" required>

        <label for="date">Dátum:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Időpont:</label>
        <input type="time" id="time" name="time" required>

        <label for="people">Személyek száma:</label>
        <input type="number" id="people" name="people" min="1" max="20" required>

        <fieldset>
            <legend>Válassza ki a helyszínt:</legend>
            <label for="terasz">
                <input type="radio" id="terasz" name="helyszin" value="terasz" required>
                Terasz
            </label>
            <label for="belter">
                <input type="radio" id="belter" name="helyszin" value="belter" required>
                Belter
            </label>
        </fieldset>

        <button type="submit">Foglalás megerősítése</button>
    </form>
</div>

<div class="footer">
    <p>&copy; Olasz étterem</p>
</div>

</body>
</html>
