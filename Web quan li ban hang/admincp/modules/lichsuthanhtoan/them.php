<form action="modules/lichsuthanhtoan/xuli.php" method="post" onsubmit="return formatBeforeSubmit()">
<table class="product-table">
        <thead>
            <tr>
                <p class="text-2xl font-bold text-gray-800 mb-4">Thêm lịch sử thanh toán</p>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Mã đơn hàng</th>
                <td><input type="text" id="madonhang" name="madonhang" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Nhập mã đơn hàng" onkeyup="searchOrder()" autocomplete="off">
                <div id="suggestion-box" class="absolute bg-white border border-gray-300 rounded-b-lg shadow-md hidden"></div>
            </td>
            </tr>
            <tr>
                <th>Mã khách hàng</th>
                <td>
                    <input type="text" id="makhachhang" name="makhachhang" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Nhập mã khách hàng" onkeyup="searchCustomer()" autocomplete="off">
                    <div id="suggestion-box" class="absolute bg-white border border-gray-300 rounded-b-lg shadow-md hidden"></div>
                </td>
            </tr>
            <tr>
                <th>Số tiền thanh toán</th>
                <td><input type="text" id="sotienthanhtoan" name="sotienthanhtoan" class="border border-gray-300 rounded-lg p-2 w-full"  placeholder="Nhập số tiền thanh toán" oninput="formatCurrency(this)" >
            </td>
            </tr>
            <tr>
                <th colspan="2" class="text-center py-4">
                    <button type="submit" name="themlstt" class="bg-green-600 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-green-700 transition-all">Thêm lịch sử thanh toán</button>
                </th>
            </tr>
        </tbody>
</table>
</form>
