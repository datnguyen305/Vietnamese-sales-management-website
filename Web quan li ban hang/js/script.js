function formatCurrency(input) {
    let value = input.value.replace(/[^0-9]/g, ''); // Xóa ký tự không phải số
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Thêm dấu chấm
    input.value = value;
}

function getFormattedValue(input) {
    return input.value.replace(/\./g, ''); // Chuyển dấu chấm thành dấu phẩy
}

function formatBeforeSubmit() {
    let inputs = ['giagoc', 'sotienthanhtoan']; // Danh sách ID cần xử lý

    inputs.forEach(id => {
        let inputElement = document.getElementById(id);
        if (inputElement) {
            inputElement.value = getFormattedValue(inputElement); // Chuyển đổi trước khi gửi form
        }
    });

    return true; // Cho phép gửi form
}
