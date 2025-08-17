<?php 
  include('./db/get_data.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/shop.css">
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
        <a href="#"><i class="fa-solid fa-cart-arrow-down"></i></a>
        <a href="./account.php"><i class="fa-solid fa-user"></i></a>
      </div>
    </div>
  </div>
</nav>
<!-- End navbar -->


<!-- Line 5 -->
<!-- Shoess Section -->
<section id="shop-page" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h2>Các sản phẩm của chúng tôi</h2>
    <hr>
    <p>Hãy khám phá các sản phẩm đặc sắc của chúng tôi</p>
  </div>
  <div class="row mx-auto container-fluid">

    <!-- Hiển thị sản phẩm động -->
    <?php
    $all_products = getAllProduct("product_category"); // Lấy danh sách sản phẩm theo danh mục "Giày"
    if ($all_products && $all_products->num_rows > 0) {
        while ($row = $all_products->fetch_assoc()) {
    ?>
          <div onclick="window.location.href='single_product.php?product_id=<?php echo $row['product_id']; ?>';"class="text-center col-lg-3 col-md-4 col-sm-12 product">
            <!-- Hiển thị hình ảnh -->
            <img class="img-fluid mb-3" src="img/<?php echo !empty($row['product_image']) ? htmlspecialchars($row['product_image']) : 'default.jpg'; ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
            <!-- Đánh giá sao -->
            <div class="star">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <!-- Hiển thị thông tin sản phẩm -->
            <h5 class="p-name"><?php echo htmlspecialchars($row['product_name']); ?></h5>
            <h4 class="p-price"><?php echo number_format($row['product_price'], 0); ?>$</h4>
            <!-- Nút mua sản phẩm -->
              <button class="p-buy-button">Mua ngay</button>
            </a>
          </div>
    <?php
        }
    } else {
        echo "<p class='text-center'>Không có sản phẩm nào để hiển thị.</p>"; // Hiển thị thông báo nếu không có sản phẩm
    }
    ?>

</div>
</section>



 <!-- Page navigation -->
 <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" hreff="#">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">4</a></li>
    <li class="page-item"><a class="page-link" href="#">5</a></li>
    <li class="page-item"><a class="page-link" href="#">6</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>


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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>