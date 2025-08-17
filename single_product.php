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
    <link rel="stylesheet" href="./css/single_product.css">
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

<!-- Design grid layout for product -->
<section id="single-product" class="container my-5 pt-5">
  <div class="row d-flex align-items-center"> <!-- Flexbox for horizontal alignment -->
  
    <?php
    if (isset($_GET['product_id'])) {
        $id = $_GET['product_id'];
        // Retrieve product details based on product_id
        $product_details = getProductDetails($id);
    }
    while ($row = $product_details->fetch_assoc()) {
    ?>
    
    <!-- Display main product image -->
    <div class="col-lg-6 col-md-6 col-sm-12">
      <img class="img-fluid w-100 pb-2" src="./img/<?php echo $row['product_image']; ?>" id="main-img">
      
      <!-- Small images group -->
      <div class="small-img-group d-flex mt-3">
        <div class="small-img-col me-2">
          <img src="./img/<?php echo htmlspecialchars($row['product_image1']); ?>" class="small-img" width="100%">
        </div>
        <div class="small-img-col me-2">
          <img src="./img/<?php echo htmlspecialchars($row['product_image2']); ?>" class="small-img" width="100%">
        </div>
        <div class="small-img-col me-2">
          <img src="./img/<?php echo htmlspecialchars($row['product_image3']); ?>" class="small-img" width="100%">
        </div>
        <div class="small-img-col me-2">
          <img src="./img/<?php echo htmlspecialchars($row['product_image4']); ?>" class="small-img" width="100%">
        </div>
      </div>
    </div>

    <!-- Display product info -->

  <div class="col-lg-6 col-md-12 col-sm-12">
      <h6><?php echo $row['product_category'] ?></h6>
      <h3 class="py-4"><?php echo $row['product_name'] ?></h3>
      <h2><?php echo $row['product_price'] ?> $</h2>


<!-- proceesing when button adđ to cart was click -->
        <form method="POST" action="cart.php">
          <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
          <input type="hidden" name="product_image" value="<?php echo $row['product_image'] ?>">
          <input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>">
          <input type="hidden" name="product_price" value="<?php echo $row['product_price'] ?>">
        <input type="number" min="0" max="100" value="1" name="product_quantity"/>
        <button type="submit" class="buy-btn" name ="add_to_cart">Thêm vào giỏ hàng</button>
    </form>

      



      <h4 class="my-5">Thông tin sản phẩm</h4>
      <span><?php echo $row['product_description'] ?></span>
  </div>
<!-- #region -->

</section>
<!-- Similar section -->
 <!-- Shoess section -->
 <section id="similar" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h2>Các sản phẩm có thể bạn sẽ thích </h2>
    <hr>
    <p>Hãy khám phá các sản phẩm đặc sắc của chúng tôi</p>
  </div>
  <div class="row mx-auto container-fluid">
    <?php
    $similar_products = getSimilarProduct($row['product_id'], $row['product_category']);
    if ($similar_products) {
        while ($similar = $similar_products->fetch_assoc()) {
    ?>
    <div class="text-center col-lg-3 col-md-4 col-sm-12 product" onclick="window.location.href='single_product.php?product_id=<?php echo $similar['product_id']; ?>';">
        <img class="img-fluid mb-3" src="img/<?php echo $similar['product_image']; ?>" />
        <div class="star">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $similar['product_name']; ?></h5>
        <h4 class="p-price"><?php echo number_format($row['product_price'], 0); ?>$</h4>
        <a href="single_product.php?product_id=<?php echo $similar['product_id']; ?>">
            <button class="p-buy-button">Mua ngay</button>
        </a>
    </div>
    <?php 
        } // end while
    } else {
        echo "<p class='text-center'>Không tìm thấy sản phẩm tương tự.</p>";
    }
    ?>
    <?php } ?>
  </div>
</section>

 <!-- End Shop Shoess -->
<!-- End Line 5 -->

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