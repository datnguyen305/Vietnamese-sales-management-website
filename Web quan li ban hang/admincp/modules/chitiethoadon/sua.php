<?php
$sql_sua_cthd = "SELECT * FROM chitietdonhang WHERE MaDH = '$_GET[MaDH]' AND MaSP = '$_GET[MaSP]' AND MaCTDH = '$_GET[MaCTDH]'";
$query_sua_cthd = mysqli_query($conn, $sql_sua_cthd);
?>

<p class="text-2xl font-bold text-gray-800 mb-4 text-center">Sửa chi tiết hóa đơn</p>
<div class="container mx-auto px-4">
    <table class="product-table border border-gray-300 shadow-md rounded-lg overflow-hidden w-full max-w-2xl mx-auto">
        <form action="modules/chitiethoadon/xuli.php?MaDH=<?php echo $_GET['MaDH']?>&MaSP=<?php echo $_GET['MaSP']?>" method="post" class="w-full">
            <?php while ($row = mysqli_fetch_array($query_sua_cthd)) { ?>
                <tbody>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Mã đơn hàng</th>
                        <td><input type="text" value="<?php echo $row['MaDH'] ?>" name="madonhang" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Mã sản phẩm</th>
                        <td><input type="text" value="<?php echo $row['MaSP'] ?>" name="masanpham" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Số lượng</th>
                        <td><input type="text" value="<?php echo $row['SoLuong'] ?>" name="soluong" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center py-4">
                            <button type="submit" name="suachitiethoadon" class="bg-green-600 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-green-700 transition-all">Sửa chi tiết hóa đơn</button>
                        </th>
                    </tr>
                </tbody>
            <?php } ?>
        </form>
    </table>
</div>
