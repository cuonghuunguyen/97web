
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "97web";
$fileDir = "index.html";
$language = "en-us";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM index WHERE language_code = '$language'";
$result = $conn->query($sql);

$piecesOfContent = [];

if ($result->num_rows > 0) {
    // put the content to an array
    $piecesOfContent = $result->fetch_assoc();
} else {
    // redirect to default language
    header("Location: https://97websites.com");
    die();
}



$myfile = fopen($fileDir, "r") or die("Unable to open template file!");
$content = fread($myfile,filesize($fileDir));
echo $content;

$conn->close();
fclose($fileDir);
?>