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
?>

<div class="sidebar p-3 bg-light">
    <h4 class="text-center">Bộ Lọc</h4>
    <form method="GET" action="search_results.php">
        <input type="hidden" name="query" value="<?= htmlspecialchars($query) ?>">
        <div class="mb-3">
            <label for="category" class="form-label">Danh Mục</label>
            <select class="form-select" id="category" name="category">
                <option value="">Tất cả</option>
                <?php foreach ($categories as $categoryOption): ?>
                    <option value="<?php echo $categoryOption['Ma_danh_muc']; ?>"
                    <?php echo isset($category) && $category == $categoryOption['Ma_danh_muc'] ? 'selected' : ''; ?>>
                        <?php echo $categoryOption['Ten_danh_muc']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="priceRange" class="form-label">Khoảng Giá</label>
            <div class="d-flex align-items-center">
                <input type="number" class="form-control me-2" placeholder="Từ" name="price_min" min="<?php echo $priceRange['min_price']; ?>" value="<?= isset($priceMin) ? $priceMin : '' ?>">
                <input type="number" class="form-control" placeholder="Đến" name="price_max" max="<?php echo $priceRange['max_price']; ?>" value="<?= isset($priceMax) ? $priceMax : '' ?>">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Đánh Giá</label>
            <div>
                <input type="radio" id="rating5" name="rating" value="5" <?= isset($rating) && $rating == '5' ? 'checked' : ''; ?>>
                <label for="rating5">5 sao</label><br>
                <input type="radio" id="rating4" name="rating" value="4" <?= isset($rating) && $rating == '4' ? 'checked' : ''; ?>>
                <label for="rating4">4 sao trở lên</label><br>
                <input type="radio" id="rating3" name="rating" value="3" <?= isset($rating) && $rating == '3' ? 'checked' : ''; ?>>
                <label for="rating3">3 sao trở lên</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Lọc</button>
    </form>
</div>
