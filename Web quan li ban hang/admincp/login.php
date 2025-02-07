<?php
session_start();
include ('config/config.php');

if(isset($_POST['dangnhap'])){
    $taikhoan = $_POST['taikhoan'];
    $matkhau = $_POST['matkhau'];
    $sql = "SELECT * FROM users WHERE username = '".$taikhoan."' AND password = '".$matkhau."'";
    $query = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query);
    if($num_rows == 0){
        echo '<script>alert("Tài khoản hoặc mật khẩu không đúng");</script>';
        header('Location: login.php');
    } else {
        $_SESSION['dangnhap'] = $taikhoan;
        header('Location: index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <title>Login</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md" data-aos="fade-up" data-aos-duration="1000">
    <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Đăng nhập</h2>
    <form action="" method="post">
        <div class="mb-4">
            <label for="taikhoan" class="block text-sm font-medium text-gray-600 mb-2">Tài khoản</label>
            <input type="text" id="taikhoan" name="taikhoan" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-green-300 focus:outline-none">
        </div>
        <div class="mb-4">
            <label for="matkhau" class="block text-sm font-medium text-gray-600 mb-2">Mật khẩu</label>
            <input type="password" id="matkhau" name="matkhau" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-green-300 focus:outline-none">
        </div>
        <div class="flex justify-center">
            <button type="submit" name="dangnhap" class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:ring focus:ring-green-300 focus:outline-none transition duration-200">
                Đăng nhập
            </button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
</body>
</html>
