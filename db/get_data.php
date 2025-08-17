<?php
// Lấy 4 sản phẩm nổi bật từ cơ sở dữ liệu
function getFeatureProduct() {
    include('connect.php'); // Bao gồm file kết nối cơ sở dữ liệu

    $sql = $connect->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 4"); // Truy vấn 4 sản phẩm từ bảng products
    $sql->execute(); // Thực thi truy vấn
    return $sql->get_result(); // Trả về kết quả của truy vấn
}


// Get products by category
function getProductByCategory($category) {
    include('connect.php'); // Bao gồm tệp kết nối cơ sở dữ liệu

    $sql = $connect->prepare("SELECT * FROM products WHERE product_category = '$category' ORDER BY RAND() LIMIT 4"); // Lấy 4 sản phẩm theo danh mục ngẫu nhiên
    $sql->execute(); // Thực thi truy vấn
    return $sql->get_result(); // Trả về kết quả truy vấn
}

// Get all products from DB
function getAllProduct(){
    include('connect.php');
    $sql = $connect->prepare("SELECT * FROM products ORDER BY RAND()"); // get all products from DB
    $sql->execute();
    return $sql->get_result();
}

// Lấy thông tin chi tiết sản phẩm từ cơ sở dữ liệu dựa trên product_id
function getProductDetails($product_id){
    include('connect.php'); // Bao gồm tệp kết nối cơ sở dữ liệu
    $sql = $connect->prepare("SELECT * FROM products WHERE product_id = ?"); // Truy vấn sản phẩm theo product_id
    $sql->execute([$product_id]); // Thực thi truy vấn với tham số product_id
    return $sql->get_result(); // Trả về kết quả truy vấn
}


// Lấy sản phẩm tương tự
function getSimilarProduct($id, $category){
    include('connect.php'); // Bao gồm file kết nối cơ sở dữ liệu
    // Truy vấn các sản phẩm liên quan với danh mục tương tự
    $sql = $connect->prepare("SELECT * FROM products WHERE product_category = '$category' AND product_id != $id ORDER BY RAND() LIMIT 4");
    $sql->execute();
    return $sql->get_result(); // Trả về kết quả truy vấn
}
?>
