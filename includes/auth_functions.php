<?php
// File chứa các hàm xử lý authentication
session_start();

// Hàm kiểm tra user đã đăng nhập chưa
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['email']);
}

// Hàm lấy thông tin user hiện tại
function getCurrentUser($conn) {
    if (!isLoggedIn()) {
        return null;
    }
    
    $stmt = $conn->prepare("SELECT id, username, email, role FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}

// Hàm kiểm tra quyền admin
function isAdmin($conn) {
    $user = getCurrentUser($conn);
    return $user && $user['role'] === 'admin';
}

// Hàm redirect với thông báo
function redirectWithMessage($url, $message, $type = 'success') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
    header("Location: $url");
    exit();
}

// Hàm hiển thị thông báo
function displayMessage() {
    if (isset($_SESSION['message'])) {
        $type = $_SESSION['message_type'] ?? 'info';
        $message = $_SESSION['message'];
        
        // Xóa message sau khi hiển thị
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        
        return "<div class='alert alert-{$type} alert-dismissible fade show' role='alert'>
                    {$message}
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                </div>";
    }
    return '';
}

// Hàm hiển thị lỗi đăng nhập
function displayLoginErrors() {
    if (isset($_SESSION['login_errors'])) {
        $errors = $_SESSION['login_errors'];
        $html = '<div class="alert alert-danger"><ul class="mb-0">';
        foreach ($errors as $error) {
            $html .= '<li>' . htmlspecialchars($error) . '</li>';
        }
        $html .= '</ul></div>';
        
        // Xóa lỗi sau khi hiển thị
        unset($_SESSION['login_errors']);
        
        return $html;
    }
    return '';
}

// Hàm lấy email đã nhập trước đó (để giữ lại khi có lỗi)
function getPreviousEmail() {
    return isset($_SESSION['login_email']) ? $_SESSION['login_email'] : '';
}

// Hàm validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Hàm validate password
function validatePassword($password) {
    // Mật khẩu phải có ít nhất 6 ký tự
    return strlen($password) >= 6;
}

// Hàm validate username
function validateUsername($username) {
    // Username chỉ chứa chữ cái, số, dấu gạch dưới, độ dài 3-20 ký tự
    return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username);
}
?>
