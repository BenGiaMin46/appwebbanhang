<?php
session_start();

if (isset($_POST['add_to_cart'])) {
    // Kiểm tra và khởi tạo giỏ hàng nếu chưa có
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Lấy thông tin sản phẩm từ POST
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_image = $_POST['product_image'];
    $product_price = (float)$_POST['product_price']; // Ép kiểu giá về float
    $product_quantity = (int)$_POST['product_quantity']; // Ép kiểu số lượng về int

    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
    $product_array_id = array_column($_SESSION['cart'], 'product_id');

    if (in_array($product_id, $product_array_id)) {
        // Nếu sản phẩm đã tồn tại, cập nhật số lượng
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['product_id'] == $product_id) {
                $_SESSION['cart'][$key]['product_quantity'] += $product_quantity;
            }
        }
    } else {
        // Nếu sản phẩm mới, thêm sản phẩm vào giỏ hàng
        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_image' => $product_image,
            'product_price' => $product_price,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
    }
} else if (isset($_POST['update-product'])) {
    // Cập nhật số lượng sản phẩm trong giỏ hàng
    $product_id = $_POST['product_id'];
    $product_quantity = (int)$_POST['product_quantity']; // Ép kiểu số lượng về int

    if (isset($_SESSION['cart'][$product_id])) {
        // Nếu sản phẩm tồn tại, cập nhật số lượng
        $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
    }
} else if (isset($_POST['delete-product'])) {
    // Xóa sản phẩm khỏi giỏ hàng
    $product_id = $_POST['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
} else {
    // Chuyển hướng nếu không có hành động
    header('location:index.php');

    // total of the cart
    function calculateTotalOftheCart(){
        $total = 0;
        foreach($_SESSION['cart'] as $key => $value){
            $product = $_SESSION['cart'][$key];
            $price = $product['product_price'];
            $quantity = $product['product_quantity'];
            $total+= $price+$quantity;
        }
        $_SESSION['total'] = $total;
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Trang web bán hàng</title>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <!-- Logo -->
    <a href="index.php"><img class="img-logo" src="img/main/logo.jpg"></a>

    <!-- Nút menu khi thu nhỏ -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Nội dung chính navbar -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Menu chính giữa -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Blogs</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
      </ul>

      <!-- Icon bên phải -->
      <div class="navbar-icons">
        <a href="./cart.php"><i class="fa-solid fa-cart-arrow-down"></i></a>
        <a href="./account.php"><i class="fa-solid fa-user"></i></a>
      </div>
    </div>
  </div>
</nav>
<!-- End navbar -->

<section id="cart" class="container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bold"> Giỏ hàng </h2>
        <hr>
    </div>

    <!-- Cart table -->
    <table class="mt-5 pt-5">
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>

        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra nếu giỏ hàng tồn tại và không trống
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
        ?>
                <tr>
                    <!-- product info -->
                    <td>
                        <div class="product-info">
                            <img src="./img/<?php echo htmlspecialchars($value['product_image']); ?>" alt="Sản phẩm">
                            <div>
                                <p><?php echo htmlspecialchars($value['product_name']); ?></p>
                                <p><?php echo htmlspecialchars($value['product_price']) . "₫"; ?></p>
                                <!-- Form xóa sản phẩm -->
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($value["product_id"]); ?>">
                                    <input type="submit" name="delete-product" class="btn-delete" value="Xoá khỏi giỏ hàng">
                                </form>
                            </div>
                        </div>
                    </td>

                    <!-- quantity -->
                    <td>
                        <form method="POST" action="cart.php">
                            <input type="number" name="product_quantity" max="100" min="1" value="<?php echo htmlspecialchars($value['product_quantity']); ?>" name="product_quantity">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($value['product_id']); ?>">
                            <input type="submit" name="update-product" class="btn-update" value="Cập nhật">
                        </form>
                    </td>

                    <!-- total price -->
                    <td>
                        <p><?php echo (float)$value['product_price'] * (int)$value['product_quantity'] . "₫"; ?></p>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='3'>Giỏ hàng của bạn đang trống.</td></tr>";
        }
        ?>
    </table>

    <!-- Total design -->
    <div class="cart-total">
        <table>
            <tr>
                <td>Tổng cộng</td>
                <td>
                    <?php
                    $total = 0;
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $value) {
                            $total += (float)$value['product_price'] * (int)$value['product_quantity'];
                        }
                    }
                    echo $total . "$";
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <!-- Check out btn -->
    <!-- Check out btn -->
<div class="checkout">
    <form method="POST" action="checkout.php">
        <button class="checkout-btn" name="checkout"> Thanh toán </button>
    </form>
</div>

</section>


<footer class="my-5 py-5">
    <div class="container row mx-auto">
        <!--Logo and slogan-->
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img src="img/main/logo.jpg">
            <p>Chứng tỏi mang đến sản phẩm tốt nhất với giá tốt nhất cho mọi người</p>
        </div>
        <!--SUB MENU-->
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

          <!--CONTACT US-->
  <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <h4 class="pb-3">Contact Us</h4>
      <div>
          <h6 style="color: red;"class="text-uppercase"><i class="fa-solid fa-location-dot"></i>Địa chỉ </h6>
          <p>77 Phan Khoang, Hoà An, Cẩm Lệ, Đà Nẵng, Việt Nam</p>
      </div>
      <div>
          <h6 style="color: red;"class="text-uppercase"><i class="fa-solid fa-square-phone"></i>Điện thoại</h6>
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
        <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins1.png">
        <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins2.png">
        <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins3.png">
        <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins4.png">
        <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins5.png">
        <img class="img-fluid w-25 h-100 m-2" src="img/ins/ins6.png">
    </div>
</div>
<!-- Footer 2 -->

<div class="footer-2 my-3">
  <div class="row container mx-auto">
    <div class="col-lg-4 col-md-6 col-sm-12">
      <img src="img/pay/pay1.png">
</div>
<div class="col-lg-4 col-md-6 col-sm-12 py-3">
      <p> BenGiaMin's Fashion @2025 ALL Right Reserved</p>
</div>
<div class="col-lg-4 col-md-6 col-sm-12 social px-5">
  <a href="#"><i class="fa-brands fa-facebook"></i></a>
  <a href="#"><i class="fa-brands fa-instagram"></i></a>
  <a href="#"><i class="fa-brands fa-youtube"></i></a>

</div>
</div>
</div>
</footer>


<script src="./js/single_product.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>