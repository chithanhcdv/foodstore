<?php
$pageTitle = "Xóa sản phẩm";
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
                        <div class="card-body">
                            
<?php
if(!isset($_SESSION['username_admin'])){
    header("Location: /../admin/login.php");
}
if (isset($_GET['id_product']) && is_numeric($_GET['id_product']) && ($_GET['id_product'] > 0)) {
    $query = "SELECT * FROM product WHERE id_product=?";

    try{
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['id_product']]);
        $row = $statement->fetch(); 
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }

    if(!empty($row)) {
                echo'
                    <form method="post" action="delete.php" class="delete-form" id="product-delete-form">
                    <div class="row">
                    <div class="col-md-6">
                        <p>ID:' . '  ' . htmlspecialchars($row['id_product']) . '</p>
                        <p>Tên:' . '  ' . htmlspecialchars($row['name']) . '</p>
                        <p>Giá bán:' . '  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</p>
                        <p>Loại:' . '  ' . htmlspecialchars($row['type']) . '</p>
                        <p>Khuyến mãi:' . '  ' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</p>
                        <p>Bán chạy:' . '  ' . htmlspecialchars($row['bestseller']) . '</p>
                    </div>          
                    ';

                    if((empty($row['image']))){
                        echo'
                            <div class="col-md-6 delete-img">
                                    <img src="/../images/product/food.png" class="delete-product-image">          
                            </div>
                        ';
                    } else
                        echo '
                            <div class="col-md-6 delete-img">
                                    <img src="'  . htmlspecialchars($row['image']) . '" class="delete-product-image">                
                            </div>
                    ';

                    echo'
                    </div>
                    <div class="row">
                        <p>Mô tả:' . '  ' . htmlspecialchars($row['description']) . '</p>
                    </div>
                    <div class="row">
                    <input type ="hidden" name="id_product" value="' . htmlspecialchars($_GET['id_product']) . '">                   
                        <button class="btn btn-danger delete-button" type="submit">Xóa</button>
                    </div>
                    </form> 
                    ';
      
    } else {
        $error_message = 'Không thể xóa sản phẩm này';
        $reason = $pdo_error ?? 'Không rõ nguyên nhân';
    }

} elseif (isset($_POST['id_product']) && is_numeric($_POST['id_product']) && ($_POST['id_product'] > 0)) {
    $query = "DELETE FROM product WHERE id_product=? LIMIT 1";

    try{
        $statement = $pdo->prepare($query);
        $statement->execute([$_POST['id_product']]);
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }

    if($statement && $statement->rowCount() == 1){
        echo '
            <script>
                alert("Xóa sản phẩm thành công");
                window.location.href = "/../admin/product_management/load.php";
            </script>
        '; 
    } else {
        echo '
            <script>
                alert("Xóa sản phẩm không thành công, lỗi!");
                window.location.href = "/../admin/product_management/load.php";
            </script>
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