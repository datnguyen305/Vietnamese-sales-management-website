<?php
include ('../../config/config.php');
$masanpham = $_POST['masanpham'];
$tensanpham = $_POST['tensanpham'];
$giagoc = $_POST['giagoc'];
$soluongton = $_POST['soluongton'];
$giamgia = $_POST['giamgia'];
if(isset($_POST['themsanpham'])){
    $sql_them = "INSERT INTO sanpham (masp, tensp, GIAGOC, soluongton, giamgia) VALUES ('$masanpham', '$tensanpham', '$giagoc', '$soluongton', '$giamgia')";
    if (mysqli_query($conn, $sql_them)) {
        header('Location: ../../index.php?action=quanlisanpham&query=them');
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
}elseif(isset($_POST['suasanpham'])){
    $id = $_GET['MaSP'];
    $sql_sua = "UPDATE sanpham SET masp = '".$masanpham."', tensp = '".$tensanpham."', giagoc = '".$giagoc."', soluongton = '".$soluongton."', giamgia = '".$giamgia."' WHERE masp = '".$id."'";
    mysqli_query($conn, $sql_sua);
    header('Location: ../../index.php?action=quanlisanpham&query=them');
}else{
    $id = $_GET['MaSP'];
    $sql_xoa = "DELETE FROM sanpham WHERE masp = '".$id."'";
    mysqli_query($conn, $sql_xoa);
    header('Location: ../../index.php?action=quanlisanpham&query=them');
}
?>