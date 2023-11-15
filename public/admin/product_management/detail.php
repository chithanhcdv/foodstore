<?php
$pageTitle = "Thông tin sản phẩm";
require_once __DIR__ . '/../partials/header.php';
?>

    <main> 
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">       
                    <div class="card">
                        <div class="card-header">
                            <h3>Thông tin sản phẩm</h3>
                        </div>
                        <div class="card-body" id="detail-product">
                            <div class="row">

<?php
if(!isset($_SESSION['username_admin'])){
    header("Location: /../admin/login.php");
}
if (isset($_GET['id_product']) && is_numeric($_GET['id_product']) && ($_GET['id_product'] > 0)) {
    $query = "SELECT * FROM product WHERE id_product=?";

    try{
        $statement = $pdo-> prepare($query);
        $statement->execute([$_GET['id_product']]);
        $row = $statement->fetch();
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }

    if (!empty($row)) {
                echo'
                    <div class="col-md-6">
                        <p class="product-info">ID:' . '  ' . htmlspecialchars($row['id_product']) . '</p>
                        <p class="product-info">Tên:' . '  ' . htmlspecialchars($row['name']) . '</p>
                        <p class="product-info">Giá bán:' . '  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</p>
                        <p class="product-info">Loại:' . '  ' . htmlspecialchars($row['type']) . '</p>
                        <p class="product-info">Khuyến mãi:' . '  ' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</p>
                        <p class="product-info">Bán chạy:' . '  ' . htmlspecialchars($row['bestseller']) . '</p>  
                    </div>          
                    ';

                    if((empty($row['image']))){
                        echo'
                            <div class="col-md-6">
                                    <img src="/../images/product/food.png" class="detail-product-image">          
                            </div>
                        ';
                    } else{
                    echo '
                            <div class="col-md-6">
                                    <img src="' . htmlspecialchars($row['image']) . '" class="detail-product-image">                
                            </div>
                    ';
                    }
                    echo'
                            </div>
                            <div class="row">
                                <p class="product-info">Mô tả:' . '  ' . htmlspecialchars($row['description']) . '</p>
                            </div>
                    ';
                 
    }
} else{
    echo '
        <script>
            alert("Không tìm thấy ID sản phẩm");
            window.location.href = "/../admin/product_management/load.php";
        </script>
        ';
}
?>
                     
                        </div>
                    </div> 
                </div>
                <div class="col-lg-3"></div>
            </div>     
        </div>
    </main>
</body>
</html>