<table class="product-table">
    <form action="modules/quanlidonhang/xuli.php" method="post">
        <thead>
            <tr>
                <p class="text-2xl font-bold text-gray-800 mb-4">Thêm đơn hàng</p>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Mã đơn hàng</th>
                <td><input type="text" name="madonhang" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Tìm mã đơn hàng"></td>
            </tr>
            <tr>
                <th >Mã khách hàng</th>
                <td>
                    <input type="text" id="makhachhang" name="makhachhang" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Tìm mã khách hàng" onkeyup="searchCustomer()" autocomplete="off">
                    <div id="suggestion-box" class="absolute bg-white border border-gray-300 rounded-b-lg shadow-md hidden"></div>

                </td>
            </tr>
            <tr>
                <th >Trạng thái</th>
                <td>
                    <select name="trangthai" class="border border-gray-300 rounded-lg p-2 w-full">
                        <option value="Dang no">Đang nợ</option>
                        <option value="Da Thanh Toan">Đã thanh toán</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th colspan="2" class="text-center py-4">
                    <button type="submit" name="themdonhang" class="bg-green-600 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-green-700 transition-all">Thêm đơn hàng</button>
                </th>
            </tr>
        </tbody>
    </form>
</table>
