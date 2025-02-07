<?php
include ('../../config/config.php');

$madonhang = $_POST['madonhang'];
$makhachhang = $_POST['makhachhang'];
$sotienthanhtoan = $_POST['sotienthanhtoan'];

if(isset($_POST['themlstt'])){
    $sql_them = "INSERT INTO lichsuthanhtoan (MaDH, MaKH, SoTienThanhToan) VALUES ('$madonhang', '$makhachhang', '$sotienthanhtoan')";
    if (mysqli_query($conn, $sql_them)) {
        header('Location: ../../index.php?action=lichsuthanhtoan&query=them');
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}elseif(isset($_POST['sualstt'])){
    $id = $_GET['MaLSTT'];
    $sql_sua = "UPDATE lichsuthanhtoan SET MaDH = '$madonhang', MaKH = '$makhachhang', NgayThanhToan = '$ngaythanhtoan', SoTienThanhToan = '$sotienthanhtoan' WHERE MaLSTT = '$id'";
    mysqli_query($conn, $sql_sua);
    header('Location: ../../index.php?action=lichsuthanhtoan&query=them');
}else{
    $id = $_GET['MaLSTT'];
    $sql_xoa = "DELETE FROM lichsuthanhtoan WHERE MaLSTT = '$id'";
    mysqli_query($conn, $sql_xoa);
    header('Location: ../../index.php?action=lichsuthanhtoan&query=them');
}
?>