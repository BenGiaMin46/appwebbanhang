# BenGiaMin Fashion - Hệ thống đăng ký/đăng nhập

## Mô tả
Hệ thống quản lý tài khoản người dùng cho website bán hàng thời trang BenGiaMin Fashion.

## Tính năng chính

### 🔐 Hệ thống Authentication
- **Đăng ký tài khoản**: Tạo tài khoản mới với validation đầy đủ
- **Đăng nhập**: Xác thực người dùng với email và mật khẩu
- **Quản lý session**: Bảo mật và quản lý phiên đăng nhập
- **Đăng xuất**: Xóa session và cookie an toàn

### 🛡️ Bảo mật
- **Mật khẩu được hash**: Sử dụng `password_hash()` và `password_verify()`
- **Prepared statements**: Chống SQL injection
- **Validation dữ liệu**: Kiểm tra input người dùng
- **Session management**: Quản lý phiên đăng nhập an toàn

### 📱 Giao diện
- **Responsive design**: Tương thích mọi thiết bị
- **Bootstrap 5**: Giao diện hiện đại và đẹp mắt
- **Font Awesome**: Icons đẹp và chuyên nghiệp

## Cấu trúc thư mục

```
Webbanhang/
├── includes/
│   └── auth_functions.php      # Các hàm xử lý authentication
├── db/
│   ├── db_connection.php       # Kết nối database
│   ├── create_users_table.sql  # SQL tạo bảng users
│   └── setup_database.php      # Script thiết lập database
├── register.php                # Trang đăng ký
├── login.php                   # Trang đăng nhập
├── process_login.php           # Xử lý đăng nhập
├── logout.php                  # Xử lý đăng xuất
├── account.php                 # Trang quản lý tài khoản
└── README.md                   # Hướng dẫn sử dụng
```

## Cài đặt

### 1. Thiết lập Database
```bash
# Truy cập vào file setup database
http://localhost/Webbanhang/db/setup_database.php
```

### 2. Cấu hình kết nối
Chỉnh sửa file `db/db_connection.php`:
```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_shop";
```

### 3. Tạo bảng users
File `db/create_users_table.sql` sẽ được chạy tự động khi truy cập `setup_database.php`.

## Sử dụng

### Đăng ký tài khoản
1. Truy cập `/register.php`
2. Điền thông tin: username, email, mật khẩu
3. Hệ thống sẽ validate và tạo tài khoản

### Đăng nhập
1. Truy cập `/login.php`
2. Nhập email và mật khẩu
3. Hệ thống xác thực và tạo session

### Quản lý tài khoản
1. Sau khi đăng nhập, truy cập `/account.php`
2. Xem thông tin cá nhân
3. Quản lý đơn hàng
4. Thay đổi mật khẩu

### Đăng xuất
1. Truy cập `/logout.php` hoặc click nút đăng xuất
2. Hệ thống xóa session và redirect về trang chủ

## Cấu trúc Database

### Bảng `users`
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Validation Rules

### Username
- Độ dài: 3-20 ký tự
- Chỉ chứa: chữ cái, số, dấu gạch dưới
- Không được trùng với username khác

### Email
- Phải là email hợp lệ
- Không được trùng với email khác

### Password
- Độ dài tối thiểu: 6 ký tự
- Được hash bằng `PASSWORD_DEFAULT`

## Bảo mật

- **SQL Injection**: Sử dụng prepared statements
- **XSS**: Sử dụng `htmlspecialchars()` cho output
- **CSRF**: Có thể thêm CSRF token (chưa implement)
- **Session Hijacking**: Session được quản lý an toàn
- **Password Security**: Mật khẩu được hash và salt

## Tính năng nâng cao có thể thêm

- [ ] Xác thực email
- [ ] Quên mật khẩu
- [ ] Đổi mật khẩu
- [ ] Cập nhật thông tin cá nhân
- [ ] Upload avatar
- [ ] Phân quyền chi tiết
- [ ] Log hoạt động
- [ ] Rate limiting

## Hỗ trợ

Nếu có vấn đề gì, vui lòng kiểm tra:
1. Kết nối database
2. Quyền ghi file
3. PHP version (khuyến nghị PHP 7.4+)
4. MySQL version (khuyến nghị MySQL 5.7+)

## License

© 2025 BenGiaMin Fashion. All rights reserved.
