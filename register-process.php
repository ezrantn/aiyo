<?php
header('Content-Type: text/plain');
include "./db-config.php";

$formData = [
    'nama' => $_POST['nama'] ?? '',
    'email' => $_POST['email'] ?? '',
    'nomor_telepon' => $_POST['nomor_telepon'] ?? '',
    'asal_sekolah' => $_POST['asal_sekolah'] ?? '',
    'alasan_mendaftar' => $_POST['alasan_mendaftar'] ?? '',
    'lokasi_sekolah' => $_POST['lokasi_sekolah'] ?? ''
];

$formData['nomor_telepon'] = str_replace("-", "", $formData['nomor_telepon']);
$user_id = uniqid();

$sql = "INSERT INTO pendaftaran (user_id, nama, email, nomor_telepon, asal_sekolah, alasan, lokasi_sekolah, created_at)
VALUES (?, ?, ?, ?, ?, ?, ?, current_timestamp())";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param(
        "sssssss",
        $user_id,
        $formData['nama'],
        $formData['email'],
        $formData['nomor_telepon'],
        $formData['asal_sekolah'],
        $formData['alasan_mendaftar'],
        $formData['lokasi_sekolah']
    );

    if ($stmt->execute()) {
        // Query the user_id from the database using the email
        $query = "SELECT user_id FROM pendaftaran WHERE email = ?";
        $stmt_select = $conn->prepare($query);
        $stmt_select->bind_param("s", $formData['email']);
        $stmt_select->execute();
        $stmt_select->bind_result($retrieved_user_id);
        $stmt_select->fetch();

        echo json_encode(['success' => true, 'user_id' => $retrieved_user_id]);
        $stmt_select->close();
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
        exit();
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
    exit();
}

$conn->close();
