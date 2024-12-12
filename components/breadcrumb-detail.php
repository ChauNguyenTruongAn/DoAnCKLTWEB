<?php

$result = $conn->prepare("SELECT DANH_MUC.Ten_danh_muc, BO_SAT.Ten_bo_sat 
                           FROM BO_SAT 
                           JOIN DANH_MUC ON BO_SAT.Ma_danh_muc = DANH_MUC.Ma_danh_muc
                           WHERE BO_SAT.Ma_bo_sat = ?");

$result->execute([$productId]);
$temp = $result->fetch(PDO::FETCH_ASSOC);

if ($temp) {
    $currentCategory = $temp['Ten_danh_muc'];
    $currentProduct = $temp['Ten_bo_sat'];
} else {
    // Xử lý trường hợp không có kết quả
    echo "Không có dữ liệu.";
}

?>

<nav aria-label="breadcrumb" class="mb-5">
    <ol class="breadcrumb mb-0">
        <!-- Trang chủ -->
        <li class="breadcrumb-item">
            <a href="index.php">Trang Chủ</a>
        </li>

        <!-- Danh mục sản phẩm -->
        <li class="breadcrumb-item">
            <a href="category.php" style="color: gray; text-decoration: none;">
                <?= htmlspecialchars($currentCategory) ?>
            </a>
        </li>

        <!-- Tên sản phẩm chi tiết -->
        <li class="breadcrumb-item active" aria-current="page">
            <?= htmlspecialchars($currentProduct) ?>
        </li>
    </ol>
</nav>