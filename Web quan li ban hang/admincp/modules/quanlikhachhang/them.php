<table class="product-table">
<form action="modules/quanlikhachhang/xuli.php" method="post">
        <thead>
            <tr>
            <p class="text-2xl font-bold text-gray-800 mb-4">Thêm khách hàng</p>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Mã khách hàng</th>
                <td><input type="text" name="makhachhang" placeholder="Nhập mã khách hàng" class="border border-gray-300 rounded-lg p-2 w-full"></td>
            </tr>
            <tr>
                <th>Họ tên</th>
                <td><input type="text" name="hoten" placeholder="Nhập họ tên" class="border border-gray-300 rounded-lg p-2 w-full"></td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td><input type="text" name="diachi" placeholder="Nhập địa chỉ" class="border border-gray-300 rounded-lg p-2 w-full"></td>
            </tr>
            <tr>
                <th>Số điện thoại</th>
                <td><input type="text" name="sodienthoai" placeholder="Nhập số điện thoại" class="border border-gray-300 rounded-lg p-2 w-full"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="text" name="email" placeholder="Nhập email" class="border border-gray-300 rounded-lg p-2 w-full"></td>
            </tr>
            <tr>
            <th colspan="2" class="text-center py-4">
                <button type="submit" name="themkhachhang" class="bg-green-600 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-green-700 transition-all">Thêm khách hàng</button>
            </th>
            </tr>
        </tbody>
    </form>
</table>