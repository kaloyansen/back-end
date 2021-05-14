<?php
$server = "localhost";
$username = "";
$password = "";
$db = "tickets";
$conn = mysqli_connect($server, $username, $password, $db);

if($conn->connect_error){
    die('connection failed: '. $conn->connect_error);
}
?>
