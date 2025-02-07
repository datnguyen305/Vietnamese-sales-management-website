<?php
$sql_sua_kh = "SELECT * FROM khachhang WHERE MaKH = '$_GET[MaKH]' limit 1";
$query_sua_kh = mysqli_query($conn, $sql_sua_kh);
?>

<p class="text-2xl font-bold text-gray-800 mb-4 text-center">Sửa khách hàng</p>
<div class="container mx-auto px-4">
    <table class="product-table border border-gray-300 shadow-md rounded-lg overflow-hidden w-full max-w-2xl mx-auto">
        <form action="modules/quanlikhachhang/xuli.php?MaKH=<?php echo $_GET['MaKH']?>" method="post" class="w-full">
            <?php while ($row = mysqli_fetch_array($query_sua_kh)) { ?>
                <tbody>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Mã khách hàng</th>
                        <td><input type="text" value="<?php echo $row['MaKH'] ?>" name="makhachhang" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Họ tên</th>
                        <td><input type="text" value="<?php echo $row['HoTen'] ?>" name="hoten" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Địa chỉ</th>
                        <td><input type="text" value="<?php echo $row['DiaChi'] ?>" name="diachi" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Số điện thoại</th>
                        <td><input type="text" value="<?php echo $row['SoDienThoai'] ?>" name="sodienthoai" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Email</th>
                        <td><input type="text" value="<?php echo $row['Email'] ?>" name="email" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center py-4">
                            <button type="submit" name="suakhachhang" class="bg-green-600 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-green-700 transition-all">Sửa khách hàng</button>
                        </th>
                    </tr>
                </tbody>
            <?php } ?>
        </form>
    </table>
</div>
