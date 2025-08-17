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
        <a href="cart.php"><i class="fa-solid fa-cart-arrow-down"></i></a>
        <a href="./account.php"><i class="fa-solid fa-user"></i></a>
      </div>
    </div>
  </div>
</nav>
<!-- End navbar -->

<!-- Home sections -->
<section id="home">
    <div class="container">
        <h5>Hàng mới về</h5>
        <h1><span>Giá tốt nhất </span> mùa lễ hội!</h1>
        <p>Chứng tỏ mạnh mẽ sản phẩm tốt nhất với giá tốt nhất cho mọi bạn</p>
        <button>Mua ngay</button>
    </div>
</section>
<!-- End home sections -->
<!-- Brand section -->
<section id="brand" class="container">
  <div class="row">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="img/brand/brand1.png">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="img/brand/brand2.jpg">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="img/brand/brand3.jpg">
    <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="img/brand/brand4.jpg">
</div>
<!-- End brand section -->
<!-- New section -->
<section id="new" class="w-100">
  <div class="row p-0 m-0">

    <!-- New one -->
    <div class="one col-lg-4 col-md-6 col-sm-12 p-2 text-center">
      <img class="img-fluid" src="img/new/new6.jpg" style="width: 100%; max-width: 400px; height: auto;">
      <div class="detail">
        <h3>Giày thể thao mới</h3>
        <button>Mua ngay</button>
      </div>
    </div>

    <!-- New two -->
    <div class="one col-lg-4 col-md-6 col-sm-12 p-2 text-center">
      <img class="img-fluid" src="img/new/new2.png" style="width: 100%; max-width: 400px; height: auto;">
      <div class="detail">
        <h3>Quần áo thể thao mới</h3>
        <button>Mua ngay</button>
      </div>
    </div>

    <!-- New three -->
    <div class="one col-lg-4 col-md-6 col-sm-12 p-2 text-center">
      <img class="img-fluid" src="img/new/new5.jpg" style="width: 100%; max-width: 400px; height: auto;">
      <div class="detail">
        <h3>Soccer shoes on sale 50%</h3>
        <button>Mua ngay</button>
      </div>
    </div>

  </div>
</section>

  </div>

<!-- End new section -->

<!-- Feature section -->
 <section id="feature" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h2>Các sản phẩm đặc sắc </h2>
<hr>
<p> Hãy khám phá các sản phẩm đặc sắc của chúng tôi</p>
  </div>
  <div class="row mx-auto container-fluid">
<!-- Hình of feature 1 -->

<?php
$feature_product = getFeatureProduct();
while ($row = $feature_product->fetch_assoc()) {
?>
    <div onclick="window.location.href='single_product.php?product_id=<?php echo $row['product_id']; ?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="img/<?php echo htmlspecialchars($row['product_image']); ?>">
        <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo htmlspecialchars($row['product_name']); ?></h5>
        <h4 class="p-price"><?php echo number_format($row['product_price'], 2); ?>$</h4>
        <button class="p-buy-button">Mua ngay</button>
    </div>
<?php
}
?>

 <!-- End of feature 1 -->



 <!-- Start of sale banner sections -->
<section id="banner">
    <div class="container">
        <h4>Sale mùa Hè</h4>
        <h2>Giảm giá đến 30% <br> Tất cả sản phẩm</h2>
        <button>Mua ngay</button>
    </div>
</section>

<!-- End of sale banner section -->

<!-- shoes section -->
<section id="feature" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h2>Stylish shoes </h2>
<hr>
<p> Phong cách làm nên tên tuổi</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php
  $woman_shoes = getProductByCategory("Giày nữ");
  while ($w_shoes = $woman_shoes->fetch_assoc()) {
  ?>
      <div onclick="window.location.href='single_product.php?product_id=<?php echo $w_shoes['product_id']; ?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="img/<?php echo $w_shoes['product_image']; ?>" />
          <div class="stars">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $w_shoes['product_name']; ?></h5>
          <h4 class="p-price"><?php echo $w_shoes['product_price']; ?> $</h4>
          <button class="p-buy-button">Mua ngay</button>
      </div>
  <?php
  }
  ?>


 <!-- End of shoes 1 -->
 <!-- End shoes section -->

 <!-- clothing section -->
<section id="feature" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h2>Clothing</h2>
    <hr>
    <p>Thời trang có thể phai mờ, nhưng phong cách thì vĩnh cửu.</p>
  </div>
  <div class="row mx-auto container-fluid">

    <?php
    $clothes = getProductByCategory("Quần áo"); // Hoặc "Clothing" tùy tên danh mục trong CSDL
    if ($clothes && $clothes->num_rows > 0) {
        while ($clothing = $clothes->fetch_assoc()) {
    ?>
    <div onclick="window.location.href='single_product.php?product_id=<?php echo $clothing['product_id']; ?>';" class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="img/<?php echo $clothing['product_image']; ?>" />
        <div class="stars">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $clothing['product_name']; ?></h5>
        <h4 class="p-price"><?php echo number_format($clothing['product_price'], 0, ',', '.') . '$'; ?></h4>
        <a href="single_product.php?product_id=<?php echo $clothing['product_id']; ?>">
            <button class="p-buy-button">Mua ngay</button>
        </a>
    </div>
    <?php
        }
    } else {
        echo "<p class='text-center'>Không có sản phẩm quần áo nào.</p>";
    }
    ?>

  </div>
</section>
<!-- End clothing section -->


  <!-- accessories section -->
<section id="feature" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h2>Accessories Hot </h2>
<hr>
<p> Thời trang chỉ là nhất thời, phong cách mới là mãi mãi</p>
  </div>
  <div class="row mx-auto container-fluid">
<!-- Hình of accessories 1 -->
 <div class="text-center col-lg-3 col-md-4 col-sm-12 product">
    <img class="img-fluid mb-3" src="img/acces/acces1.png">
    <div class="star">
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
  </div>
  <h5 class="p-name"> Nike Clash </h5>
  <h4 class="p-price"> 1,119,000₫ </h4>
  <button class="p-buy-button"> Mua ngay </button>
</div>
 <!-- End of accessories 1 -->
  <!-- Hình of accessories 2 -->
 <div class="text-center col-lg-3 col-md-4 col-sm-12 product">
    <img class="img-fluid mb-3" src="img/acces/acces2.png">
    <div class="star">
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
  </div>
  <h5 class="p-name"> Classic </h5>
  <h4 class="p-price"> 887,000₫ </h4>
  <button class="p-buy-button"> Mua ngay </button>
</div>
 <!-- End of accessories 2 -->

  <!-- Hình of accessories 3 -->
 <div class="text-center col-lg-3 col-md-4 col-sm-12 product">
    <img class="img-fluid mb-3" src="img/acces/acces3.png">
    <div class="star">
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
  </div>
  <h5 class="p-name">Ball Mercurial Fade </h5>
  <h4 class="p-price"> 699,000₫ </h4>
  <button class="p-buy-button"> Mua ngay </button>
</div>
 <!-- End of accessories 3 -->

  <!-- Hình of accessories 4 -->
 <div class="text-center col-lg-3 col-md-4 col-sm-12 product">
    <img class="img-fluid mb-3" src="img/acces/acces4.png">
    <div class="star">
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
    <i class="fa-solid fa-star"></i>
  </div>
  <h5 class="p-name"> Dri-FIT  </h5>
  <h4 class="p-price"> 645,000₫ </h4>
  <button class="p-buy-button"> Mua ngay </button>
</div>
 <!-- End of accessories 4 -->
</div>
</section>
 <!-- End accessories section -->

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