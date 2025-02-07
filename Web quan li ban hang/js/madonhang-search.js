function searchOrder() {
    let input = document.getElementById("madonhang").value;
    let suggestionBox = document.getElementById("suggestion-box");

    if (input.length === 0) {
        suggestionBox.classList.add("hidden");
        return;
    }

    fetch("modules/chitiethoadon/search_order.php?query=" + input)
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

function selectOrder(value) {
    document.getElementById("madonhang").value = value;
    document.getElementById("suggestion-box").classList.add("hidden");
}
