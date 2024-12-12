<?php
session_start(); // Đảm bảo gọi session_start() ở đầu file PHP

ini_set('display_errors', 1);
error_reporting(E_ALL);

include("config.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (strlen($username) < 6) {
        $_SESSION['login_message'] = [
            'type' => 'danger',
            'message' => 'Tên đăng nhập phải có ít nhất 6 ký tự.'
        ];
    } elseif (strlen($password) < 6) {
        $_SESSION['login_message'] = [
            'type' => 'danger',
            'message' => 'Mật khẩu phải có ít nhất 6 ký tự.'
        ];
    } else {
        $stmt = $conn->prepare("SELECT TAI_KHOAN.Ma_khach_hang, Ten_dang_nhap, Mat_khau, Quyen, GIO_HANG.Ma_gio_hang
                                       FROM TAI_KHOAN JOIN GIO_HANG ON TAI_KHOAN.Ma_khach_hang = GIO_HANG.Ma_khach_hang
                                       WHERE Ten_dang_nhap = ?");
        $stmt->bindParam(1, $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['Mat_khau'])) {
                $_SESSION['Ma_khach_hang'] = $row['Ma_khach_hang'];
                $_SESSION['Ten_dang_nhap'] = $row['Ten_dang_nhap'];
                $_SESSION['Quyen'] = $row['Quyen'];
                $_SESSION['Ma_gio_hang'] = $row['Ma_gio_hang'];

                // Lưu thông báo chào mừng vào session
                $_SESSION['welcome_message'] = "Chào mừng, " . $_SESSION['Ten_dang_nhap'] . "!";

                // Chuyển hướng về trang chính
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['login_message'] = [
                    'type' => 'danger',
                    'message' => 'Thông tin tài khoản hoặc mật khẩu không chính xác.'
                ];
            }
        } else {
            $_SESSION['login_message'] = [
                'type' => 'danger',
                'message' => 'Thông tin tài khoản hoặc mật khẩu không chính xác.'
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-4">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Đăng nhập</h2>

                    <!-- Hiển thị thông báo lỗi hoặc thành công -->
                    <?php
                    if (isset($_SESSION['login_message'])) {
                        $message = $_SESSION['login_message'];
                        echo '<div class="alert alert-' . $message['type'] . ' alert-dismissible fade show" role="alert">';
                        echo $message['message'];
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';

                        // Sau khi hiển thị thông báo, xóa nó khỏi session
                        unset($_SESSION['login_message']);
                    }

                    if (isset($_SESSION['welcome_message'])) {
                        // Hiển thị thông báo chào mừng
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                        echo $_SESSION['welcome_message'];
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                        echo '</div>';

                        // Sau khi hiển thị thông báo, xóa nó khỏi session
                        unset($_SESSION['welcome_message']);
                    }
                    ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </form>

                    <div class="mt-3 text-center">
                        <p><a href="signup.php" class="text-decoration-none">Đăng ký tài khoản</a></p>
                        <p><a href="forgot-password.php" class="text-decoration-none">Quên mật khẩu?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>