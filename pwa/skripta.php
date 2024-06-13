<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proizvodi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazivProizvoda = htmlspecialchars($_POST['nazivProizvoda']);
    $slikaProizvoda = htmlspecialchars($_POST['slikaProizvoda']);
    $opisProizvoda = htmlspecialchars($_POST['opisProizvoda']);
    $kategorija = htmlspecialchars($_POST['kategorija']);
    $skriven = isset($_POST['skriven']) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO proizvod (naziv, slika, opis, kategorija, skriven) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nazivProizvoda, $slikaProizvoda, $opisProizvoda, $kategorija, $skriven);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT naziv, slika, opis, kategorija, skriven FROM proizvod ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit soumis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Tech Store</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="kategorija.php">Kategorija</a>
        <a href="registracija.php">Registracija</a>
        <a href="unos.html">Unos</a>
        <a href="administracija.php">Administracija</a>
    </nav>

    <main>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <article>
                    <h2><?php echo $row['naziv']; ?></h2>
                    <img src="<?php echo $row['slika']; ?>" alt="Image of <?php echo $row['naziv']; ?>">
                    <p><?php echo $row['opis']; ?></p>
                    <p>Kategorija: <?php echo $row['kategorija']; ?></p>
                    <p>Skriven: <?php echo $row['skriven'] ? 'Yes' : 'No'; ?></p>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Aucun produit trouvé.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>Domagoj Augustić, daugustic@tvz.hr, 2024.</p>
    </footer>
</body>
</html>
