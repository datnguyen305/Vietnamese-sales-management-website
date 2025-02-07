<?php
include ('../../config/config.php');
$mahoadon = $_POST['madonhang'];
$masanpham = $_POST['masanpham'];
$soluong = $_POST['soluong'];
if(isset($_POST['themchitietdonhang'])){
    $sql_them = "INSERT INTO chitietdonhang (madh, masp, soluong, thanhtien) VALUES ('".$mahoadon."', '".$masanpham."', '".$soluong."',0)";
        if (mysqli_query($conn, $sql_them)) {
        header('Location: ../../index.php?action=chitiethoadon&query=them');
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
}elseif(isset($_POST['suachitiethoadon'])){
    $id = $_GET['MaDH'];
    $id_sp = $_GET['MaSP'];
    $sql_sua = "UPDATE chitietdonhang SET madh = '".$mahoadon."', masp = '".$masanpham."', soluong = '".$soluong."' WHERE madh = '".$id."' AND masp = '".$id_sp."'";
    mysqli_query($conn, $sql_sua);
    header('Location: ../../index.php?action=chitiethoadon&query=them');
}else{
    $id = $_GET['MaDH'];
    $id_sp = $_GET['MaSP'];
    $sql_xoa = "DELETE FROM chitietdonhang WHERE madh = '".$id."' AND masp = '".$id_sp."'";
    mysqli_query($conn, $sql_xoa);
    header('Location: ../../index.php?action=chitiethoadon&query=them');
}
?>