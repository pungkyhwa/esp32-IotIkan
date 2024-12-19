<?php 
    include "koneksi.php";
    session_start();
    $id_user = $_SESSION["id_user"];

    $query = "SELECT * FROM makan where id_user = '$id_user'";
    $data = mysqli_query($conn, $query);
    foreach ($data as $row) {
        $id_makan = $row['id_makan'];
        $jamMakan =  $row['jam'];
        
    }     
?>
<html>
<head>
    <title>AQU-Z</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>

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
                <div class="flex justify-between items-center mb-4">
                    <span class="block text-sm">Hai <?php echo $_SESSION["nm_user"];?></span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Card pH -->
                    <a href="detailPh.php">
                    <div class="bg-blue-100 p-4 rounded-lg flex flex-col items-center">
                        <span class="text-blue-600"><i class="fas fa-tint"></i> pH</span>
                        <span class="text-4xl text-blue-600 font-bold" id="idSensor1"></span>
                        <i class="fas fa-water text-blue-600 text-4xl"></i>
                    </div>
                    </a>
                    <!-- Card Kekeruhan -->
                    <a href="detailKekeruhan.php">
                    <div class="bg-blue-100 p-4 rounded-lg flex flex-col items-center">
                        <span class="text-blue-600"><i class="fas fa-water"></i> Kekeruhan</span>
                        <span class="text-4xl text-blue-600 font-bold" id="idSensor2"></span>
                        <i class="fas fa-water text-blue-600 text-4xl"></i>
                    </div>
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-5">
                    <!-- Card Jam Makan -->
                    <a href="detailMakan.php">
                    <div class="bg-blue-100 p-4 rounded-lg flex flex-col items-center">
                        <span class="text-blue-600"><i class="fas fa-spinner"></i>Makan</span>
                        <span class="text-4xl text-blue-600 font-bold" id="idSensor3"></span>
                        <i class="fas fa-water text-blue-600 text-4xl"></i>
                    </div>
                    </a>
                    <!-- Card Makanan -->
                    <a href="atur_jam_makan.php">
                    <div class="bg-blue-100 p-4 rounded-lg flex flex-col items-center">
                        <span class="text-blue-600"><i class="fas fa-clock"></i> Jam Makanan</span>
                        <span class="text-4xl text-blue-600 font-bold" ><?php echo $jamMakan;?></span>
                        <i class="fas fa-water text-blue-600 text-4xl"></i>
                    </div>
                    </a>
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

    <script>
        $(document).ready(function () {
            // Fungsi untuk memperbarui data secara realtime
            function updateData() {
                $.getJSON("ambilDataDashboard.php", function (data) {
                    // Log data ke console
                    console.log(data.result);

                    // Update elemen berdasarkan ID sensor
                    if (data.result && data.result.length > 0) {
                        $("#idSensor1").text(data.result[0]?.value || "-");
                        $("#idSensor2").text(data.result[1]?.value || "-");
                        $("#idSensor3").text(data.result[2]?.value || "-");

                    } else {
                        $("#idSensor1, #idSensor2, #idSensor3, #idSensor4").text("-");
                    }
                }).fail(function () {
                    console.error("Gagal mengambil data dari ambilDataDashboard.php");
                });
            }

            // Panggil fungsi pertama kali
            updateData();

            // Perbarui data setiap 2 detik
            setInterval(updateData, 100);
        });
    </script>
</body>
</html>
