<?php

$host = getenv('MYSQL_HOST');
$dbname = getenv('MYSQL_DATABASE');
$username = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Communication avec la base de données établie";

} catch(PDOException $e) {
    echo "Impossible de se connecter à la base de données";
}

$adjectifs = $pdo->query("SELECT content FROM adjective")->fetchAll(PDO::FETCH_COLUMN);
$noms = $pdo->query("SELECT content FROM noun")->fetchAll(PDO::FETCH_COLUMN);

$results = [];
for($i=0; $i<10; $i++) {
    $adj = $adjectifs[array_rand($adjectifs)];
    $nom = $noms[array_rand($noms)];
    $results[] = "$adj $nom";
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Générateur de noms de groupe</title>
</head>
<body>
    <h1>Générateur de noms de groupe</h1>

    <form method="POST">
        <button type="submit" name="generate">Générer 10 noms</button>
    </form>

    <?php
        if (isset($_POST['generate'])) {
            echo "<h2>Résultats :</h2>";
            echo "<ul>";
            foreach ($results as $name) {
                echo "<li>" . htmlspecialchars($name) . "</li>";
            }
            echo "</ul>";
        }
    ?>
</body>
</html>