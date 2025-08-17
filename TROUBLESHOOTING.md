# Hướng dẫn khắc phục lỗi - BenGiaMin Fashion

## Lỗi thường gặp và cách khắc phục

### ❌ Lỗi: "Unknown column 'id' in 'field list'"

**Nguyên nhân:** Bảng `users` chưa được tạo hoặc có cấu trúc không đúng.

**Cách khắc phục:**

1. **Kiểm tra database:**
   - Truy cập: `http://localhost/Webbanhang/db/check_table.php`
   - Xem cấu trúc bảng hiện tại

2. **Thiết lập lại database:**
   - Truy cập: `http://localhost/Webbanhang/db/setup_database.php`
   - File này sẽ tự động tạo bảng với cấu trúc đúng

3. **Kiểm tra kết nối:**
   - Đảm bảo XAMPP/WAMP đang chạy
   - Kiểm tra file `db/db_connection.php`

### ❌ Lỗi: "Database 'db_shop' không tồn tại"

**Cách khắc phục:**

1. **Tạo database trong phpMyAdmin:**
   - Mở phpMyAdmin: `http://localhost/phpmyadmin`
   - Click "New" (Mới)
   - Nhập tên: `db_shop`
   - Chọn collation: `utf8mb4_unicode_ci`
   - Click "Create" (Tạo)

2. **Hoặc chạy SQL:**
   ```sql
   CREATE DATABASE IF NOT EXISTS db_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

### ❌ Lỗi: "Connection failed"

**Cách khắc phục:**

1. **Kiểm tra XAMPP/WAMP:**
   - Đảm bảo Apache và MySQL đang chạy
   - Kiểm tra port (thường là 3306 cho MySQL)

2. **Kiểm tra thông tin kết nối:**
   - Mở file `db/db_connection.php`
   - Kiểm tra username, password, database name

3. **Kiểm tra quyền user MySQL:**
   - Đảm bảo user 'root' có quyền truy cập database

### ❌ Lỗi: "Table 'users' doesn't exist"

**Cách khắc phục:**

1. **Chạy setup database:**
   ```
   http://localhost/Webbanhang/db/setup_database.php
   ```

2. **Kiểm tra quyền ghi:**
   - Đảm bảo thư mục có quyền ghi
   - Kiểm tra user MySQL có quyền CREATE TABLE

### ❌ Lỗi: "Access denied for user"

**Cách khắc phục:**

1. **Kiểm tra password MySQL:**
   - Nếu dùng XAMPP, thường password là rỗng
   - Nếu dùng WAMP, có thể cần set password

2. **Tạo user mới:**
   ```sql
   CREATE USER 'webuser'@'localhost' IDENTIFIED BY 'password';
   GRANT ALL PRIVILEGES ON db_shop.* TO 'webuser'@'localhost';
   FLUSH PRIVILEGES;
   ```

## Quy trình khắc phục chuẩn

### Bước 1: Kiểm tra cơ bản
```
1. XAMPP/WAMP đang chạy
2. Apache và MySQL đang hoạt động
3. Port không bị conflict
```

### Bước 2: Kiểm tra database
```
1. Truy cập phpMyAdmin
2. Kiểm tra database 'db_shop' có tồn tại
3. Kiểm tra bảng 'users' có tồn tại
```

### Bước 3: Thiết lập lại
```
1. Chạy check_table.php để kiểm tra
2. Chạy setup_database.php để tạo lại
3. Kiểm tra cấu trúc bảng
```

### Bước 4: Test hệ thống
```
1. Thử đăng ký tài khoản mới
2. Thử đăng nhập
3. Kiểm tra trang account
```

## File quan trọng cần kiểm tra

- `db/db_connection.php` - Kết nối database
- `db/setup_database.php` - Thiết lập database
- `db/check_table.php` - Kiểm tra cấu trúc
- `includes/auth_functions.php` - Hàm xử lý

## Liên hệ hỗ trợ

Nếu vẫn gặp vấn đề, hãy:
1. Kiểm tra error log của PHP
2. Kiểm tra error log của MySQL
3. Chụp màn hình lỗi
4. Mô tả chi tiết các bước đã thực hiện

## Lưu ý bảo mật

- Không để password database trống trong production
- Sử dụng user riêng thay vì root
- Giới hạn quyền truy cập database
- Backup database thường xuyên
