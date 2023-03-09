<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Přihlášení</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mb-2">
        <div class="col-12 col-lg-6">
            <h1>Přihlášení</h1>
            <form action="scripts/login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label" for="email"><i class="bi bi-envelope-at"></i> E-mail</label>
                    <input class="form-control" name="email" id="email" type="email">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password"><i class="bi bi-lock"></i> Heslo</label>
                    <input class="form-control" name="password" id="password" type="password">
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Přihlásit se">
            </form>
            <a class="btn btn-link" href="index.php?pages=forgot">Zapomenuté heslo?</a>
            <a class="btn btn-link" href="index.php?pages=register">Registrovat</a>
        </div>
        <div class="col-12 col-lg-6">
            <img alt="team"
                 class="img-fluid"
                 src="https://www.shutterstock.com/image-photo/login-password-cyber-security-concept-600w-1794130912.jpg">
        </div>
    </div>
</div>