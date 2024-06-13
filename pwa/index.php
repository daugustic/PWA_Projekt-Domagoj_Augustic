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

        ?>
    <h2>Laptopi</h2><br>
    
    <section class="Laptopi">
        <?php
        $query_laptopi = "SELECT * FROM proizvod WHERE kategorija='Laptop' AND skriven=0 LIMIT 3";
        $result_laptopi = mysqli_query($dbc, $query_laptopi);
        while ($row = mysqli_fetch_array($result_laptopi)) {
            echo '<article>';
            echo '<div class="article">';
            echo '<div class="laptopi_img">';
            echo '<img src="' . UPLPATH . $row['slika'] . '">';
            echo '</div>';
            echo '<div class="media_body">';
            echo '<h4 class="title">';
            echo '<a href="clanak.php?id=' . $row['id'] . '">' . $row['naziv'] . '</a>';
            echo '</h4>';
            echo '</div></div>';
            echo '</article>';
        }
        ?>
    </section>
    <h2>Mobiteli</h2><br>
    <section class="Mobiteli">
        <?php
        $query_mobiteli = "SELECT * FROM proizvod WHERE kategorija='Mobitel' AND skriven=0 LIMIT 3";
        $result_mobiteli = mysqli_query($dbc, $query_mobiteli);
        while ($row = mysqli_fetch_array($result_mobiteli)) {
            echo '<article>';
            echo '<div class="article">';
            echo '<div class="mobiteli_img">';
            echo '<img src="' . UPLPATH . $row['slika'] . '">';
            echo '</div>';
            echo '<div class="media_body">';
            echo '<h4 class="title">';
            echo '<a href="clanak.php?id=' . $row['id'] . '">' . $row['naziv'] . '</a>';
            echo '</h4>';
            echo '</div></div>';
            echo '</article>';
        }
        ?>
    </section>
    </main>    
    <footer>
        <p>Domagoj Augustić, daugustic@tvz.hr, 2024.</p>
    </footer>
</body>
</html>
