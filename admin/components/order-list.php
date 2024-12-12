<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Mã Đơn Hàng</th>
                    <th>Khách Hàng</th>
                    <th>Ngày Tạo</th>
                    <th>Trạng Thái</th>
                    <th>Chi Tiết</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Giả lập dữ liệu đơn hàng
                $orders = [
                    ["id" => 1, "customer" => "Nguyễn Văn A", "date" => "2024-12-01", "status" => "Đang chờ", "total" => 1200000],
                    ["id" => 2, "customer" => "Trần Thị B", "date" => "2024-12-05", "status" => "Đang giao", "total" => 800000],
                    ["id" => 3, "customer" => "Lê Quang C", "date" => "2024-12-10", "status" => "Đã hoàn thành", "total" => 1500000]
                ];

                foreach ($orders as $order) {
                    ?>
                    <tr>
                        <td>#<?php echo $order['id']; ?></td>
                        <td><?php echo $order['customer']; ?></td>
                        <td><?php echo $order['date']; ?></td>
                        <td>
                            <span
                                class="badge <?php echo ($order['status'] == 'Đang chờ') ? 'badge-warning' : ($order['status'] == 'Đang giao' ? 'badge-info' : 'badge-success'); ?>">
                                <?php echo $order['status']; ?>
                            </span>
                        </td>
                        <td><a href="order-detail.php?id=<?php echo $order['id']; ?>" class="btn btn-info btn-sm">Xem chi
                                tiết</a></td>
                        <td>
                            <a href="change-status.php?id=<?php echo $order['id']; ?>&status=done"
                                class="btn btn-success btn-sm">Hoàn thành</a>
                            <a href="delete-order.php?id=<?php echo $order['id']; ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>