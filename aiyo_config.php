<?php
$env = parse_ini_file(".env");

$host = $env["AIYO_HOST"];
$username = $env["AIYO_USERNAME"];
$password = $env["AIYO_PASSWORD"];
$billMasterId = $env["BILL_MASTER_ID"];
$api_key = $env["AIYO_API_KEY"];
$api_secret = $env["AIYO_API_SECRET"];
?>