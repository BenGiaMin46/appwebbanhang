<?php
require_once 'includes/auth_functions.php';

// Xóa tất cả session
session_start();
session_destroy();

// Xóa tất cả cookie
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-3600, '/');
    }
}

// Redirect về trang chủ với thông báo
redirectWithMessage("index.php", "Bạn đã đăng xuất thành công!", "success");
?>