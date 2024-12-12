<!-- components/sorting.php -->
<div class="sorting mb-3">
    <form method="GET" action="products.php" class="d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <label for="sort" class="me-2">Sắp xếp:</label>
                <select name="sort" class="form-select me-2" onchange="this.form.submit()">
                    <option value="default" <?= isset($_GET['sort']) && $_GET['sort'] == 'default' ? 'selected' : '' ?>>Mặc định</option>
                    <option value="price" <?= isset($_GET['sort']) && $_GET['sort'] == 'price' ? 'selected' : '' ?>>Giá</option>
                    <option value="rating" <?= isset($_GET['sort']) && $_GET['sort'] == 'rating' ? 'selected' : '' ?>>Đánh giá</option>
                </select>
            </div>

            <div class="d-flex">
                <label for="order" class="me-2">Thứ tự:</label>
                <select name="order" class="form-select" onchange="this.form.submit()">
                    <option value="asc" <?= isset($_GET['order']) && $_GET['order'] == 'asc' ? 'selected' : '' ?>>Tăng dần</option>
                    <option value="desc" <?= isset($_GET['order']) && $_GET['order'] == 'desc' ? 'selected' : '' ?>>Giảm dần</option>
                </select>
            </div>
        </div>
    </form>
</div>
