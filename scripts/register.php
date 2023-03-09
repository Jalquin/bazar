<?php
//tento soubor můžeme klidně nechat i v register.php v template, tak či tak je to špagety

require("../connect.php");

$name 	= htmlspecialchars($_POST["name"]);
$surname 	= htmlspecialchars($_POST["surname"]);
$email 	= htmlspecialchars($_POST["email"]);
$password 	= md5(htmlspecialchars($_POST["password"]));

echo $name.$surname.$email.$password;

//check if registered
$checkifregistered = mysqli_query($conn,"SELECT email FROM Uzivatel WHERE email = '$email'");
if(mysqli_num_rows($checkifregistered) > 0){
    echo "An user is already registered with this email.<br>";

}
else{

    //ZDE MŮŽEME PŘÍPADNĚ ROZŠIŘOVAT DALŠÍ OŠETŘENÍ

    $dotaz = "INSERT INTO Uzivatel (jmeno,prijmeni,email,heslo,opravneni,obrazky_id) VALUES (?,?,?,?,0,1)";
    $stmt = $conn->prepare($dotaz);
    $stmt->bind_param("ssss", $name, $surname, $email, $password);
    $stmt->execute();
    $id=$stmt->insert_id;
}
?>
