<?php
$sql_sua_dh = "SELECT * FROM donhang WHERE MaDH = '$_GET[MaDH]' limit 1";
$query_sua_dh = mysqli_query($conn, $sql_sua_dh);
?>

<p class="text-2xl font-bold text-gray-800 mb-4 text-center">Sửa đơn hàng</p>
<div class="container mx-auto px-4">
    <table class="product-table border border-gray-300 shadow-md rounded-lg overflow-hidden w-full max-w-2xl mx-auto">
        <form action="modules/quanlidonhang/xuli.php?MaDH=<?php echo htmlspecialchars($_GET['MaDH']); ?>&MaKH=<?php echo htmlspecialchars($_GET['MaKH']); ?>" method="post" class="w-full">
            <?php while ($row = mysqli_fetch_array($query_sua_dh)) { ?>
                <tbody>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Mã đơn hàng</th>
                        <td><input type="text" value="<?php echo $row['MaDH'] ?>" name="madonhang" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Mã khách hàng</th>
                        <td><input type="text" value="<?php echo $row['MaKH'] ?>" name="makhachhang" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Trạng thái</th>
                        <td><input type="text" value="<?php echo $row['TrangThai'] ?>" name="trangthai" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center py-4">
                            <button type="submit" name="suadonhang" class="bg-green-600 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-green-700 transition-all">Sửa đơn hàng</button>
                        </th>
                    </tr>
                </tbody>
            <?php } ?>
        </form>
    </table>
</div>
