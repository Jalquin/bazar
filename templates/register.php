<?php
$error = "";


if (isset($_POST['submit'])) {

    $name = htmlspecialchars($_POST["name"]);
    $surname = htmlspecialchars($_POST["surname"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = md5(htmlspecialchars($_POST["password"]));

    //echo $name . $surname . $email . $password;

    //check if registered
    $checkifregistered = mysqli_query($conn, "SELECT email FROM Uzivatel WHERE email = '$email'");
    if (mysqli_num_rows($checkifregistered) > 0) {
        $error = "An user is already registered with this email.<br>";

    } else {
        //ZDE MŮŽEME PŘÍPADNĚ ROZŠIŘOVAT DALŠÍ OŠETŘENÍ
        $dotaz = "INSERT INTO Uzivatel (jmeno,prijmeni,email,heslo,opravneni,obrazky_id) VALUES (?,?,?,?,0,1)";
        $stmt = $conn->prepare($dotaz);
        $stmt->bind_param("ssss", $name, $surname, $email, $password);
        $stmt->execute();
        $id = $stmt->insert_id;
        $error = "You have registered sucessfully!";
    }
}

echo $error;

?>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?pages=main">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Registrace</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<div class="container">
    <div class="row mb-2">
        <div class="col-12 col-lg-6">
            <h1>Registrace</h1>
            <form action="" method="POST">

                <div class="mb-3">
                    <label class="form-label" for="name"><i class="bi bi-person"></i> Jméno</label>
                    <input class="form-control" name="name" id="name" placeholder="Jan"
                           type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="surname"><i class="bi bi-person-fill"></i> Příjmení</label>
                    <input class="form-control" name="surname" id="surname" placeholder="Novák"
                           type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email"><i class="bi bi-envelope-at"></i> E-mail</label>
                    <input class="form-control" name="email" id="email" placeholder="example@example.com"
                           type="email">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password"><i class="bi bi-lock"></i> Heslo</label>
                    <input class="form-control" name="password" id="password"
                           type="password">
                    <div class="form-text" id="passwordHelpBlock">
                        Heslo musí být 8-20 znaků dlouhé.
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" id="agreed" type="checkbox">
                    <label class="form-check-label" for="agreed">Souhlasím se
                        <ins><a href="gdpr.php" target="_blank">zásadami zpracování osobních údajů.</a></ins>
                    </label>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Registrovat">
            </form>
            <a class="btn btn-link" href="login.php"><i class="bi bi-box-arrow-in-right"></i> Přihlásit se</a>
            <a class="btn btn-link" href="forgot.php">Zapomenuté heslo?</a>
        </div>
        <div class="col-12 col-lg-6">
            <img alt="team"
                 class="img-fluid"
                 src="https://www.shutterstock.com/image-photo/login-password-cyber-security-concept-600w-1794130912.jpg">
        </div>
    </div>
</div>

