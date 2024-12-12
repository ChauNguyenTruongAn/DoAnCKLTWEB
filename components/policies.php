<?php
$query = "SELECT * FROM chinh_sach ORDER BY created_at DESC";
$stmt = $conn->query($query);
$policies = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($policies)) {
    echo '<p>Không có chính sách nào.</p>';
}
?>

<section class="container py-5" id="policies">
    <h2 class="text-center mb-5">Chính Sách Đồ</h2>

    <div id="policyCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $chunks = array_chunk($policies, 4);
            $active = 'active';
            foreach ($chunks as $chunk) {
                echo '<div class="carousel-item ' . $active . '">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">';
                foreach ($chunk as $policy) {
                    echo '<div class="col">
                            <div class="card policy-card h-100">
                                <a href="' . $policy['lien_ket'] . '">
                                    <img src="' . $policy['hinh_anh'] . '" class="card-img-top" alt="' . $policy['tieu_de'] . '">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-truncate">' . htmlspecialchars($policy['tieu_de']) . '</h5>
                                    <p class="card-text flex-grow-1 text-truncate-2">' . htmlspecialchars($policy['mo_ta']) . '</p>
                                    <a href="' . $policy['lien_ket'] . '" class="btn btn-info mt-2">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>';
                }
                echo '</div></div>';
                $active = '';
            }
            ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#policyCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#policyCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<?php
$conn = null;
?>