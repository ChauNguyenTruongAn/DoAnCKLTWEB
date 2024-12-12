<?php include('components/header.php'); ?>

<div class="container mt-4">
    <?php include('components/breadcrumb.php'); ?>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <?php include('components/sidebar-products.php'); ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Sorting Section -->
            <?php include('components/sorting-products.php'); ?>

            <!-- Product Grid -->
            <?php include('components/products-grid.php'); ?>

            <!-- Pagination -->
            <?php include('components/pagination-products.php'); ?>
        </div>
    </div>
</div>

<?php include('components/footer.php'); ?>