
// Kiểm tra giỏ hàng trong localStorage
function getCart() {
    let cart = JSON.parse(localStorage.getItem('cart'));
    if (!cart) {
        cart = [];
    }
    return cart;
}

// Lưu giỏ hàng vào localStorage
function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Cập nhật số lượng giỏ hàng
function updateCartCount() {
    let cart = getCart();
    let cartCount = cart.reduce((total, product) => total + product.quantity, 0);
    document.getElementById('cart-count').textContent = cartCount;
}

// Thêm sản phẩm vào giỏ hàng
function addToCart(product) {
    let cart = getCart();

    // Kiểm tra sản phẩm đã có trong giỏ chưa
    let existingProduct = cart.find(item => item.id === product.id);
    if (existingProduct) {
        existingProduct.quantity += 1; // Tăng số lượng nếu sản phẩm đã có trong giỏ
    } else {
        cart.push(product); // Thêm sản phẩm mới vào giỏ
    }

    saveCart(cart);
    updateCartCount();
}

// Ví dụ: Thêm sản phẩm vào giỏ hàng khi nhấn nút "Mua Ngay"
document.querySelectorAll('.btn-add-to-cart').forEach(button => {
    button.addEventListener('click', (e) => {
        let productId = e.target.dataset.productId;
        let productName = e.target.dataset.productName;
        let productPrice = e.target.dataset.productPrice;

        let product = {
            id: productId,
            name: productName,
            price: productPrice,
            quantity: 1
        };

        addToCart(product);
    });
});

// Cập nhật số lượng giỏ hàng khi trang được tải
document.addEventListener('DOMContentLoaded', updateCartCount);
