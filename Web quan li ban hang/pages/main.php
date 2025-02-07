<main class="main-content">
    <?php
    if(isset($_GET['action']) && $_GET['query']){
        $page = $_GET['action'];
        $query = $_GET['query'];
    }else{
        $page = '';
        $query = '';
    }
    if ($page === 'trangchu') {
        include 'admincp/modules/quanlibanhang/lietke.php';
    } elseif ($page === 'quanlisanpham'/*menu*/  && $query === 'them') {
        include 'admincp/modules/quanlibanhang/them.php';
        include 'admincp/modules/quanlibanhang/lietke.php';
    } elseif ($page === 'quanlisanpham' && $query === 'sua') {
        include 'admincp/modules/quanlibanhang/sua.php';
    } elseif ($page == 'quanlidonhang' && $query == 'them'){
        include 'admincp/modules/quanlidonhang/them.php';
        include 'admincp/modules/quanlidonhang/lietke.php';
    } elseif ($page == 'quanlidonhang' && $query == 'sua'){
        include 'admincp/modules/quanlidonhang/sua.php';
    } elseif ($page == 'quanlikhachhang' && $query == 'them'){
        include 'admincp/modules/quanlikhachhang/them.php';
        include 'admincp/modules/quanlikhachhang/lietke.php';
    } elseif ($page == 'quanlikhachhang' && $query == 'sua'){
        include 'admincp/modules/quanlikhachhang/sua.php';
    } elseif ($page == 'chitiethoadon' && $query == 'them'){
        include 'admincp/modules/chitiethoadon/them.php';
        include 'admincp/modules/chitiethoadon/lietke.php';
    } elseif ($page == 'chitiethoadon' && $query == 'sua'){
        include 'admincp/modules/chitiethoadon/sua.php';
    } 
    else {
        echo "<p>Chào mừng bạn đến với hệ thống quản lý bán hàng!</p>";
    }
    ?>
</main>