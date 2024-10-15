<?php
include "../db-config.php";

$env = parse_ini_file("../.env");

if (isset($_POST['submit-otp'])) {
    $nomor = mysqli_real_escape_string($conn, $_POST['nomor']);

    mysqli_query($conn, "DELETE FROM otp WHERE nomor = '$nomor'");

    $otp = rand(100000, 999999);
    $waktu = time();

    mysqli_query($conn, "INSERT INTO otp (nomor, otp, waktu) VALUES ('$nomor', '$otp', '$waktu')");

    $data = [
        'target' => $nomor,
        'message' => "Ini adalah OTP Anda: " . $otp
    ];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: " . $env["FONNTE_TOKEN"]));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($curl);
    curl_close($curl);

    header("Location: verify-user.php?nomor=$nomor");
    exit();
} elseif (isset($_POST['submit-login'])) {
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);
    $nomor = mysqli_real_escape_string($conn, $_POST['nomor']);

    $q = mysqli_query($conn, "SELECT * FROM otp WHERE nomor = '$nomor' AND otp = '$otp'");
    $row = mysqli_num_rows($q);

    if ($row > 0) {
        $r = mysqli_fetch_array($q);

        if (time() - $r['waktu'] <= 300) {
            echo "OTP benar, Anda berhasil login.";
        } else {
            echo "OTP expired, silakan minta OTP baru.";
        }
    } else {
        echo "OTP salah, silakan coba lagi.";
    }
    exit();
}
