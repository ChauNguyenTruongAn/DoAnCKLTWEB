<?php include('components/sidebar.php'); ?>
<?php include('components/navbar.php'); ?>

<div class="content">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-center text-primary">Quản Lý Đơn Hàng</h2>
            </div>
        </div>

        <!-- Search Bar and Filters -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="search-order" placeholder="Tìm kiếm đơn hàng..."
                        aria-label="Tìm kiếm đơn hàng">
                    <button class="btn btn-primary" id="search-btn">Tìm kiếm</button>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-success" id="add-order-btn">Thêm Đơn Hàng Mới</button>
            </div>
        </div>

        <!-- Order List -->
        <div class="row">
            <?php include('components/order-list.php'); ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // JavaScript for search functionality (Add your own search logic here)
    document.getElementById('search-btn').addEventListener('click', function () {
        var searchValue = document.getElementById('search-order').value.toLowerCase();
        // Add the logic to filter orders based on the search value
        console.log('Search value:', searchValue);
    });

    // JavaScript for adding new order functionality
    document.getElementById('add-order-btn').addEventListener('click', function () {
        window.location.href = 'add-order.php'; // Redirect to the add order page
    });
</script>
</body>

</html>