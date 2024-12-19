<?php
include "koneksi.php";

// Format tanggal
date_default_timezone_set('Asia/Jakarta');

// Ambil jam sekarang
$jamSekarang = date('H:i:s');
$getId = $_GET['id'];
// ambil jam makan berdasarkan id
$query = "SELECT * FROM makan where id_user = '1'";
$data = mysqli_query($conn, $query);
foreach ($data as $row) {
    $id_makan = $row['id_makan'];
    $jamMakan =  $row['jam'];
}     

// Konversi waktu menjadi timestamp
$timestampSekarang = strtotime($jamSekarang);
$timestampMakan = strtotime($jamMakan);

// Tambahkan margin 5 detik ke jam makan
$timestampMakanPlusMargin = $timestampMakan + 5;

if ($timestampSekarang >= $timestampMakan && $timestampSekarang <= $timestampMakanPlusMargin) {
    header('Content-Type: application/json');
    $nilai = 90; 
    $response = [
        'status' => 'success',
        'nilai' => $nilai,
    ];
    echo json_encode($response);
} else {
    header('Content-Type: application/json');
    $nilai = 0; 
    $response = [
        'status' => 'success',
        'nilai' => $nilai,
    ];
    echo json_encode($response);
}


// Kirimkan respon sebagai JSON

?>
