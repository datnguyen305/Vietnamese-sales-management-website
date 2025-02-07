<form action="modules/quanlibanhang/xuli.php" method="post" onsubmit="return formatBeforeSubmit()">
    <p class="text-2xl font-bold text-gray-800 mb-4">Thêm sản phẩm</p>

    <table class="product-table">
        <tbody>
            <tr>
                <th>Mã sản phẩm</th>
                <td><input type="text" name="masanpham" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Nhập mã sản phẩm"></td>
            </tr>
            <tr>
                <th>Tên sản phẩm</th>
                <td><input type="text" name="tensanpham" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Nhập tên sản phẩm"></td>
            </tr>
            <tr>
                <th>Giá gốc</th>
                <td>
                    <input type="text" id="giagoc" name="giagoc" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Nhập giá gốc" oninput="formatCurrency(this)">
                </td>
            </tr>
            <tr>
                <th>Giảm giá</th>
                <td><input type="text" name="giamgia" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Nhập giảm giá"></td>
            </tr>
            <tr>
                <th>Số lượng tồn</th>
                <td><input type="text" name="soluongton" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Nhập số lượng tồn"></td>
            </tr>
            <tr>
                <th colspan="2" class="text-center py-4">
                    <button type="submit" name="themsanpham" class="bg-green-600 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-green-700 transition-all">Thêm sản phẩm</button>
                </th>
            </tr>
        </tbody>
    </table>
</form>

