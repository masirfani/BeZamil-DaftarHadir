<?php
session_start();


date_default_timezone_set('Asia/Jakarta');
// Database connection configuration

// Create connection
$conn = mysqli_connect("localhost", "root", "", "project_zamil_daftarhadir");

// Check connection
if ($conn->connect_error) {
    die(json_encode(array('message' => 'Database connection failed: ' . $conn->connect_error)));
}

// Get the POST data
$nama     = htmlspecialchars($_POST['nama']);
$goodybag = $_POST['goodybag'];
$notes    = $_POST['notes'];
$waktu    = date("Y-m-d H:i:s");


$sql = "SELECT * FROM kehadiran WHERE nama = '$nama'";
$stmt = $conn->query($sql);
// var_dump($stmt->num_rows);
// die();
if ($stmt->num_rows > 0) {
    $_SESSION['message'] = [
        "type" => "error",
        "text" => "Sudah mengisi daftar hadir."
    ];
    header("location:index.php");
} else {
    $sql = "INSERT INTO kehadiran VALUES(NULL, '$nama','$goodybag','$notes','$waktu')";
    $stmt = $conn->query($sql);
    if ($stmt) {
        $_SESSION['message'] = [
            "type" => "success",
            "text" => "Berhasil mengisi daftar hadir."
        ];
    } else {
        $_SESSION['message'] = [
            "type" => "error",
            "text" => "Gagal mengisi daftar hadir."
        ];
    }

    $conn->close();
    header("location:index.php");
}
