<?php
$pageTitle = "Danh sách sản phẩm";
require_once __DIR__ . '/../partials/header.php';
?>

    <main class="load-main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <h1>Danh sách sản phẩm</h1>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Giá bán</th>  
                                <th scope="col">Giá khuyến mãi</th>          
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>

<?php
if(!isset($_SESSION['username_admin'])){
    header("Location: /../admin/login.php");
}
else{
    $query = 'SELECT * FROM product';
    try{
        $statemen = $pdo->prepare($query);
        $statemen->execute();
        while ($row = $statemen->fetch()){
            echo '
                
                    <tr>
                        <th class="load-product">' . htmlspecialchars($row['id_product']) . '</th>
                        <td class="load-product-name">' . htmlspecialchars($row['name']) . '</td>
                        <td class="load-product">' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</td>
                        <td class="load-product">' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</td>
                        <td>';

            if((empty($row['image']))){
                echo '<img src="/../images/product/book3.jpg" class="load-product-image">';
            } else {
                echo '<img src="' . htmlspecialchars($row['image']) . '" class="load-product-image">';
            }

            echo '</td>
                        <td>
                            <div class="detail-link">
                                <button class="btn btn-info"><a href="/../admin/product_management/detail.php?id_product=' . htmlspecialchars($row['id_product']) . '">Xem chi tiết</a></button>  
                            </div>

                            <div class="edit-link">
                                <button class="btn btn-warning"><a href="/../admin/product_management/edit.php?id_product=' . htmlspecialchars($row['id_product']) . '">Sửa</a></button>
                            </div>
                            
                            <div class="delete-link">
                                <button class="btn btn-danger"><a href="/../admin/product_management/delete.php?id_product=' . htmlspecialchars($row['id_product']) . '">Xóa</a></button>
                            </div>
                        </td>
                    </tr>                            
                ';
            }  

    }  catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include __DIR__ . '/../partials/show_error.php';
    }
}
?>

                        </tbody>
                    </table>
                    <div class="add-link">
                        <a href="/../admin/product_management/add.php" id="add-link">Thêm sản phẩm mới</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>