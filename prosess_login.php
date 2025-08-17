<?php
session_start();
require 'db/db_connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login-email']) && isset($_POST['login-password'])) {
        $email = trim($_POST['login-email']);
        $password = trim($_POST['login-password']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email không hợp lệ!";
            header("Location: login.php");
            exit();
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error'] = "Mật khẩu không đúng!";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Email không tồn tại!";
            header("Location: login.php");
            exit();
        }
        
        $stmt->close();
        $conn->close(); // Đóng kết nối cơ sở dữ liệu
    }
}
?>