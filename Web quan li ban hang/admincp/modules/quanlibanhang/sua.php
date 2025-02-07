<?php
$sql_sua_sp = "SELECT * FROM sanpham WHERE MaSP = '$_GET[MaSP]' limit 1";
$query_sua_sp = mysqli_query($conn, $sql_sua_sp);
?>

<p class="text-2xl font-bold text-gray-800 mb-4 text-center">Sửa sản phẩm</p>
<div class="container mx-auto px-4">
    <table class="product-table border border-gray-300 shadow-md rounded-lg overflow-hidden w-full max-w-2xl mx-auto">
        <form action="modules/quanlibanhang/xuli.php?MaSP=<?php echo $_GET['MaSP']?>" method="post" class="w-full">
            <?php while ($row = mysqli_fetch_array($query_sua_sp)) { ?>
                <tbody>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Mã sản phẩm</th>
                        <td><input type="text" value="<?php echo $row['MaSP'] ?>" name="masanpham" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Tên sản phẩm</th>
                        <td><input type="text" value="<?php echo $row['TenSP'] ?>" name="tensanpham" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Giá gốc</th>
                        <td><input type="text" value="<?php echo $row['GIAGOC'] ?>" name="giagoc" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Giảm giá</th>
                        <td><input type="text" value="<?php echo $row['GiamGia'] ?>" name="giamgia" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Số lượng tồn</th>
                        <td><input type="text" value="<?php echo $row['SoLuongTon'] ?>" name="soluongton" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center py-4">
                            <button type="submit" name="suasanpham" class="bg-green-600 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-green-700 transition-all">Sửa sản phẩm</button>
                        </th>
                    </tr>
                    
                </tbody>
            <?php } ?>
        </form>
    </table>
</div>
