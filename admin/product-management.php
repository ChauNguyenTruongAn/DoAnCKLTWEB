<?php include('components/navbar.php'); ?>
<?php include('components/sidebar.php'); ?>

<div class="content">
    <div class="container-fluid">
        <h2 class="text-center text-primary">Quản Lý Sản Phẩm</h2>

        <div class="row">
            <div class="col-md-12">
                <a href="add-product.php" class="btn btn-success mb-3">Thêm sản phẩm</a>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Danh mục</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include('components/product-list.php'); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
