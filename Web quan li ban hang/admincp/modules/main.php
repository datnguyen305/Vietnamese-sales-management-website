<main class="w-full main-content">
    <?php
    if(isset($_GET['action']) && $_GET['query']){
        $page = $_GET['action'];
        $query = $_GET['query'];
    }else{
        $page = '';
        $query = '';
    }
    if ($page === 'trangchu') {
        include 'modules/quanlibanhang/lietke.php';
    } elseif ($page === 'quanlisanpham'/*menu*/  && $query === 'them') {
        include 'modules/quanlibanhang/them.php';
        include 'modules/quanlibanhang/lietke.php';
    } elseif ($page === 'quanlisanpham' && $query === 'sua') {
        include 'modules/quanlibanhang/sua.php';
    } elseif ($page == 'quanlidonhang' && $query == 'them'){
        include 'modules/quanlidonhang/them.php';
        include 'modules/quanlidonhang/lietke.php';
    } elseif ($page == 'quanlidonhang' && $query == 'sua'){
        include 'modules/quanlidonhang/sua.php';
    } elseif ($page == 'quanlikhachhang' && $query == 'them'){
        include 'modules/quanlikhachhang/them.php';
        include 'modules/quanlikhachhang/lietke.php';
    } elseif ($page == 'quanlikhachhang' && $query == 'sua'){
        include 'modules/quanlikhachhang/sua.php';
    } elseif ($page == 'chitiethoadon' && $query == 'them'){
        include 'modules/chitiethoadon/them.php';
        include 'modules/chitiethoadon/lietke.php';
    } elseif ($page == 'chitiethoadon' && $query == 'sua'){
        include 'modules/chitiethoadon/sua.php';
    } elseif ($page == 'lichsuthanhtoan' && $query == 'them'){
        include 'modules/lichsuthanhtoan/them.php';
        include 'modules/lichsuthanhtoan/lietke.php';
    } elseif ($page == 'lichsuthanhtoan' && $query == 'sua'){
        include 'modules/lichsuthanhtoan/sua.php';
    }
    else {
        include 'modules/quanlibanhang/lietke.php';
    }
    ?>
</main>