<html>
    <head>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 34px;
                height: 20px;
            }
            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }
            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                transition: .4s;
                border-radius: 34px;
            }
            .slider:before {
                position: absolute;
                content: "";
                height: 14px;
                width: 14px;
                left: 3px;
                bottom: 3px;
                background-color: white;
                transition: .4s;
                border-radius: 50%;
            }
            input:checked + .slider {
                background-color: #4CAF50;
            }
            input:checked + .slider:before {
                transform: translateX(14px);
            }
        </style>

    </head>
    <body class="bg-gray-200 min-h-screen flex flex-col">
        <div class="w-full mx-auto bg-white shadow-lg rounded-lg overflow-hidden flex flex-col flex-grow">
            <!-- Header -->
            <div class="bg-blue-600 p-4 flex justify-between items-center">
                <span class="text-white font-bold">AQU-Z</span>
                <div class="flex space-x-4">
                    <i class="fas fa-plus text-white"></i>
                    <i class="fas fa-bell text-white"></i>
                </div>
            </div>
            
            <!-- Konten Utama -->
            <div class="p-4 space-y-4 flex-grow">
                <?php 
                    include "koneksi.php";
                    session_start();
                    $id_user = $_SESSION["id_user"];
                    $query1 = "SELECT * FROM t_sensor where id_user = '$id_user' and id_sensor = '1' ORDER BY `t_sensor`.`tgl` DESC limit 1";
                    $data1 = mysqli_query($conn, $query1);
                    foreach ($data1 as $row1) {
                        $tgl1 = $row1['tgl'];
                        $value1 =  $row1['value'];
                        if ($value1 < 6){
                            $status1 = "tambahkan campuran PH";
                        }elseif($value1 <= 6){
                            $status1 = "baik";
                        }else{
                            $status1 = "ganti air";
                        }
                    }

                ?>
                <div class="bg-blue-600 text-white rounded-lg p-6 text-center mb-4">
                    <p>Terbaru :</p>
                    <i class="fas fa-tint text-4xl"></i>
                    <p class="text-4xl font-bold"><?php echo $value1;?></p>
                    <p><?php echo "$status1";?></p>
                </div>
                <div class="space-y-2">
                <?php 
                    $query = "SELECT * FROM t_sensor where id_user = '$id_user' and id_sensor = '1' ORDER BY `t_sensor`.`tgl` ASC  ";
                    $data = mysqli_query($conn, $query);
                    foreach ($data as $row) {
                        $tgl = $row['tgl'];
                        $value =  $row['value'];
                        if ($value < 6){
                            $status = "tambahkan campuran PH";
                        }elseif($value <= 6){
                            $status = "baik";
                        }else{
                            $status = "ganti air";
                        }
                        echo '<div class="bg-gray-200 rounded-lg p-2 flex justify-between items-center">';
                        echo '<span>'.$tgl.'</span>';
                        echo '<i class="fas fa-tint text-blue-600"></i>';
                        echo '<span>'.$value.'</span>';
                        echo '<span class="text-blue-600">'.$status.'</span></div>';
                    }     
                ?>
                    <!-- <div class="bg-gray-200 rounded-lg p-2 flex justify-between items-center">
                        <span>07.00</span>
                        <i class="fas fa-tint text-blue-600"></i>
                        <span>5</span>
                        <span class="text-blue-600"> tambahkan campuran PH< 6-8 baik, >8 = ganti air</span>
                    </div> -->
                   
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-300 p-4 flex justify-between items-center">
                <i class="fas fa-fish text-blue-600 text-2xl"></i>
                <i class="fas fa-tint text-gray-600 text-2xl"></i>
                <i class="fas fa-user-circle text-gray-600 text-2xl"></i>
            </div>
        </div>


    </body>
</html>