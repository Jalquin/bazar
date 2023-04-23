<?php
require("../connect.php");

$email = htmlspecialchars($_POST["email"]);
$password = md5(htmlspecialchars($_POST["password"]));

$stmt = mysqli_prepare($conn, "SELECT id, jmeno, opravneni FROM Uzivatel WHERE email = ? AND heslo = ?");
mysqli_stmt_bind_param($stmt, "ss", $email, $password);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if(mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_bind_result($stmt, $id, $jmeno, $opravneni);
    mysqli_stmt_fetch($stmt);

    session_start();
    $_SESSION["jmeno"] = $jmeno;
    $_SESSION["id"] = $id;
    $_SESSION["opravneni"] = $opravneni;

    header("Location: ../index.php?pages=profile&id=$id");
} else {
    //uzivatel neexistuje
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>