<?php
$env = parse_ini_file(".env");

$servername = "localhost"; 
$username = $env["DB_USERNAME"];       
$password = $env["DB_PASSWORD"];       
$dbname = $env["DB_NAME"];    
        
$conn = new mysqli($servername, $username, $password, $dbname);
        
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>