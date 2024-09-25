<?php
$env = parse_ini_file(".env");

$servername = "localhost"; 
$username = $env["DB_USERNAME"];       
$password = $env["DB_PASSWORD"];       
$dbname = $env["DB_NAME"];    
        
    // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
        
    // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>