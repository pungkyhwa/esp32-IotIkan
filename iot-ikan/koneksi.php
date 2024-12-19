<?php 
    $host = "localhost";
    $username = "root";
    $password = "appuca-new";
    $db = "iot-ikan";
    $conn = new mysqli($host,$username,$password,$db);

    if (mysqli_connect_errno()){
        echo "Koneksi database gagal : " . mysqli_connect_error();
    }   
?>