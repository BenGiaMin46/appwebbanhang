<?php
require_once 'db_connection.php';

echo "<h2>Kiểm tra cấu trúc database</h2>";

// Kiểm tra xem database có tồn tại không
$result = $conn->query("SHOW DATABASES LIKE 'db_shop'");
if ($result->num_rows > 0) {
    echo "✅ Database 'db_shop' tồn tại<br>";
} else {
    echo "❌ Database 'db_shop' KHÔNG tồn tại<br>";
    echo "Vui lòng tạo database 'db_shop' trước<br>";
    exit;
}

// Kiểm tra xem bảng users có tồn tại không
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result->num_rows > 0) {
    echo "✅ Bảng 'users' tồn tại<br>";
    
    // Hiển thị cấu trúc bảng users
    echo "<h3>Cấu trúc bảng users hiện tại:</h3>";
    $structure = $conn->query("DESCRIBE users");
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
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
    
} else {
    echo "❌ Bảng 'users' KHÔNG tồn tại<br>";
    echo "Vui lòng chạy file setup_database.php để tạo bảng<br>";
}

// Kiểm tra xem có dữ liệu nào trong bảng users không
if ($conn->query("SHOW TABLES LIKE 'users'")->num_rows > 0) {
    $result = $conn->query("SELECT COUNT(*) as count FROM users");
    $row = $result->fetch_assoc();
    echo "<br>Số lượng user trong bảng: " . $row['count'];
}

$conn->close();
?>
