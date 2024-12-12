<div class="sorting-bar d-flex justify-content-end mb-4">
    <form method="GET" action="search_results.php" class="d-inline-block">
        <!-- Thêm tham số query vào URL để duy trì tìm kiếm khi thay đổi sắp xếp -->
        <input type="hidden" name="query" value="<?= htmlspecialchars($_GET['query']) ?>">
        <select name="sort" class="form-select" onchange="this.form.submit()">
            <option value="">Sắp xếp theo</option>
            <option value="price_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : '' ?>>Giá:
                Thấp đến Cao</option>
            <option value="price_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : '' ?>>Giá:
                Cao đến Thấp</option>
            <option value="rating" <?= isset($_GET['sort']) && $_GET['sort'] == 'rating' ? 'selected' : '' ?>>Đánh giá
            </option>
            <option value="newest" <?= isset($_GET['sort']) && $_GET['sort'] == 'newest' ? 'selected' : '' ?>>Mới nhất
            </option>
        </select>
    </form>
</div>