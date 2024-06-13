<?php
session_start();
include 'connect.php';

define('UPLPATH', 'img/');

$uspjesnaPrijava = false; // Default to false
$neuspjesnaPrijava = false; // Flag to track failed login attempt

if (isset($_POST['prijava'])) {
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
        mysqli_stmt_fetch($stmt);
        
        if (mysqli_stmt_num_rows($stmt) > 0 && password_verify($prijavaLozinkaKorisnika, $lozinkaKorisnika)) {
            $uspjesnaPrijava = true;
            $_SESSION['username'] = $imeKorisnika;
            $_SESSION['level'] = $levelKorisnika;
        } else {
            $neuspjesnaPrijava = true; // Set the flag to true if login fails
        }
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM proizvod WHERE id=?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($dbc);
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $naziv = $_POST['naziv'];
    $opis = $_POST['opis'];
    $kategorija = $_POST['kategorija'];
    $skriven = isset($_POST['skriven']) ? 1 : 0;

    $query = "UPDATE proizvod SET naziv=?, opis=?, kategorija=?, skriven=? WHERE id=?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssii', $naziv, $opis, $kategorija, $skriven, $id);
        mysqli_stmt_execute($stmt);
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($dbc);
    }
}
?>

<!DOCTYPE html>
<html>
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
    if ((isset($uspjesnaPrijava) && $uspjesnaPrijava && $_SESSION['level'] == 1) || (isset($_SESSION['username']) && $_SESSION['level'] == 1)) {
        $query = "SELECT * FROM proizvod";
        $result = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_array($result)) {
    ?>
            <form enctype="multipart/form-data" action="" method="POST">
                <div class="form-item">
                    <label for="naziv">Naziv proizvoda:</label>
                    <div class="form-field">
                        <input type="text" name="naziv" class="form-field-textual" value="<?php echo $row['naziv']; ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label for="opis">Opis:</label>
                    <div class="form-field">
                        <textarea name="opis" class="form-field-textual"><?php echo $row['opis']; ?></textarea>
                    </div>
                </div>
                <div class="form-item">
                    <label for="kategorija">Kategorija:</label>
                    <div class="form-field">
                        <select name="kategorija" class="form-field-textual">
                            <option value="Laptop" <?php if ($row['kategorija'] == "Laptop") echo "selected"; ?>>Laptop</option>
                            <option value="Mobitel" <?php if ($row['kategorija'] == "Mobitel") echo "selected"; ?>>Mobitel</option>
                        </select>
                    </div>
                </div>
                <div class="form-item">
                    <label for="skriven">Skriven?</label>
                    <div class="form-field">
                        <input type="checkbox" name="skriven" <?php if ($row['skriven'] == 1) echo "checked"; ?>>
                    </div>
                </div>
                <div class="form-item">
                    <input type="hidden" name="id" class="form-field-textual" value="<?php echo $row['id']; ?>">
                    <button type="reset" value="Poništi">Poništi</button>
                    <button type="submit" name="update" value="Prihvati">Izmjeni</button>
                    <button type="submit" name="delete" value="Izbriši">Izbriši</button>
                </div>
            </form>
    <?php
        }
    } elseif (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
        echo '<p>Bok ' . $_SESSION['username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
    } else {
        if ($neuspjesnaPrijava) {
            echo '<p>Pogrešno korisničko ime ili lozinka. Molimo pokušajte ponovno.</p>';
        }
    ?>
        <form action="" method="POST">
            <div class="form-item">
                <label for="username">Korisničko ime:</label>
                <div class="form-field">
                    <input type="text" name="username" class="form-field-textual" required>
                </div>
            </div>
            <div class="form-item">
                <label for="lozinka">Lozinka:</label>
                <div class="form-field">
                    <input type="password" name="lozinka" class="form-field-textual" required>
                </div>
            </div>
            <div class="form-item">
                <button type="submit" name="prijava" value="Prijava">Prijava</button>
            </div>
        </form>
    <?php
    }
    ?>
    </main>
    <footer>
        <p>Domagoj Augustić, daugustic@tvz.hr, 2024.</p>
    </footer>
</body>
</html>

<?php
$dbc->close();
?>
