<?php
header('Content-Type: text/plain'); // Use plain text format
include "db_config.php";

$memberName = $_POST['memberName'] ?? '';
$memberEmail = $_POST['memberEmail'] ?? '';
$memberPhone = str_replace("-", "", $_POST['memberPhone'] ?? '');
$memberSekolah = $_POST['memberSekolah'] ?? '';
$memberAlasan = $_POST['memberAlasan'] ?? '';

$user_id = uniqid('');

$sql = "INSERT INTO pendaftaran (user_id, nama, email, nomor_telepon, asal_sekolah, alasan, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, current_timestamp())";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssssss", $user_id, $memberName, $memberEmail, $memberPhone, $memberSekolah, $memberAlasan);

    if ($stmt->execute()) {
        echo "Sukses memasukan data|$user_id";
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo 'Error preparing statement: ' . $conn->error;
}
?>
