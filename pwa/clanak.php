<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Store</title>
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
        <?php
        include 'connect.php'; 
        define('UPLPATH', 'slike/');

        $id = $_GET['id']; 
        $query = "SELECT * FROM proizvod WHERE id=$id";
        $result = mysqli_query($dbc, $query);

        if ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="row">
            <h2 class="category">
                <?php echo "<span>" . $row['kategorija'] . "</span>"; ?>
            </h2>
            <h1 class="title">
                <?php echo $row['naziv']; ?>
            </h1>
        </div>
        <section >
            <?php echo '<img src="' . UPLPATH . $row['slika'] . '">'; ?>
        </section>
        <section >
            <p>
                <?php echo "<i>" . $row['opis'] . "</i>"; ?>
            </p>
        </section>
        
        <?php
        } else {
            echo "<p>Product not found.</p>";
        }
        ?>
    </main>
    <footer>
        <p>Domagoj Augustić, daugustic@tvz.hr, 2024.</p>
    </footer>
</body>

</html>
