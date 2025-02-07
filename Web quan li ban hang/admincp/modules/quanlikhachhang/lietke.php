<?php
// Kết nối cơ sở dữ liệu
include dirname(__DIR__, 3) . '/admincp/config/config.php';

// Số khách hàng trên mỗi trang
$so_khach_hang_tren_trang = 10;

// Lấy giá trị tìm kiếm (nếu có)
$search_name = isset($_GET['search_name']) ? mysqli_real_escape_string($conn, $_GET['search_name']) : '';
$search_address = isset($_GET['search_address']) ? mysqli_real_escape_string($conn, $_GET['search_address']) : '';
$search_phone = isset($_GET['search_phone']) ? mysqli_real_escape_string($conn, $_GET['search_phone']) : '';
$search_email = isset($_GET['search_email']) ? mysqli_real_escape_string($conn, $_GET['search_email']) : '';

// Tính toán trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $so_khach_hang_tren_trang;

// Câu truy vấn để lấy khách hàng với tìm kiếm và bộ lọc
$sql_lietke_kh = "SELECT * FROM khachhang WHERE 1";

if ($search_name) {
    $sql_lietke_kh .= " AND HoTen LIKE '%$search_name%'";
}

if ($search_address) {
    $sql_lietke_kh .= " AND DiaChi LIKE '%$search_address%'";
}

if ($search_phone) {
    $sql_lietke_kh .= " AND SoDienThoai LIKE '%$search_phone%'";
}

if ($search_email) {
    $sql_lietke_kh .= " AND Email LIKE '%$search_email%'";
}

$sql_lietke_kh .= " ORDER BY MaKH DESC LIMIT $start_from, $so_khach_hang_tren_trang";
$query_lietke_kh = mysqli_query($conn, $sql_lietke_kh);

// Lấy tổng số khách hàng để tính số trang
$sql_total = "SELECT COUNT(*) FROM khachhang WHERE 1";
if ($search_name) {
    $sql_total .= " AND HoTen LIKE '%$search_name%'";
}
if ($search_address) {
    $sql_total .= " AND DiaChi LIKE '%$search_address%'";
}
if ($search_phone) {
    $sql_total .= " AND SoDienThoai LIKE '%$search_phone%'";
}
if ($search_email) {
    $sql_total .= " AND Email LIKE '%$search_email%'";
}

$query_total = mysqli_query($conn, $sql_total);
$row_total = mysqli_fetch_array($query_total);
$total_records = $row_total[0];
$total_pages = ceil($total_records / $so_khach_hang_tren_trang);
?>

<p class="text-2xl font-bold text-gray-800 mb-4 mt-4">Liệt kê khách hàng</p>

<!-- Thanh tìm kiếm với nhiều bộ lọc -->
<form method="GET" class="mb-4 flex gap-4">
    <input type="hidden" name="action" value="quanlikhachhang">
    <input type="hidden" name="query" value="lietke">

    <!-- Tìm kiếm theo tên khách hàng -->
    <input type="text" name="search_name" placeholder="Tìm theo tên khách hàng" value="<?php echo htmlspecialchars($search_name); ?>" class="border border-gray-300 rounded-md p-2">

    <!-- Tìm kiếm theo địa chỉ -->
    <input type="text" name="search_address" placeholder="Tìm theo địa chỉ" value="<?php echo htmlspecialchars($search_address); ?>" class="border border-gray-300 rounded-md p-2">

    <!-- Tìm kiếm theo số điện thoại -->
    <input type="text" name="search_phone" placeholder="Tìm theo số điện thoại" value="<?php echo htmlspecialchars($search_phone); ?>" class="border border-gray-300 rounded-md p-2">

    <!-- Tìm kiếm theo email -->
    <input type="text" name="search_email" placeholder="Tìm theo email" value="<?php echo htmlspecialchars($search_email); ?>" class="border border-gray-300 rounded-md p-2">

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Tìm kiếm</button>
</form>

<div class="overflow-x-auto">
    <table class="product-table table-auto min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Mã khách hàng</th>
                <th class="px-4 py-2 border">Họ tên</th>
                <th class="px-4 py-2 border">Địa chỉ</th>
                <th class="px-4 py-2 border">Số điện thoại</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Tiền nợ</th>
                <th class="px-4 py-2 border">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query_lietke_kh)) { ?>
                <tr>
                    <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['MaKH']); ?></td>
                    <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['HoTen']); ?></td>
                    <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['DiaChi']); ?></td>
                    <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['SoDienThoai']); ?></td>
                    <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['Email']); ?></td>
                    <td class="px-4 py-2 border"><?php echo htmlspecialchars($row['TienNo']); ?></td>
                    <td class="px-4 py-2 border">
                        <a href="modules/quanlikhachhang/xuli.php?MaKH=<?php echo $row['MaKH'] ?>" class="text-blue-500 hover:underline">Xóa</a> |
                        <a href="?action=quanlikhachhang&query=sua&MaKH=<?php echo $row['MaKH'] ?>" class="text-blue-500 hover:underline">Sửa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Phân trang -->
<div class="pagination mt-4 border border-gray-300 p-2 rounded-lg flex gap-2 justify-center">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <a href="?action=quanlikhachhang&query=lietke&page=<?php echo $i; ?>&search_name=<?php echo urlencode($search_name); ?>&search_address=<?php echo urlencode($search_address); ?>&search_phone=<?php echo urlencode($search_phone); ?>&search_email=<?php echo urlencode($search_email); ?>"
           class="pagination-link px-3 py-1 border border-gray-300 rounded-md hover:bg-gray-200 transition">
            <?php echo $i; ?>
        </a>
    <?php } ?>
</div>
