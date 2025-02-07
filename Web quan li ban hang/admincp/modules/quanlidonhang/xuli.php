<?php
include ('../../config/config.php');
$madonhang = $_POST['madonhang'];
$makhachhang = $_POST['makhachhang'];
$trangthai = $_POST['trangthai'];
if(isset($_POST['themdonhang'])){
    $sql_them = "INSERT INTO donhang (madh, makh, trangthai) VALUES ('$madonhang', '$makhachhang', '$trangthai')";
    if (mysqli_query($conn, $sql_them)) {
        header('Location: ../../index.php?action=quanlidonhang&query=them');
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
}elseif(isset($_POST['suadonhang'])){
    $id = $_GET['MaDH'];
    $id_khachhang = $_GET['MaKH'];
    $sql_sua = "UPDATE donhang SET madh = '".$madonhang."', makh = '".$makhachhang."', trangthai = '".$trangthai."' WHERE madh = '".$id."' AND makh = '".$id_khachhang."'";
    mysqli_query($conn, $sql_sua);
    header('Location: ../../index.php?action=quanlidonhang&query=them');
}else{
    $id = $_GET['MaDH'];
    $id_khachhang = $_GET['MaKH'];
    $sql_xoa = "DELETE FROM donhang WHERE madh = '".$id."' AND makh = '".$id_khachhang."'";
    mysqli_query($conn, $sql_xoa);
    header('Location: ../../index.php?action=quanlidonhang&query=them');
}
?>