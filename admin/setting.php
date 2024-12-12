<?php include('components/sidebar.php'); ?>
<?php include('components/navbar.php'); ?>

<div class="content">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-center text-primary">Cài Đặt Hệ Thống</h2>
            </div>
        </div>

        <!-- Cài đặt thông tin cá nhân và mật khẩu -->
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h5>Thông tin cá nhân</h5>
                    </div>
                    <div class="card-body">
                        <?php include('components/setting-form.php'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thêm các phần cài đặt khác tại đây -->
    </div>
</div>
