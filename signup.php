<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Đăng ký</h2>

                    <form id="registerForm" method="POST" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <div id="usernameError" class="text-danger" style="display: none;"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div id="passwordError" class="text-danger" style="display: none;"></div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                required>
                            <div id="confirmPasswordError" class="text-danger" style="display: none;"></div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                        <div class="mb-3 mt-3 flex justify-content-center">
                            <div>
                                <a href="login.php" style="color: gray">Đã có tài khoản</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php
    include("config.php");
    try {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            if (strlen($username) < 6) {
                echo "Tên đăng nhập phải có ít nhất 6 ký tự.<br>";
            } elseif (strlen($password) < 6) {
                echo "Mật khẩu phải có ít nhất 6 ký tự.<br>";
            } else {
                $hashPass = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO KHACH_HANG (Ma_khach_hang ,Ten, Dia_chi, So_dien_thoai, Email) VALUES (NULL, '', '', '', '')");
                $stmt->execute();
                $lastInsertId = $conn->lastInsertId();
                echo "ma khach mo them la $lastInsertId";
                $result = $conn->prepare("INSERT INTO TAI_KHOAN (Ten_dang_nhap, Mat_khau, Quyen, Ma_khach_hang) VALUES (?, ?, 0, ?)");
                $result->bindParam(1, $username);
                $result->bindParam(2, $hashPass);
                $result->bindParam(3, $lastInsertId);

                if ($result->execute()) {
                    echo "Đăng ký thành công!<br>";
                    echo "ID của bản ghi vừa tạo: " . $lastInsertId . "<br>";
                } else {
                    echo "Có lỗi khi đăng ký, vui lòng thử lại.<br>";
                }
            }
        }
    } catch (PDOException $e) {
        echo "Connect faild: " . $e->getMessage();
    }
    ?>






    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <script src="../js/signup.js"></script>
</body>

</html>