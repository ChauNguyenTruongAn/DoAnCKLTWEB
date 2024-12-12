<?php
include('config.php'); // Kết nối cơ sở dữ liệu

try {
    // Truy vấn dữ liệu sản phẩm từ bảng BO_SAT
    $sql = "SELECT * FROM BO_SAT";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($products) {
        foreach ($products as $product) {
            ?>
            <tr>
                <td><?php echo $product['Ma_bo_sat']; ?></td>
                <td><?php echo $product['Ten_bo_sat']; ?></td>
                <td><?php echo number_format($product['Gia'], 0, ',', '.') . ' VND'; ?></td>
                <td>
                    <?php
                    // Lấy tên danh mục từ bảng DANH_MUC (nếu cần)
                    $categoryStmt = $conn->prepare("SELECT Ten_danh_muc FROM DANH_MUC WHERE Ma_danh_muc = ?");
                    $categoryStmt->execute([$product['Ma_danh_muc']]);
                    $category = $categoryStmt->fetch(PDO::FETCH_ASSOC);
                    echo $category ? $category['Ten_danh_muc'] : 'Không có';
                    ?>
                </td>
                <td>
                    <a href="edit-product.php?id=<?php echo $product['Ma_bo_sat']; ?>" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                    <a href="delete-product.php?id=<?php echo $product['Ma_bo_sat']; ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>Không có sản phẩm nào.</td></tr>";
    }

} catch (PDOException $e) {
    echo "<tr><td colspan='5' class='text-center text-danger'>Lỗi: " . $e->getMessage() . "</td></tr>";
}
?>