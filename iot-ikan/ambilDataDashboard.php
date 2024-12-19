<?php
    include "koneksi.php";
    $id_user = 1;
    // $id_user = $_GET['id_user'];
    $tglSekarang = date('Y-m-d'); 
    
    $sql = mysqli_query($conn,"SELECT * FROM t_sensor where tgl = '$tglSekarang' and id_user = '$id_user' ");
    $result = array();

    while ($row = mysqli_fetch_array($sql)) {
        array_push($result, array(
                                    'id_tSensor '=>$row[0], 
                                    'id_sensor'=>$row[1], 
                                    'id_user'=>$row[2],
                                    'tgl'=>$row[3],
                                    'value'=>$row[4],
                                ));
    }
 
    header('Content-Type: application/json');
    echo json_encode(array("result" => $result));
    
?>