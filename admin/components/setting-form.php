<form action="update-settings.php" method="POST">
    <div class="form-group mb-3">
        <label for="username">Tên đăng nhập</label>
        <input type="text" class="form-control" id="username" name="username" value="Admin" readonly>
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="admin@example.com" required>
    </div>

    <div class="form-group mb-3">
        <label for="password">Mật khẩu mới</label>
        <input type="password" class="form-control" id="password" name="password">
        <small class="form-text text-muted">Để trống nếu không thay đổi.</small>
    </div>

    <div class="form-group mb-3">
        <label for="confirm-password">Xác nhận mật khẩu mới</label>
        <input type="password" class="form-control" id="confirm-password" name="confirm-password">
    </div>

    <div class="form-group mb-3">
        <label for="timezone">Múi giờ</label>
        <select class="form-control" id="timezone" name="timezone">
            <option value="GMT+7">GMT+7 (Vietnam)</option>
            <option value="GMT+8">GMT+8 (Singapore)</option>
            <option value="GMT">GMT</option>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="language">Ngôn ngữ</label>
        <select class="form-control" id="language" name="language">
            <option value="vi">Tiếng Việt</option>
            <option value="en">English</option>
        </select>
    </div>

    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </div>
</form>