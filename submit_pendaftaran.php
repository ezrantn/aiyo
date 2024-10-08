<?php
header('Content-Type: text/plain'); 
include "db_config.php";

$memberName = $_POST['Nama Siswa'] ?? '';
$memberEmail = $_POST['Email'] ?? '';
$memberPhone = $_POST["Nomor Telepon"] ?? '';
$memberSekolah = $_POST['Asal Sekolah'] ?? '';
$memberAlasan = $_POST['Alasan Mendaftar'] ?? '';

$memberPhone = str_replace("-", "", $userPhone);

$user_id = uniqid();

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
