
    <table class="product-table">
        <form action="modules/chitiethoadon/xuli.php" method="post">
            <thead>
                <tr>
                <p class="text-2xl font-bold text-gray-800 mb-4">Thêm chi tiết đơn hàng</p>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Mã đơn hàng</th>
                    <td><input type="text" id="madonhang" name="madonhang" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Tìm mã đơn hàng" onkeyup="searchOrder()" autocomplete="off">
<div id="suggestion-box" class="absolute bg-white border border-gray-300 rounded-b-lg shadow-md hidden"></div>
</td>
                </tr>
                <tr>
                    <th>Mã sản phẩm</th>
                    <td><input type="text" id="masanpham" name="masanpham" oninput="searchProduct()" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Tìm mã sản phẩm">
<div id="suggestion-box" class="absolute bg-white border border-gray-300 rounded-lg shadow-md hidden"></div>
</td>
                </tr>
                <tr>
                    <th>Số lượng</th>
                    <td><input type="text" name="soluong" class="border border-gray-300 rounded-lg p-2 w-full" placeholder="Nhập số lượng"></td>
                </tr>
                <tr>
                    <th colspan="2" class="text-center py-4">
                        <button type="submit" name="themchitietdonhang" class="bg-green-600 text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-green-700 transition-all">Thêm chi tiết đơn hàng</button>
                    </th>
                </tr>
            </tbody>
        </form>
    </table>

