<?php
require_once 'db/db_connection.php';
require_once 'includes/auth_functions.php';

// Nếu user đã đăng nhập thì redirect về trang chủ
if (isLoggedIn()) {
    redirectWithMessage("index.php", "Bạn đã đăng nhập rồi!", "info");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $errors = [];
    
    // Validation
    if (empty($email)) {
        $errors[] = "Email không được để trống";
    } elseif (!validateEmail($email)) {
        $errors[] = "Email không hợp lệ";
    }
    
    if (empty($password)) {
        $errors[] = "Mật khẩu không được để trống";
    }
    
    // Nếu không có lỗi validation thì xử lý đăng nhập
    if (empty($errors)) {
        try {
            // Tìm user theo email
            $stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                
                // Kiểm tra mật khẩu
                if (password_verify($password, $user['password'])) {
                    // Đăng nhập thành công - tạo session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];
                    
                    // Log đăng nhập thành công
                    error_log("User logged in successfully: " . $user['email']);
                    
                    // Redirect về trang chủ
                    redirectWithMessage("index.php", "Đăng nhập thành công! Chào mừng " . $user['username'], "success");
                } else {
                    $errors[] = "Mật khẩu không đúng";
                }
            } else {
                $errors[] = "Email không tồn tại trong hệ thống";
            }
            
            $stmt->close();
            
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            $errors[] = "Có lỗi xảy ra, vui lòng thử lại sau";
        }
    }
    
    // Nếu có lỗi, redirect về trang login với thông báo
    if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        $_SESSION['login_email'] = $email; // Giữ lại email để user không phải nhập lại
        header("Location: login.php");
        exit();
    }
} else {
    // Nếu không phải POST request, redirect về trang login
    header("Location: login.php");
    exit();
}
?>
