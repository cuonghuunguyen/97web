
<?php 
// include "/configution.php";
require($_SERVER["DOCUMENT_ROOT"]."//97web//configution.php");
?>
<?php

$fileDir = "./../../templates/homepage.html";
$language = "en-us";
$pageName = "homepage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM $pageName WHERE language_code = '$language'";
$result = $conn->query($sql);

$piecesOfContent = [];

if ($result->num_rows > 0) {
    // put the content to an array
    $piecesOfContent = $result->fetch_assoc();
} else {
    // redirect to default language
    // header("Location: https://97websites.com");
    // die();
}



$myfile = fopen($fileDir, "r") or die("Unable to open template file!");
$content = fread($myfile,filesize($fileDir));



foreach ($piecesOfContent as $key => $value) {
    $content = str_replace("@".$key."@",$value,$content);
}

echo $content;

$conn->close();
fclose($myfile);
?>