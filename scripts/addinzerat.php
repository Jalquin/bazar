<?php
require("../connect.php");
@session_start();

$uzivatelid = $_SESSION["id"];

$nazev 	= $_POST["nazev"];
$kratkypopis = $_POST["kratkypopis"];
$jmeno 	= $_POST["jmeno"];
$prijmeni 	= $_POST["prijmeni"];
$email 	= $_POST["email"];
$cena = $_POST["cena"];
$tel = $_POST["tel"];
$lokace = $_POST["lokace"];
$dlouhypopis = $_POST["dlouhypopis"];
$status = $_POST["status"];

//$kategorie = $_POST["kategorie"];

//určitě ošetřit délku názvu, min a max

//echo $nazev.$fotografie.$kratkypopis.$jmeno.$prijmeni.$email.$cena.$tel.$lokace.$dlouhypopis.$status;


//nejdříve potřebuju vytvořit zboží
$vytvorzbozi = "INSERT INTO Zbozi (nazev) VALUES (?)";
$stmt = $conn->prepare($vytvorzbozi);
$stmt->bind_param("s", $nazev);
$stmt->execute();
$zboziid=$stmt->insert_id;


//přidej inzerát
$pridejinzerat = "INSERT INTO inzerat (kratkypopis,dlouhypopis,cena,tel,lokace,inzerat_status_id,zbozi_id) VALUES (?,?,?,?,?,$status,$zboziid)";
$stmt = $conn->prepare($pridejinzerat);
$stmt->bind_param("ssiis", $kratkypopis, $dlouhypopis, $cena, $tel, $lokace);
$stmt->execute();
$id=$stmt->insert_id;

//přidej vazbu mezi uživatelem a inzerátem
$dnesnidatum = date("Y-m-d");

$pridejvazbu = "INSERT INTO uzivatel_vytvoril_inzerat (Uzivatel_id, inzerat_id, datum_zalozeni) VALUES (?,?,'$dnesnidatum')";
$stmt = $conn->prepare($pridejvazbu);
$stmt->bind_param("ss", $uzivatelid, $id);
$stmt->execute();

$target_dir = "../images/inzeraty/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

$fileExt = explode('.', $_FILES["fileToUpload"]["name"]);
$fileActualExt = strtolower(end($fileExt));
$fileName = $fileExt[0];

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
//5000KB
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));
$fileName = $fileExt[0];

$allowed = array('jpg', 'jpeg', 'png', 'gif');
if (in_array($fileActualExt, $allowed)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

        $imgsrc = $_FILES["fileToUpload"]["name"];
        //přidej obrázek do databáze
        $pridejobrazek = mysqli_query($conn,"INSERT INTO obrazky (nazev,src,alt) VALUES ('$nazev','$imgsrc','$fileName')");

        //zjisti id obrazku
        echo $imgsrc;
        $getidobrazku = mysqli_query($conn,"SELECT * FROM obrazky WHERE src = '$imgsrc' LIMIT 1");
        foreach ($getidobrazku as $obrazek){
            $obrazekid = $obrazek["id"];
            $addconnection = mysqli_query($conn,"INSERT INTO `zbozi_ma_obrazky` (`Zbozi_id`, `Obrazky_id`) VALUES ('$zboziid', '$obrazekid');");
        }


    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//NEFUNGUJE ZBOZI MA OBRAZKY

header("Location: ../index.php?pages=myListings&id=$uzivatelid");

?>