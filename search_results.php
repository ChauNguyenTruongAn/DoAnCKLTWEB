<?php
include('config.php');

// Lấy tham số từ URL (nếu có)
$query = $_GET['query'] ?? '';
$sort = $_GET['sort'] ?? '';  // Lấy giá trị sắp xếp từ tham số sort
$category = $_GET['category'] ?? '';  // Lọc theo danh mục
$priceMin = $_GET['price_min'] ?? '';  // Lọc theo giá thấp nhất
$priceMax = $_GET['price_max'] ?? '';  // Lọc theo giá cao nhất
$rating = $_GET['rating'] ?? '';  // Lọc theo đánh giá

// Lấy danh mục sản phẩm từ CSDL
$sql = "SELECT * FROM DANH_MUC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Lấy khoảng giá từ CSDL
$sql = "SELECT MIN(Gia) AS min_price, MAX(Gia) AS max_price FROM BO_SAT";
$stmt = $conn->prepare($sql);
$stmt->execute();
$priceRange = $stmt->fetch(PDO::FETCH_ASSOC);

// Khởi tạo phần WHERE cho truy vấn
$whereClauses = [];
$whereClauses[] = "(BO_SAT.Ten_bo_sat LIKE :query OR BO_SAT.Mo_ta LIKE :query)";

// Lọc theo danh mục
if ($category) {
    $whereClauses[] = "BO_SAT.Ma_danh_muc = :category";
}

// Lọc theo khoảng giá
if ($priceMin && $priceMax) {
    $whereClauses[] = "BO_SAT.Gia BETWEEN :price_min AND :price_max";
} elseif ($priceMin) {
    $whereClauses[] = "BO_SAT.Gia >= :price_min";
} elseif ($priceMax) {
    $whereClauses[] = "BO_SAT.Gia <= :price_max";
}

// Lọc theo đánh giá
if ($rating) {
    $whereClauses[] = "COALESCE(CEILING(AVG(DANH_GIA.Sao)), 0) >= :rating";
}

$whereSql = implode(" AND ", $whereClauses);

// Khởi tạo phần ORDER BY
$orderBy = '';
switch ($sort) {
    case 'price_asc':
        $orderBy = 'ORDER BY BO_SAT.Gia ASC';
        break;
    case 'price_desc':
        $orderBy = 'ORDER BY BO_SAT.Gia DESC';
        break;
    case 'rating':
        $orderBy = 'ORDER BY Sao DESC';
        break;
    case 'newest':
        $orderBy = 'ORDER BY BO_SAT.Ngay_nhap DESC';
        break;
    default:
        $orderBy = 'ORDER BY BO_SAT.Ma_bo_sat DESC';
}

// Phân trang
$limit = 12;
$page = isset($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Truy vấn tìm kiếm với bộ lọc và sắp xếp
$sql = "SELECT 
            BO_SAT.Ma_bo_sat, 
            BO_SAT.Ten_bo_sat, 
            BO_SAT.Gia, 
            BO_SAT.Mo_ta, 
            (SELECT Duong_dan_anh 
             FROM ANH 
             WHERE ANH.Ma_bo_sat = BO_SAT.Ma_bo_sat 
             LIMIT 1) AS Duong_dan_anh, 
            DANH_MUC.Ten_danh_muc,
            COALESCE(CEILING(AVG(DANH_GIA.Sao)), 0) AS Sao,
            COUNT(DANH_GIA.Ma_bo_sat) AS So_luong_danh_gia
        FROM BO_SAT
        LEFT JOIN DANH_GIA ON BO_SAT.Ma_bo_sat = DANH_GIA.Ma_bo_sat
        JOIN DANH_MUC ON BO_SAT.Ma_danh_muc = DANH_MUC.Ma_danh_muc
        WHERE $whereSql
        GROUP BY BO_SAT.Ma_bo_sat, BO_SAT.Ten_bo_sat, BO_SAT.Gia, BO_SAT.Mo_ta, DANH_MUC.Ten_danh_muc
        HAVING COALESCE(CEILING(AVG(DANH_GIA.Sao)), 0) >= 3
        $orderBy
        LIMIT :limit OFFSET :offset";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);

// Gắn các tham số vào truy vấn
if ($category) {
    $stmt->bindValue(':category', $category, PDO::PARAM_INT);
}
if ($priceMin) {
    $stmt->bindValue(':price_min', $priceMin, PDO::PARAM_INT);
}
if ($priceMax) {
    $stmt->bindValue(':price_max', $priceMax, PDO::PARAM_INT);
}
if ($rating) {
    $stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
}

$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tính tổng số trang
$countSql = "SELECT COUNT(*) AS total 
            FROM BO_SAT
            LEFT JOIN DANH_GIA ON BO_SAT.Ma_bo_sat = DANH_GIA.Ma_bo_sat
            JOIN DANH_MUC ON BO_SAT.Ma_danh_muc = DANH_MUC.Ma_danh_muc
            WHERE $whereSql";

$countStmt = $conn->prepare($countSql);
$countStmt->bindValue(':query', "%$query%", PDO::PARAM_STR);

if ($category) {
    $countStmt->bindValue(':category', $category, PDO::PARAM_INT);
}
if ($priceMin) {
    $countStmt->bindValue(':price_min', $priceMin, PDO::PARAM_INT);
}
if ($priceMax) {
    $countStmt->bindValue(':price_max', $priceMax, PDO::PARAM_INT);
}
if ($rating) {
    $countStmt->bindValue(':rating', $rating, PDO::PARAM_INT);
}

$countStmt->execute();
$total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
$totalPages = ceil($total / $limit);
?>

<?php include('components/header.php'); ?>

<!-- Nội dung chính của trang -->
<div class="container mt-4">
    <?php include('components/breadcrumb.php'); ?>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <?php include('components/sidebar.php'); ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Thanh Sắp Xếp -->
            <div class="sorting-bar d-flex justify-content-end mb-4">
                <form method="GET" action="search_results.php" class="d-inline-block">
                    <input type="hidden" name="query" value="<?= htmlspecialchars($query) ?>">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="">Sắp xếp theo</option>
                        <option value="price_asc" <?= isset($sort) && $sort == 'price_asc' ? 'selected' : '' ?>>Giá: Thấp
                            đến Cao</option>
                        <option value="price_desc" <?= isset($sort) && $sort == 'price_desc' ? 'selected' : '' ?>>Giá: Cao
                            đến Thấp</option>
                        <option value="rating" <?= isset($sort) && $sort == 'rating' ? 'selected' : '' ?>>Đánh giá</option>
                        <option value="newest" <?= isset($sort) && $sort == 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                    </select>
                </form>
            </div>

            <div class="product-grid container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                    <?php
                    if ($products) {
                        foreach ($products as $product) {
                            include 'components/product-card.php'; // Gọi card sản phẩm
                        }
                    } else {
                        echo "<p>Không tìm thấy sản phẩm nào với từ khóa: <strong>" . htmlspecialchars($query) . "</strong></p>";
                    }
                    ?>
                </div>
            </div>

            <!-- Phân trang -->
            <?php if ($totalPages > 1): ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link"
                                    href="?query=<?= urlencode($query) ?>&sort=<?= urlencode($sort) ?>&page=<?= $page - 1 ?>">Trước</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                                <a class="page-link"
                                    href="?query=<?= urlencode($query) ?>&sort=<?= urlencode($sort) ?>&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link"
                                    href="?query=<?= urlencode($query) ?>&sort=<?= urlencode($sort) ?>&page=<?= $page + 1 ?>">Tiếp</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('components/footer.php'); ?>