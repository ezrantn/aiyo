<?php
header('Content-Type: text/plain');
include "db-config.php";

// Map form fields to database columns
$formData = [
    'Nama Siswa' => $_POST['Nama Siswa'] ?? '',
    'Email' => $_POST['Email'] ?? '',
    'Nomor Telepon' => $_POST['Nomor Telepon'] ?? '',
    'Asal Sekolah' => $_POST['Asal Sekolah'] ?? '',
    'Alasan Mendaftar' => $_POST['Alasan Mendaftar'] ?? '',
    'lokasi_sekolah' => $_POST['lokasi_sekolah'] ?? ''
];

// Remove dashes from phone number
$formData['Nomor Telepon'] = str_replace("-", "", $formData['Nomor Telepon']);

// Generate a unique user ID
$user_id = uniqid();

// Prepare SQL and bind parameters
$sql = "INSERT INTO pendaftaran (user_id, nama, email, nomor_telepon, asal_sekolah, alasan, lokasi_sekolah, created_at)
VALUES (?, ?, ?, ?, ?, ?, ?, current_timestamp())";

$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind mapped values to match database column order
    $stmt->bind_param(
        "sssssss",
        $user_id,
        $formData['Nama Siswa'],
        $formData['Email'],
        $formData['Nomor Telepon'],
        $formData['Asal Sekolah'],
        $formData['Alasan Mendaftar'],
        $formData['lokasi_sekolah']
    );

    if ($stmt->execute()) {
        // Database insertion successful; proceed to Google Sheets integration
        echo "Sukses memasukan data|$user_id";
    } else {
        // Database insertion failed
        echo 'Error: ' . $stmt->error;
        exit();
    }

    $stmt->close();
} else {
    echo 'Error preparing statement: ' . $conn->error;
    exit();
}

$conn->close();
?>
