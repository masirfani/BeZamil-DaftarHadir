<?php
session_start();

include 'koneksi.php';

if(isset($_POST['nama'])){

    // Get the POST data
    $nama     = htmlspecialchars($_POST['nama']);
    $goodybag = $_POST['goodybag'];
    $notes    = $_POST['notes'];
    $tipe    = $_POST['tipe'];
    $waktu    = date("Y-m-d H:i:s");
    
    
    $sql = "SELECT * FROM kehadiran WHERE nama = '$nama' AND tipe = '$tipe'";
    $stmt = $conn->query($sql);
    
    
    if ($stmt->num_rows > 0) {
        $_SESSION['message'] = [
            "type" => "error",
            "text" => "Maaf $nama sudah mengisi daftar hadir"
        ];
        header("location:index.php");
    } else {
        $sql = "INSERT INTO kehadiran VALUES(NULL, '$nama','$goodybag','$notes','$waktu','$tipe')";
        $stmt = $conn->query($sql);
        if ($stmt) {
            $_SESSION['message'] = [
                "type" => "success",
                "text" => "Terima kasih <br>$nama<br>sudah absen di suramadenusra",
                "deskripsi" => "Silahkan untuk mengambil goodybag e tempat yang tersedia"
            ];
        } else {
            $_SESSION['message'] = [
                "type" => "error",
                "text" => "Gagal mengisi daftar hadir.",
                "deskripsi" => ""
            ];
        }
    
        header("location:index.php");
    }
}

if (isset($_GET['report'])) {
    $tipe = $_GET['report'];

    
    
    $data = [
        ['Nomor', 'Nama', 'Notes', 'Jam', 'Hari'],
    ];
    
    if ($tipe == "semua") {
        $execute = $conn->query("SELECT * FROM kehadiran ORDER BY id DESC");
    }else{
        $execute = $conn->query("SELECT * FROM kehadiran WHERE tipe = '$tipe'");
    }

    
    $no = 1;
    while ($see = mysqli_fetch_object($execute)){
        $dateTime = new DateTime($see->waktu);
        $jam = $dateTime->format("s:i:H");
        $hari = $dateTime->format("d-m-Y");

        $data[] = [
            $no++,
            $see->nama,
            $see->notes,
            $jam,
            $hari,
        ];
    }

    $filename = $tipe.date("s:i:H d-m-Y").".xls";
    // Set header untuk mendownload file Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Buka output buffer
    $output = fopen("php://output", "w");

    // Loop melalui data dan tulis ke output buffer
    foreach ($data as $row) {
        // Gunakan tab sebagai pemisah kolom
        fputcsv($output, $row, "\t");
    }

    // Tutup output buffer
    fclose($output);
    exit();
}
