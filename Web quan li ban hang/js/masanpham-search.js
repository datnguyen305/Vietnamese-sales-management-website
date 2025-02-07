function searchProduct() {
    let input = document.getElementById("masanpham").value;  // Tìm theo mã sản phẩm
    let suggestionBox = document.getElementById("suggestion-box");

    if (input.length === 0) {
        suggestionBox.classList.add("hidden");
        return;
    }

    fetch("modules/chitiethoadon/search_product.php?query=" + input)  // Thay đổi URL đến search_product.php
        .then(response => response.text())
        .then(data => {
            if (data.trim() !== "") {
                suggestionBox.innerHTML = data;
                suggestionBox.classList.remove("hidden");
            } else {
                suggestionBox.classList.add("hidden");
            }
        });
}

function selectProduct(value) {
    document.getElementById("masanpham").value = value;
    document.getElementById("suggestion-box").classList.add("hidden");
}
