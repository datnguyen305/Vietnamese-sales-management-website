<?php
include ('../../config/config.php');

$sql_sua_lstt = "SELECT * FROM lichsuthanhtoan WHERE MaLSTT = '$_GET[MaLSTT]' limit 1";
$query_sua_lstt = mysqli_query($conn, $sql_sua_lstt);
?>

<p class="text-2xl font-bold text-gray-800 mb-4 text-center">Sửa lịch sử thanh toán</p>
<div class="container mx-auto px-4">
    <table class="product-table border border-gray-300 shadow-md rounded-lg overflow-hidden w-full max-w-2xl mx-auto">
        <form action="modules/lichsuthanhtoan/xuli.php?MaLSTT=<?php echo htmlspecialchars($_GET['MaLSTT']); ?>" method="post" class="w-full">
            <?php while ($row = mysqli_fetch_array($query_sua_lstt)) { ?>
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
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Ngày thanh toán</th>
                        <td><input type="date" value="<?php echo $row['NgayThanhToan'] ?>" name="ngaythanhtoan" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th class="bg-gray-200 p-3 text-gray-700 text-left w-1/3">Số tiền thanh toán</th>
                        <td><input type="number" value="<?php echo $row['SoTienThanhToan'] ?>" name="sotienthanhtoan" class="border border-gray-300 rounded-lg p-2 w-full"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center py-4">
                            <button type="submit" name="sualstt" class="bg-green-600 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-green-700 transition-all">Sửa lịch sử thanh toán</button>
                        </th>
                    </tr>
                </tbody>
            <?php } ?>
        </form>
    </table>
</div>