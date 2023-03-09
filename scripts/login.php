<?php
require("../connect.php");

$email 	= htmlspecialchars($_POST["email"]);
$password 	= md5(htmlspecialchars($_POST["password"]));

//echo $email.$password;

$usercheck = mysqli_query($conn,"SELECT * FROM Uzivatel WHERE email = '$email'");
$row_uzivatel = mysqli_fetch_assoc($usercheck);

if(mysqli_num_rows($usercheck) > 0){
    //uzivatel existuje
    @session_start();
    $_SESSION["jmeno"] 				= $row_uzivatel["jmeno"];
    $_SESSION["id"] 				= $row_uzivatel["id"];
    $_SESSION["opravneni"]               = $row_uzivatel["opravneni"];
    $id = $_SESSION["id"];
    header("Location: ../index.php?pages=profile?id=$id");
}
else{
    //uzivatel neexistuje
}

?>
