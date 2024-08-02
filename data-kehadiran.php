<?php
header('Content-Type: application/json');

include 'koneksi.php';
// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// SQL query to select data
$date = date("Y-m-d");
$sql = "SELECT * FROM kehadiran WHERE DATE(waktu) = '$date' ORDER BY id DESC";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    $no = 0;
    $nomor = 1;
    while($row = $result->fetch_assoc()) {
        $dateTime = new DateTime($row['waktu']);
        $data[$no] = $row;
        $data[$no]['nomor'] = $nomor++;
        $data[$no]['jam'] = $dateTime->format("s:i:H");
        $data[$no]['hari'] = $dateTime->format("d-m-Y");
        $no++;
    }
}

echo json_encode($data);

$conn->close();
