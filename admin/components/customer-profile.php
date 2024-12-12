<div class="card">
    <div class="card-header">
        <h5>Thông tin cá nhân</h5>
    </div>
    <div class="card-body">
        <form action="update-customer.php" method="POST">
            <div class="form-group mb-3">
                <label for="full-name">Họ và tên</label>
                <input type="text" class="form-control" id="full-name" name="full-name" value="Nguyễn Văn A" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="nguyenvana@example.com" required>
            </div>

            <div class="form-group mb-3">
                <label for="phone">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="0901234567" required>
            </div>

            <div class="form-group mb-3">
                <label for="address">Địa chỉ giao hàng</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>123 Đường ABC, Quận XYZ, TP HCM</textarea>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
            </div>
        </form>
    </div>
</div>
