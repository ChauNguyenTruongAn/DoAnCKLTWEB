<?php include('components/navbar.php'); ?>
<?php include('components/sidebar.php'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <?php include('components/customer-profile.php'); ?>
            </div>
            <div class="col-md-8">
                <!-- Danh sách các đơn hàng của khách hàng -->
                <div class="card">
                    <div class="card-header">
                        <h5>Lịch sử đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Đơn hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Giả lập các đơn hàng -->
                                <tr>
                                    <td>#001</td>
                                    <td>12/12/2024</td>
                                    <td>1,500,000 VND</td>
                                    <td>Đang xử lý</td>
                                    <td><a href="order-detail.php" class="btn btn-info btn-sm">Xem chi tiết</a></td>
                                </tr>
                                <tr>
                                    <td>#002</td>
                                    <td>10/12/2024</td>
                                    <td>700,000 VND</td>
                                    <td>Đã giao</td>
                                    <td><a href="order-detail.php" class="btn btn-info btn-sm">Xem chi tiết</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>