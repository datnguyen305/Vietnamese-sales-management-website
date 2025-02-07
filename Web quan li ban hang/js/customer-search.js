function searchCustomer() {
    let input = document.getElementById("makhachhang").value;
    let suggestionBox = document.getElementById("suggestion-box");

    if (input.length === 0) {
        suggestionBox.classList.add("hidden");
        return;
    }

fetch("modules/quanlidonhang/search_customer.php?query=" + input)
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

function selectCustomer(value) {
    document.getElementById("makhachhang").value = value;
    document.getElementById("suggestion-box").classList.add("hidden");
}
