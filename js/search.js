
// Hàm debounce
function debounce(func, delay) {
    let timeout;
    return function () {
        const context = this;
        const args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), delay);
    };
}

// Hàm xử lý tìm kiếm
function search(query) {
    // Gửi yêu cầu tìm kiếm (giả lập hoặc AJAX tới server)
    if (query.length > 0) {
        // Ví dụ dữ liệu giả lập
        const sampleData = [
            'Rắn Cát', 'Còi Rồng', 'Rùa Biển', 'Cá Sấu', 'Gấu Trúc', 'Mèo', 'Chó', 'Ngựa', 'Bò', 'Lợn'
        ];

        const result = sampleData.filter(item => item.toLowerCase().includes(query.toLowerCase()));

        if (result.length > 0) {
            $('#search-result').html('<ul class="list-group">' + result.map(item => `<li class="list-group-item">${item}</li>`).join('') + '</ul>');
        } else {
            $('#search-result').html('<p class="text-muted">Không tìm thấy sản phẩm phù hợp.</p>');
        }
    } else {
        $('#search-result').html('');
    }
}

// Gắn debounce cho sự kiện thay đổi của thanh tìm kiếm
$('#search-input').on('input', debounce(function () {
    const query = $(this).val();
    search(query);
}, 500));  // Thời gian debounce là 500ms
