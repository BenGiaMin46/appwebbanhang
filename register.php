<?php
require_once("db/db_connection.php");
require_once("includes/auth_functions.php");

// Nếu user đã đăng nhập thì redirect về trang chủ
if (isLoggedIn()) {
    redirectWithMessage("index.php", "Bạn đã đăng nhập rồi!", "info");
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];

    // Validation
    if (empty($username)) {
        $errors[] = "Tên đăng nhập không được để trống";
    } elseif (!validateUsername($username)) {
        $errors[] = "Tên đăng nhập chỉ được chứa chữ cái, số, dấu gạch dưới và độ dài 3-20 ký tự";
    }

    if (empty($email)) {
        $errors[] = "Email không được để trống";
    } elseif (!validateEmail($email)) {
        $errors[] = "Email không hợp lệ";
    }

    if (empty($password)) {
        $errors[] = "Mật khẩu không được để trống";
    } elseif (!validatePassword($password)) {
        $errors[] = "Mật khẩu phải có ít nhất 6 ký tự";
    }

    if ($password !== $repeat_password) {
        $errors[] = "Mật khẩu nhập lại không khớp";
    }

    // Nếu không có lỗi thì xử lý đăng ký
    if (empty($errors)) {
        try {
            // Kiểm tra xem bảng users có tồn tại và có cột id không
            $check_table = $conn->query("SHOW TABLES LIKE 'users'");
            if ($check_table->num_rows == 0) {
                $errors[] = "Bảng users chưa được tạo. Vui lòng chạy file setup database trước.";
            } else {
                // Kiểm tra cấu trúc bảng
                $check_structure = $conn->query("DESCRIBE users");
                $hasId = false;
                while ($row = $check_structure->fetch_assoc()) {
                    if ($row['Field'] === 'id') {
                        $hasId = true;
                        break;
                    }
                }
                
                if (!$hasId) {
                    $errors[] = "Bảng users không có cột 'id'. Vui lòng chạy file setup database để tạo lại bảng.";
                } else {
                    // Kiểm tra username đã tồn tại chưa
                    $check_username = $conn->prepare("SELECT id FROM users WHERE username = ?");
                    $check_username->bind_param("s", $username);
                    $check_username->execute();
                    
                    if ($check_username->get_result()->num_rows > 0) {
                        $errors[] = "Tên đăng nhập đã được sử dụng";
                    } else {
                        // Kiểm tra email đã tồn tại chưa
                        $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
                        $check_email->bind_param("s", $email);
                        $check_email->execute();
                        
                        if ($check_email->get_result()->num_rows > 0) {
                            $errors[] = "Email đã được sử dụng";
                        } else {
                            // Tiến hành đăng ký
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            $role = "customer";

                            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
                            $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

                            if ($stmt->execute()) {
                                redirectWithMessage("login.php", "Đăng ký thành công! Vui lòng đăng nhập.", "success");
                            } else {
                                $errors[] = "Lỗi khi đăng ký: " . $stmt->error;
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $errors[] = "Lỗi hệ thống: " . $e->getMessage();
            error_log("Registration error: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Đăng ký - BenGiaMin Fashion</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a href="index.php"><img class="img-logo" src="img/main/logo.jpg" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blogs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                </ul>
                <div class="navbar-icons">
                    <a href="cart.php"><i class="fa-solid fa-cart-arrow-down"></i></a>
                    <a href="login.php"><i class="fa-solid fa-user"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <section id="register" class="my-5 py-5">
        <div class="container mt-3 pt-3">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            <h2>Đăng ký tài khoản</h2>
                            <hr class="mx-auto">
                        </div>
                        <div class="card-body">
                            <?php if (!empty($errors)): ?>
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <?php foreach ($errors as $error): ?>
                                            <li><?php echo htmlspecialchars($error); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="register.php">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
                                           placeholder="Nhập tên đăng nhập" required>
                                    <div class="form-text">Chỉ chứa chữ cái, số, dấu gạch dưới (3-20 ký tự)</div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                                           placeholder="Nhập email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Nhập mật khẩu" required>
                                    <div class="form-text">Tối thiểu 6 ký tự</div>
                                </div>

                                <div class="mb-3">
                                    <label for="repeat_password" class="form-label">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" id="repeat_password" name="repeat_password" 
                                           placeholder="Nhập lại mật khẩu" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">Đăng ký</button>
                                </div>
                            </form>

                            <div class="text-center mt-3">
                                <p>Bạn đã có tài khoản? <a href="login.php" class="text-decoration-none">Đăng nhập ngay</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="my-5 py-5">
        <div class="container row mx-auto">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img src="img/main/logo.jpg" alt="Logo">
                <p>Chứng tỏi mang đến sản phẩm tốt nhất với giá tốt nhất cho mọi người</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h4 class="pb-3">Sản phẩm đặc sắc</h4>
                <ul class="text-uppercase">
                    <li><a href="#">Nam</a></li>
                    <li><a href="#">Nữ</a></li>
                    <li><a href="#">Bé trai</a></li>
                    <li><a href="#">Bé gái</a></li>
                    <li><a href="#">Hàng mới</a></li>
                    <li><a href="#">Quần áo</a></li>
                </ul>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h4 class="pb-3">Contact Us</h4>
                <div>
                    <h6 style="color: red;" class="text-uppercase"><i class="fa-solid fa-location-dot"></i>Địa chỉ</h6>
                    <p>77 Phan Khoang, Hoà An, Cẩm Lệ, Đà Nẵng, Việt Nam</p>
                </div>
                <div>
                    <h6 style="color: red;" class="text-uppercase"><i class="fa-solid fa-square-phone"></i>Điện thoại</h6>
                    <p>(84) 976965459</p>
                </div>
                <div>
                    <h6 style="color: red;" class="text-uppercase"><i class="fa-solid fa-envelope"></i>Email</h6>
                    <p>Benkpatin@gmail.com</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h4 class="pb-3">Instagram</h4>
                <div class="row">
                    <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins1.png" alt="Instagram">
                    <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins2.png" alt="Instagram">
                    <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins3.png" alt="Instagram">
                    <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins4.png" alt="Instagram">
                    <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins5.png" alt="Instagram">
                    <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins6.png" alt="Instagram">
                </div>
            </div>
        </div>
        <div class="footer-2 my-3">
            <div class="row container mx-auto">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <img src="img/pay/pay1.png" alt="Payment">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 py-3">
                    <p>BenGiaMin's Fashion @2025 ALL Right Reserved</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 social px-5">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>