<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-blue-600 h-screen flex items-center justify-center">
    <div class="bg-blue-600 w-full max-w-xs p-4">
        <div class="text-white mb-8">
            <a href="#" class="flex items-center text-white">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
        <div class="text-center text-white mb-8">
            <h1 class="text-2xl font-bold">Buat Akun</h1>
        </div>
        <form class="space-y-4" name="daftar" method="post">
            <input name="nama" tipe="text" placeholder="Nama Lengkap" class="w-full p-3 bg-blue-700 text-white rounded">
            <input name="email" tipe="text" placeholder="Email" class="w-full p-3 bg-blue-700 text-white rounded">
            <input name="password" tipe="password" placeholder="Kata Sandi" class="w-full p-3 bg-blue-700 text-white rounded">
            <button type="submit" name="submit" class="w-full p-3 bg-white text-blue-600 rounded-full font-bold">Daftar</button>
        </form>
        <div class="text-center text-white mt-8">
            <p class="text-sm">AGU-Z</p>
        </div>
    </div>
</body>
</html>

<?php 
     include "koneksi.php";
     if(isset($_POST['submit'])){
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // cek email 
        $queryCari = "SELECT * FROM users where email = '$email'";
        $data = mysqli_query($conn, $queryCari);
       
        if (mysqli_num_rows($data) == 0) {
            // insert data baru ke tabel users dan makan
            $sql = "INSERT INTO users (nm_user, email, password) VALUES ('$nama','$email','$password')";
            mysqli_query($conn, $sql);
            $idUsers = mysqli_insert_id($conn);
            // var_dump($idUsers);
            $sql1 = "INSERT INTO makan (id_user, jam) VALUES ('$idUsers','00:00:00')";
            mysqli_query($conn, $sql1);
        }else{
            echo "email sudah ada";
        }
        
        
     }
?>