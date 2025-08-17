<?php
session_start();

if (isset($_POST['checkout'])) {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['product_price'] * $item['product_quantity'];
        }

        // Giả lập xử lý thanh toán (ở đây bạn có thể tích hợp với PayPal, VNPay, Momo, v.v.)
        // Sau khi xử lý xong, bạn xóa giỏ hàng:
        $_SESSION['cart'] = [];

        echo "<h2 style='text-align:center;'>Thanh toán thành công!</h2>";
        echo "<p style='text-align:center;'>Tổng tiền của bạn là: <strong>" . $total . "$</strong></p>";
        echo "<p style='text-align:center;'><a href='shop.php'>Tiếp tục mua sắm</a></p>";
    } else {
        echo "<p style='text-align:center;'>Giỏ hàng trống. Không thể thanh toán!</p>";
    }
} else {
    header("Location: cart.php");
    exit;
}
?>


