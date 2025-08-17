<?php
// File thiết lập database
require_once 'db_connection.php';

echo "<h2>Thiết lập Database BenGiaMin Fashion</h2>";

// Kiểm tra kết nối database
if ($conn->connect_error) {
    die("❌ Kết nối database thất bại: " . $conn->connect_error);
}
echo "✅ Kết nối database thành công<br>";

// Kiểm tra xem database có tồn tại không
$result = $conn->query("SHOW DATABASES LIKE 'db_shop'");
if ($result->num_rows > 0) {
    echo "✅ Database 'db_shop' đã tồn tại<br>";
} else {
    echo "❌ Database 'db_shop' không tồn tại<br>";
    echo "Vui lòng tạo database 'db_shop' trong phpMyAdmin trước<br>";
    exit;
}

// Kiểm tra xem bảng users có tồn tại không
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result->num_rows > 0) {
    echo "✅ Bảng 'users' đã tồn tại<br>";
    
    // Hiển thị cấu trúc bảng hiện tại
    echo "<h3>Cấu trúc bảng users hiện tại:</h3>";
    $structure = $conn->query("DESCRIBE users");
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr style='background-color: #f0f0f0;'><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while ($row = $structure->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Kiểm tra xem có cột id không
    $hasId = false;
    $structure->data_seek(0);
    while ($row = $structure->fetch_assoc()) {
        if ($row['Field'] === 'id') {
            $hasId = true;
            break;
        }
    }
    
    if (!$hasId) {
        echo "<div style='color: red; background-color: #ffe6e6; padding: 10px; margin: 10px 0; border: 1px solid #ff9999;'>";
        echo "⚠️ Bảng users không có cột 'id'. Cần tạo lại bảng với cấu trúc đúng.";
        echo "</div>";
        
        // Xóa bảng cũ và tạo lại
        if ($conn->query("DROP TABLE users") === TRUE) {
            echo "✅ Đã xóa bảng users cũ<br>";
        } else {
            echo "❌ Không thể xóa bảng users cũ: " . $conn->error . "<br>";
            exit;
        }
    }
}

// Tạo bảng users nếu chưa có hoặc cần tạo lại
if ($conn->query("SHOW TABLES LIKE 'users'")->num_rows == 0) {
    echo "<h3>Tạo bảng users mới...</h3>";
    
    $sql = "
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'customer') DEFAULT 'customer',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "✅ Bảng users đã được tạo thành công!<br>";
        
        // Tạo index cho email
        $index_sql = "CREATE INDEX idx_email ON users(email)";
        if ($conn->query($index_sql) === TRUE) {
            echo "✅ Index cho email đã được tạo<br>";
        }
        
        // Hiển thị cấu trúc bảng mới
        echo "<h3>Cấu trúc bảng users mới:</h3>";
        $structure = $conn->query("DESCRIBE users");
        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
        echo "<tr style='background-color: #f0f0f0;'><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        while ($row = $structure->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Field'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";
            echo "<td>" . $row['Null'] . "</td>";
            echo "<td>" . $row['Key'] . "</td>";
            echo "<td>" . $row['Default'] . "</td>";
            echo "<td>" . $row['Extra'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<div style='color: green; background-color: #e6ffe6; padding: 10px; margin: 10px 0; border: 1px solid #99ff99;'>";
        echo "🎉 Bảng users đã được tạo thành công với cấu trúc đúng!";
        echo "</div>";
        
    } else {
        echo "❌ Lỗi khi tạo bảng: " . $conn->error;
    }
}

// Kiểm tra cuối cùng
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result->num_rows > 0) {
    echo "<br><div style='color: green; font-weight: bold;'>";
    echo "✅ Hệ thống đã sẵn sàng! Bạn có thể sử dụng các trang đăng ký/đăng nhập.";
    echo "</div>";
    
    echo "<br><h3>Hướng dẫn sử dụng:</h3>";
    echo "<ul>";
    echo "<li><a href='../register.php'>Đăng ký tài khoản</a></li>";
    echo "<li><a href='../login.php'>Đăng nhập</a></li>";
    echo "<li><a href='../account.php'>Quản lý tài khoản</a></li>";
    echo "</ul>";
}

$conn->close();
?>
