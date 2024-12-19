<?php 
include "koneksi.php";
session_start();
$id_user = $_SESSION["id_user"];

if(isset($_POST['submit'])){
    $jam = $_POST['jam'];
    $menit = $_POST['menit'];
    $detik = 20;
    $jamMakan = $jam.':'.$menit.':'.$detik;

    $sql = "UPDATE makan SET jam='$jamMakan' WHERE id_user='$id_user'";
    mysqli_query($conn, $sql);

    // Redirect setelah memastikan tidak ada output sebelumnya
    header('Location: dashboard.php');
    exit; // Tambahkan exit untuk menghentikan eksekusi setelah redirect
}
?>
<html>
    <head>
        <title>AQU-Z</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
			.time-picker {
				position: absolute;
				display: inline-block;
				padding: 10px;
				background: #eeeeee;
				border-radius: 6px;
			}

			.time-picker__select {
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
				outline: none;
				text-align: center;
				border: 1px solid #dddddd;
				border-radius: 6px;
				padding: 6px 10px;
				background: #ffffff;
				cursor: pointer;
				font-family: 'Heebo', sans-serif;
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
            <div class="p-4 space-y-4 flex-grow flex items-center justify-center">
                <div class="bg-blue-500 text-white p-4 rounded-lg w-full max-w-md">
                    <div class="bg-gray-100 p-4">
                        <div class="flex justify-around mb-4">
                            <button class="flex items-center text-blue-600">
                                <i class="fas fa-clock text-xl mr-2"></i>
                                <span class="font-bold">Timer Feeder</span>
                            </button>
                            <button class="flex items-center text-gray-400">
                                <i class="fas fa-bullhorn text-xl mr-2"></i>
                                <span class="font-bold">Manual Feeder</span>
                            </button>
                        </div>
                        <div class="text-center">
                            <h1 class="text-blue-600 text-4xl font-bold mb-4">Timer</h1>
                            <form action="" method="post">
                                <div class="flex justify-center items-center mb-2">
                                    <select class="time-picker__select bg-blue-600 text-yellow-400 text-4xl font-bold px-4 py-2 rounded" name="jam">
                                        <?php 
                                            for ($i=0;$i<24;$i++){
                                            echo '<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT).'">'.str_pad($i, 2, "0", STR_PAD_LEFT).'</option>';
                                            }
                                        ?>
                                        
                                    </select>
                                    <span class="text-blue-600 text-4xl font-bold mx-2">:</span>
                                    <select class="time-picker__select bg-blue-600 text-yellow-400 text-4xl font-bold px-4 py-2 rounded" name="menit">
                                        <?php 
                                            for ($i=0;$i<60;$i++){
                                            echo '<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT).'">'.str_pad($i, 2, "0", STR_PAD_LEFT).'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <p class="text-yellow-400 font-bold mb-4">Perangkat 1</p>
                                <button type="submit" name="submit" class="bg-blue-200 text-blue-600 font-bold py-2 px-4 rounded">Simpan</button>
                            </form>
                        </div>
                    </div>
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











