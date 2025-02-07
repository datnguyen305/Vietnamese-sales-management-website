<?php
include ('../../config/config.php');
$makhachhang = $_POST['makhachhang'];
$hoten = $_POST['hoten'];
$diachi = $_POST['diachi'];
$sodienthoai = $_POST['sodienthoai'];
$email = $_POST['email'];
if(isset($_POST['themkhachhang'])){
    $sql_them = "INSERT INTO khachhang (makh, hoten, diachi, sodienthoai, email) VALUES ('$makhachhang', '$hoten', '$diachi', '$sodienthoai', '$email')";
    if (mysqli_query($conn, $sql_them)) {
        header('Location: ../../index.php?action=quanlikhachhang&query=them');
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
}elseif(isset($_POST['suakhachhang'])){
    $id_khachhang = $_GET['MaKH'];
    $sql_sua = "UPDATE khachhang SET makh = '".$makhachhang."', hoten = '".$hoten."', diachi = '".$diachi."', sodienthoai = '".$sodienthoai."', email = '".$email."' WHERE makh = '".$id_khachhang."'";
    mysqli_query($conn, $sql_sua);
    header('Location: ../../index.php?action=quanlikhachhang&query=them');
}else{
    $id_khachhang = $_GET['MaKH'];
    $sql_xoa = "DELETE FROM khachhang WHERE makh = '".$id_khachhang."'";
    mysqli_query($conn, $sql_xoa);
    header('Location: ../../index.php?action=quanlikhachhang&query=them');
}
?>