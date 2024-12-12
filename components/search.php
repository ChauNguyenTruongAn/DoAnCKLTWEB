<?php
// Bao gồm file kết nối
include("config.php");

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    try {
        $sql = "SELECT * FROM BO_SAT WHERE Ten_bo_sat LIKE :query OR Mo_ta LIKE :query";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($results);
    } catch (Exception $e) {
        echo "Lỗi truy vấn: " . $e->getMessage(); // DEBUG
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    http_response_code(400);
}
?>



<div class="container py-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="input-group">
                <input type="text" class="form-control" id="search-input" placeholder="Tìm kiếm sản phẩm..."
                    aria-label="Tìm kiếm" aria-describedby="search-btn">
                <button class="btn btn-primary" id="search-btn">Tìm kiếm</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('search-btn').addEventListener('click', function () {
        const query = document.getElementById('search-input').value.trim();
        if (query !== '') {
            window.location.href = `search_results.php?query=${encodeURIComponent(query)}`;
        } else {
            alert('Vui lòng nhập từ khóa tìm kiếm.');
        }
    });
</script>