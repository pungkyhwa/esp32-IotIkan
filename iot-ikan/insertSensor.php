<?php
    include "koneksi.php";
    // session_start();
    // $id_user = $_SESSION["id_user"];
    $id_user = $_GET['id_user'];
    // sensor ph = 1 
    $ph = $_GET['ph'];
    // $ph = 25;
    // sensor turbinity = 2
    $turbinity = $_GET['turbinity']; 
    // $turbinity = 35; 
    // sensor ultrasonik = 3
    $ultrasonik = $_GET['ultrasonik'];
    // $ultrasonik = 45;
    $tglSekarang = date('Y-m-d'); 
    
    //  cek pada tabel t_sensor 
    $queryCari = "SELECT * FROM t_sensor where id_user = '$id_user' and tgl = '$tglSekarang'";
    $dataCari = mysqli_query($conn, $queryCari);
    if (mysqli_num_rows($dataCari) == 0) {
        echo "data tidak ditemukan lakukan insert";
        $sqlInsertPH = "INSERT INTO t_sensor (id_sensor, id_user, tgl, value) VALUES ('1','$id_user','$tglSekarang','$ph')";
        mysqli_query($conn, $sqlInsertPH);
        $sqlInsertTurbinity = "INSERT INTO t_sensor (id_sensor, id_user, tgl, value) VALUES ('2','$id_user','$tglSekarang','$turbinity')";
        mysqli_query($conn, $sqlInsertTurbinity);
        $sqlInsertUltrasonik = "INSERT INTO t_sensor (id_sensor, id_user, tgl, value) VALUES ('3','$id_user','$tglSekarang','$ultrasonik')";
        mysqli_query($conn, $sqlInsertUltrasonik);
        
    }else{
        echo "data ditemukan lakukan update";
        $sqlUpdatePh = "UPDATE t_sensor SET value='$ph' WHERE id_sensor = '1' and id_user='$id_user' and tgl = '$tglSekarang'";
        mysqli_query($conn, $sqlUpdatePh);
        $sqlUpdateTurbinity = "UPDATE t_sensor SET value='$turbinity' WHERE id_sensor = '2' and id_user='$id_user' and tgl = '$tglSekarang'";
        mysqli_query($conn, $sqlUpdateTurbinity);
        $sqlUpdateUltrasonik = "UPDATE t_sensor SET value='$ultrasonik' WHERE id_sensor = '3' and id_user='$id_user' and tgl = '$tglSekarang'";
        mysqli_query($conn, $sqlUpdateUltrasonik);
    }
?>
