<div class="product-grid">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php
        include('config.php'); // Kết nối cơ sở dữ liệu
        
        try {
            // Phân trang
            $limit = 12; // Số sản phẩm trên mỗi trang
            $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int) $_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            // Lọc và sắp xếp
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
            $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
            $category = isset($_GET['category']) ? (int) $_GET['category'] : null;

            // Lấy sản phẩm
            $sql = "SELECT 
                        BO_SAT.Ma_bo_sat, 
                        BO_SAT.Ten_bo_sat, 
                        BO_SAT.Gia, 
                        BO_SAT.Mo_ta, 
                        ANH.Duong_dan_anh, 
                        DANH_MUC.Ten_danh_muc,
                        COALESCE(CEILING(AVG(DANH_GIA.Sao)), 0) AS Sao,
                        COUNT(DANH_GIA.Ma_danh_gia) AS So_luong_danh_gia
                    FROM BO_SAT
                    LEFT JOIN DANH_GIA ON BO_SAT.Ma_bo_sat = DANH_GIA.Ma_bo_sat
                    JOIN DANH_MUC ON BO_SAT.Ma_danh_muc = DANH_MUC.Ma_danh_muc
                    LEFT JOIN ANH ON BO_SAT.Ma_bo_sat = ANH.Ma_bo_sat";

            if ($category) {
                $sql .= " WHERE BO_SAT.Ma_danh_muc = :category";
            }

            $sql .= " GROUP BY 
                        BO_SAT.Ma_bo_sat, 
                        BO_SAT.Ten_bo_sat, 
                        BO_SAT.Gia, 
                        BO_SAT.Mo_ta, 
                        ANH.Duong_dan_anh, 
                        DANH_MUC.Ten_danh_muc";

            if ($sort == 'price') {
                $sql .= " ORDER BY BO_SAT.Gia $order";
            } elseif ($sort == 'rating') {
                $sql .= " ORDER BY Sao $order";
            } else {
                $sql .= " ORDER BY BO_SAT.Ma_bo_sat $order";
            }

            $sql .= " LIMIT :limit OFFSET :offset";

            $stmt = $conn->prepare($sql);
            if ($category) {
                $stmt->bindValue(':category', $category, PDO::PARAM_INT);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Hiển thị sản phẩm
            if ($products) {
                foreach ($products as $product) {
                    include 'components/product-card.php';
                }
            } else {
                echo "<p>Không có sản phẩm nào để hiển thị.</p>";
            }

            $stmt->closeCursor();

            // Lấy tổng số sản phẩm
            $countSql = "SELECT COUNT(*) AS total FROM BO_SAT";
            if ($category) {
                $countSql .= " WHERE Ma_danh_muc = :category";
            }
            $countStmt = $conn->prepare($countSql);
            if ($category) {
                $countStmt->bindValue(':category', $category, PDO::PARAM_INT);
            }
            $countStmt->execute();
            $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
            $totalPages = ceil($total / $limit);

            $countStmt->closeCursor();
        } catch (PDOException $e) {
            echo "<p class='text-danger'>Lỗi: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    </div>
</div>