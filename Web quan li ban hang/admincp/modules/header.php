<?php
if(isset($_GET['dangxuat']) && $_GET['dangxuat']==1){
unset($_SESSION['dangnhap']);
header('Location:login.php');
}
?>
<header class="bg-green-600 text-white w-full py-6 shadow-lg">
    <div class="container mx-auto flex justify-between items-center px-4">
        <!-- Tiêu đề -->
        <h1 class="text-4xl font-bold uppercase">
            Hệ thống quản lí bán hàng
        </h1>

        <!-- Nút Đăng xuất -->
        <li class="list-none">
            <a href="index.php?dangxuat=1" class="text-sm bg-white text-green-600 py-2 px-4 rounded-lg shadow hover:bg-green-100 transition duration-200">
                Đăng xuất: 
                <?php if (isset($_SESSION['dangnhap'])) {
                    echo $_SESSION['dangnhap'];
                } ?>
            </a>
        </li>
    </div>
</header>

