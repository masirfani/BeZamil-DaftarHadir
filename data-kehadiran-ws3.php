<?php
header('Content-Type: application/json');

include 'koneksi.php';
// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

$tipe = $_GET['tipe'];
$sql = "SELECT * FROM kehadiran WHERE tipe = 'Workshop 3: Flowcytometry' ORDER BY id, waktu DESC";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    $no = 0;
    $nomor = 1;
    while($row = $result->fetch_assoc()) {
        $dateTime = new DateTime($row['waktu']);
        $data[$no] = $row;
        $data[$no]['nomor'] = $nomor++;
        $data[$no]['jam'] = $dateTime->format("H:i:s");
        $data[$no]['hari'] = $dateTime->format("d-m-Y");
        $data[$no]['aksi'] = "<a href='aksi.php?hapus=".$row['id']."' class='btn btn-danger btn-sm'>Hapus</a>";
        $no++;
    }
}

echo json_encode($data);

$conn->close();