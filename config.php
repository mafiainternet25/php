<?php
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "casestudydb";

if (!extension_loaded('mysqli')) {
    die("PHP mysqli extension is not loaded. Enable mysqli in your php.ini and restart Apache/XAMPP.");
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>