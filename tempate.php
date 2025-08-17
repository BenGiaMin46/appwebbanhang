<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
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
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Blogs</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
      </ul>

      <!-- Icon bên phải -->
      <div class="navbar-icons">
        <a href="#"><i class="fa-solid fa-cart-arrow-down"></i></a>
        <a href="#"><i class="fa-solid fa-user"></i></a>
      </div>
    </div>
  </div>
</nav>
<!-- End navbar -->




<footer class="my-5 py-5">
    <div class="container row mx-auto">
        <!--Logo and slogan-->
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img src="img/img/main/logo.jpg">
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