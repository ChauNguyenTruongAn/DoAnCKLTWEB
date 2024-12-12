<!-- components/sidebar.php -->
<div class="sidebar">
    <div class="filter">
        <h5>Danh mục</h5>
        <form method="GET" action="products.php" class="d-flex flex-column">
            <select name="category" id="category" class="form-select mb-3" onchange="this.form.submit()">
                <option value="">Tất cả danh mục</option>
                <?php
                include('config.php');
                $sql = "SELECT * FROM DANH_MUC";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categories as $category) {
                    echo '<option value="' . $category['Ma_danh_muc'] . '" ' . 
                         (isset($_GET['category']) && $_GET['category'] == $category['Ma_danh_muc'] ? 'selected' : '') . 
                         '>' . htmlspecialchars($category['Ten_danh_muc']) . '</option>';
                }
                ?>
            </select>
        </form>
    </div>
</div>
