<?php
header('Content-Type: application/json');
include "db_config.php";

use Hidehalo\Nanoid\Client;
use Hidehalo\Nanoid\GeneratorInterface;

$generateNano = new Client();
$clientUserID = $generateNano->generateId($size = 6, $mode = Client::MODE_DYNAMIC);

$data = json_decode(file_get_contents('php://input'), true);

if ($data === null) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
    exit;
}

$memberName = $data['memberName'] ?? '';
$memberEmail = $data['memberEmail'] ?? '';
$memberPhone = str_replace("-", "", $data['memberPhone'] ?? '');
$memberSekolah = $data['memberSekolah'] ?? '';
$memberAlasan = $data['memberAlasan'] ?? '';

var_dump($_POST);

$sql = "INSERT INTO pendaftaran 
        (user_id, nama, email, nomor_telepon, asal_sekolah, alasan, created_at) 
        VALUES 
        (?, ?, ?, ?, ?, ?, current_timestamp())";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssssss", $clientUserID, $memberName, $memberEmail, $memberPhone, $memberSekolah, $memberAlasan);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Sukses memasukan data']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]); // Show error message
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error preparing statement: ' . $conn->error]);
}
?>
