<?php
session_start();

$isLoggedIn = isset($_SESSION['Ten_dang_nhap']) && !empty($_SESSION['Ten_dang_nhap']);
$userName = $_SESSION['Ten_dang_nhap'] ?? "Khách";

include("config.php");

$cartCount = 0;
if ($isLoggedIn) {
    $welcomeMessage = $_SESSION['welcome_message'] ?? null;
    if ($welcomeMessage) {
        // Hiển thị thông báo chào mừng
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo $welcomeMessage;
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';

        // Xóa thông báo chào mừng khỏi session sau khi hiển thị
        unset($_SESSION['welcome_message']);
    }

    $customerId = $_SESSION['Ma_khach_hang'];

    $stmt = $conn->prepare("SELECT COUNT(*) FROM CHI_TIET_GIO_HANG WHERE Ma_gio_hang = (SELECT Ma_gio_hang FROM GIO_HANG WHERE Ma_khach_hang = ?)");
    $stmt->bindParam(1, $customerId, PDO::PARAM_INT);
    $stmt->execute();

    $cartCount = $stmt->fetchColumn();
}

$cartMessage = $_SESSION['cart_message'] ?? null;
if ($cartMessage) {
    // Hiển thị thông báo nếu có
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $cartMessage;
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';

    // Xóa thông báo khỏi session sau khi đã hiển thị
    unset($_SESSION['cart_message']);
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa Hàng Bò Sát Đẹp</title>
    <link rel="stylesheet" href="../../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .navbar {
            border-bottom: 2px solid #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-link {
            font-size: 1.1rem;
        }

        .alert-dismissible .btn-close {
            background-color: #000;
        }

        .nav-item .nav-link:hover {
            background-color: #e7e7e7;
            border-radius: 5px;
        }

        .navbar .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        .cart-icon {
            position: relative;
        }

        .cart-icon .badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: #dc3545;
            color: white;
            padding: 0.3rem 0.7rem;
            border-radius: 50%;
            font-size: 0.75rem;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Bò Sát Đẹp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Trang Chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Sản Phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Giới Thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/contact.php">Liên Hệ</a></li>
                    <li class="nav-item">
                        <a class="nav-link cart-icon" href="cart.php">
                            <i class="bi bi-cart-fill"></i> Giỏ hàng
                            <?php if ($cartCount > 0): ?>
                                <span class="badge"><?php echo $cartCount; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <?php echo $userName; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="profile.php">Hồ Sơ</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Đăng Xuất</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php"><i class="bi bi-box-arrow-in-right"></i>
                                Đăng Nhập</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>