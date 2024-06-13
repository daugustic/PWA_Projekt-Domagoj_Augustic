<?php
include 'connect.php'; 

$ime = $_POST['ime'] ?? '';
$prezime = $_POST['prezime'] ?? '';
$username = $_POST['username'] ?? '';
$lozinka = $_POST['pass'] ?? '';
$hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
$razina = 0;
$registriranKorisnik = false;
$msg = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $msg = 'Korisničko ime već postoji!';
    } else {
        
        $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
            mysqli_stmt_execute($stmt);
            $registriranKorisnik = true;
        }
    }

    mysqli_close($dbc);
}
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
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
        <?php if ($registriranKorisnik): ?>
            <p>Korisnik je uspješno registriran!</p>
        <?php else: ?>
            <section class="form-container">
                <div class="form">
                <form enctype="multipart/form-data" action="" method="POST">
                    <div class="form-item">
                        <span id="porukaIme" class="bojaPoruke"></span>
                        <label for="ime">Ime: </label>
                        <div class="form-field">
                            <input type="text" name="ime" id="ime" class="form-field-textual">
                        </div>
                    </div>
                    <div class="form-item">
                        <span id="porukaPrezime" class="bojaPoruke"></span>
                        <label for="prezime">Prezime: </label>
                        <div class="form-field">
                            <input type="text" name="prezime" id="prezime" class="form-field-textual">
                        </div>
                    </div>
                    <div class="form-item">
                        <span id="porukaUsername" class="bojaPoruke"></span>
                        <label for="username">Korisničko ime:</label>
                        <?php if (!empty($msg)) echo '<br><span class="bojaPoruke">' . $msg . '</span>'; ?>
                        <div class="form-field">
                            <input type="text" name="username" id="username" class="form-field-textual">
                        </div>
                    </div>
                    <div class="form-item">
                        <span id="porukaPass" class="bojaPoruke"></span>
                        <label for="pass">Lozinka: </label>
                        <div class="form-field">
                            <input type="password" name="pass" id="pass" class="form-field-textual">
                        </div>
                    </div>
                    <div class="form-item">
                        <span id="porukaPassRep" class="bojaPoruke"></span>
                        <label for="passRep">Ponovite lozinku: </label>
                        <div class="form-field">
                            <input type="password" name="passRep" id="passRep" class="form-field-textual">
                        </div>
                    </div><br>
                    <div class="form-item">
                        <button type="submit" value="Registriracija" id="slanje">Registriraj se</button>
                    </div>
                </form>
                </div>
            </section>
            <script type="text/javascript">
                document.getElementById("slanje").onclick = function(event) {
                    var slanjeForme = true;

                    
                    var poljeIme = document.getElementById("ime");
                    var ime = document.getElementById("ime").value;
                    if (ime.length == 0) {
                        slanjeForme = false;
                        poljeIme.style.border = "1px dashed red";
                        document.getElementById("porukaIme").innerHTML = "<br>Unesite ime!<br>";
                    } else {
                        poljeIme.style.border = "1px solid green";
                        document.getElementById("porukaIme").innerHTML = "";
                    }

                   
                    var poljePrezime = document.getElementById("prezime");
                    var prezime = document.getElementById("prezime").value;
                    if (prezime.length == 0) {
                        slanjeForme = false;
                        poljePrezime.style.border = "1px dashed red";
                        document.getElementById("porukaPrezime").innerHTML = "<br>Unesite Prezime!<br>";
                    } else {
                        poljePrezime.style.border = "1px solid green";
                        document.getElementById("porukaPrezime").innerHTML = "";
                    }

                    
                    var poljeUsername = document.getElementById("username");
                    var username = document.getElementById("username").value;
                    if (username.length == 0) {
                        slanjeForme = false;
                        poljeUsername.style.border = "1px dashed red";
                        document.getElementById("porukaUsername").innerHTML = "<br>Unesite korisničko ime!<br>";
                    } else {
                        poljeUsername.style.border = "1px solid green";
                        document.getElementById("porukaUsername").innerHTML = "";
                    }

                    
                    var poljePass = document.getElementById("pass");
                    var pass = document.getElementById("pass").value;
                    var poljePassRep = document.getElementById("passRep");
                    var passRep = document.getElementById("passRep").value;
                    if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
                        slanjeForme = false;
                        poljePass.style.border = "1px dashed red";
                        poljePassRep.style.border = "1px dashed red";
                        document.getElementById("porukaPass").innerHTML = "<br>Lozinke nisu iste!<br>";
                        document.getElementById("porukaPassRep").innerHTML = "<br>Lozinke nisu iste!<br>";
                    } else {
                        poljePass.style.border = "1px solid green";
                        poljePassRep.style.border = "1px solid green";
                        document.getElementById("porukaPass").innerHTML = "";
                        document.getElementById("porukaPassRep").innerHTML = "";
                    }

                    if (!slanjeForme) {
                        event.preventDefault();
                    }
                };
            </script>
        <?php endif; ?>
    </main>
    <footer>
        <p>Domagoj Augustić, daugustic@tvz.hr, 2024.</p>
    </footer>
</body>
</html>
