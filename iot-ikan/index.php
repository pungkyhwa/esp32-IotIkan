<html>
<head>
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-600 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-xs">
        <form class="bg-blue-600 shadow-md rounded px-8 pt-6 pb-8 mb-4" name ="login" method="post">
            <div class="mb-4">
                <h1 class="text-white text-center text-2xl font-bold mb-6">AQU-Z</h1>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-white bg-blue-800 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" name="email" placeholder="Email">
            </div>
            <div class="mb-6">
                <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-white bg-blue-800 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="Kata Sandi">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-white text-blue-600 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit">
                    Login
                </button>
            </div>
            <div class="flex items-center justify-between mt-4">
                <a class="inline-block align-baseline font-bold text-sm text-white hover:text-blue-800" href="#">
                    Lupa kata sandi
                </a>
                <a class="inline-block align-baseline font-bold text-sm text-white hover:text-blue-800" href="daftar.php">
                    Buat akun
                </a>
            </div>
        </form>
    </div>
</body>
</html>

<?php 
    include "koneksi.php";
    session_start();
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        // cek email 
        $queryCari = "SELECT * FROM users where email = '$email' and password='$password'";
        $data = mysqli_query($conn, $queryCari);
        
        if (mysqli_num_rows($data) == 0) {
            echo "data tidak ditemukan";
        }else{
            echo "data benar silahkan masuk";
            foreach ($data as $row) {
                $_SESSION["id_user"] = $row['id_user'];
                $_SESSION["nm_user"] = $row['nm_user'];
            }  
            header('Location: dashboard.php');
        }
    }
?>