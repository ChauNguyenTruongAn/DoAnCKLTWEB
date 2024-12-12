<!-- components/pagination.php -->
<?php if (isset($totalPages) && $totalPages > 1): ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link"
                        href="?page=<?= $page - 1 ?>&category=<?= isset($_GET['category']) ? $_GET['category'] : '' ?>&sort=<?= isset($_GET['sort']) ? $_GET['sort'] : '' ?>&order=<?= isset($_GET['order']) ? $_GET['order'] : '' ?>">Trước</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                    <a class="page-link"
                        href="?page=<?= $i ?>&category=<?= isset($_GET['category']) ? $_GET['category'] : '' ?>&sort=<?= isset($_GET['sort']) ? $_GET['sort'] : '' ?>&order=<?= isset($_GET['order']) ? $_GET['order'] : '' ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link"
                        href="?page=<?= $page + 1 ?>&category=<?= isset($_GET['category']) ? $_GET['category'] : '' ?>&sort=<?= isset($_GET['sort']) ? $_GET['sort'] : '' ?>&order=<?= isset($_GET['order']) ? $_GET['order'] : '' ?>">Tiếp</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>