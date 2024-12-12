<?php
ob_start();
session_start(); // Đảm bảo session được bắt đầu

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['Ma_khach_hang']) || empty($_SESSION['Ma_khach_hang'])) {
    // Lưu thông báo vào session và chuyển hướng đến trang login
    $_SESSION['message'] = "Bạn cần phải đăng nhập để truy cập giỏ hàng!";
    header("Location: login.php");
    exit(); // Dừng script lại sau khi chuyển hướng
}

include("config.php");
include("components/header.php");

// Lấy mã khách hàng từ session
$customerId = $_SESSION['Ma_khach_hang'];

// Lấy hoặc tạo mã giỏ hàng
$stmt = $conn->prepare("SELECT Ma_gio_hang FROM GIO_HANG WHERE Ma_khach_hang = :customerId");
$stmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $cartId = $result['Ma_gio_hang'];
} else {
    // Tạo giỏ hàng mới nếu chưa có
    $stmt = $conn->prepare("INSERT INTO GIO_HANG (Ma_khach_hang) VALUES (:customerId)");
    $stmt->bindParam(':customerId', $customerId, PDO::PARAM_INT);
    $stmt->execute();
    $cartId = $conn->lastInsertId();  // Lấy ID của giỏ hàng vừa tạo
}

// Xử lý cập nhật số lượng sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_quantity') {
    $productId = $_POST['product_id'];
    $newQuantity = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE CHI_TIET_GIO_HANG SET So_luong = :quantity WHERE Ma_bo_sat = :productId AND Ma_gio_hang = :cartId");
    $stmt->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Tính tổng giá trị giỏ hàng
        $stmt = $conn->prepare("
            SELECT SUM(bs.Gia * cth.So_luong) AS total
            FROM CHI_TIET_GIO_HANG cth
            JOIN BO_SAT bs ON cth.Ma_bo_sat = bs.Ma_bo_sat
            WHERE cth.Ma_gio_hang = :cartId");
        $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $result['total'] ?? 0;

        echo json_encode(['total' => number_format($total, 0, ',', '.') . ' VND']);
    } else {
        echo json_encode(['error' => 'Lỗi khi cập nhật số lượng.']);
    }
    exit;
}

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['remove'])) {
    $productId = $_GET['remove'];
    $stmt = $conn->prepare("DELETE FROM CHI_TIET_GIO_HANG WHERE Ma_bo_sat = :productId AND Ma_gio_hang = :cartId");
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
    if ($stmt->execute()) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Lỗi khi xóa sản phẩm.";
    }
}

// Lấy sản phẩm trong giỏ hàng từ cơ sở dữ liệu
$cart = [];
$total = 0;
$stmt = $conn->prepare("
    SELECT 
        bs.Ten_bo_sat AS name, 
        A.Duong_dan_anh AS image, 
        bs.Gia AS price, 
        cth.So_luong AS quantity, 
        cth.Ma_bo_sat AS id
    FROM CHI_TIET_GIO_HANG cth
    JOIN BO_SAT bs ON cth.Ma_bo_sat = bs.Ma_bo_sat
    LEFT JOIN ANH A ON A.Ma_bo_sat = bs.Ma_bo_sat AND A.Ma_anh = 1  -- Lấy ảnh đại diện
    WHERE cth.Ma_gio_hang = :cartId");

$stmt->bindParam(':cartId', $cartId, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    $row['total'] = $row['price'] * $row['quantity'];
    $cart[] = $row;
    $total += $row['total'];
}
?>

<!-- Giao diện giỏ hàng -->
<div class="container py-5" style="min-height: 100vh;">
    <h2 class="text-center mb-4">Giỏ Hàng Của Bạn</h2>

    <?php if (empty($cart)): ?>
        <div class="alert alert-warning text-center" role="alert">
            Giỏ hàng của bạn hiện tại chưa có sản phẩm.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <form action="cart.php" method="POST" id="cart-form">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $product): ?>
                            <tr>
                                <td>
                                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"
                                        class="img-fluid" style="width: 50px; height: auto; margin-right: 10px;">
                                    <?php echo $product['name']; ?>
                                </td>
                                <td>
                                    <input type="number" class="form-control quantity"
                                        value="<?php echo $product['quantity']; ?>" min="1"
                                        data-product-id="<?php echo $product['id']; ?>" style="width: 80px;">
                                </td>
                                <td><?php echo number_format($product['price'], 0, ',', '.') . ' VND'; ?></td>
                                <td><?php echo number_format($product['total'], 0, ',', '.') . ' VND'; ?></td>
                                <td><a href="cart.php?remove=<?php echo $product['id']; ?>"
                                        class="btn btn-danger btn-sm">Xóa</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-end">
                    <h4 class="fw-bold" id="total-price">Tổng cộng:
                        <?php echo number_format($total, 0, ',', '.') . ' VND'; ?>
                    </h4>
                    <button type="submit" class="btn btn-primary btn-lg">Cập nhật giỏ hàng</button>
                </div>
            </form>
        </div>

        <div class="text-end mt-4">
            <a href="checkout.php" class="btn btn-success btn-lg">Thanh toán
                (<?php echo number_format($total, 0, ',', '.') . ' VND'; ?>)</a>
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Lắng nghe sự kiện thay đổi số lượng sản phẩm
        $(".quantity").on("change", function () {
            var quantity = $(this).val();
            var productId = $(this).data("product-id");

            // Gửi yêu cầu AJAX để cập nhật giỏ hàng
            $.ajax({
                url: "cart.php",
                method: "POST",
                data: {
                    action: "update_quantity",
                    quantity: quantity,
                    product_id: productId
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    // Cập nhật tổng cộng khi giỏ hàng thay đổi
                    $("#total-price").text("Tổng cộng: " + data.total);
                }
            });
        });
    });
</script>

<?php ob_end_flush();
include('components/footer.php'); ?>