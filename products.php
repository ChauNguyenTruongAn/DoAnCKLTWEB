<?php include('components/header.php'); ?>

<div class="container mt-4">
    <?php include('components/breadcrumb.php'); ?>

    <div class="row">
        <div class="col-md-3">
            <?php include('components/sidebar-products.php'); ?>
        </div>
        <div class="col-md-9">
            <?php include('components/sorting-products.php'); ?>

            <?php include('components/products-grid.php'); ?>

            <?php include('components/pagination-products.php'); ?>
        </div>
    </div>
</div>

<?php include('components/footer.php'); ?>