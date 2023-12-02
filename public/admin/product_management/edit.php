<?php
$pageTitle = "Chỉnh sửa sản phẩm";
require_once __DIR__ . '/../partials/header.php';
?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>         
                <div class="col-lg-6">

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
                echo '
                    <form class="edit-form" method="post" action="edit.php" enctype="multipart/form-data" id="product-edit-form">
                        <h3>Chỉnh sửa sản phẩm ID:' . '  ' . htmlspecialchars($row['id_product']) . '</h3>
                        <div class="mb-3">
                            <label> <strong>Tên</strong>
                            <span>
                                <input name="new_name" type="text" class="form-control edit-product-input" value="' . htmlspecialchars($row['name']) . '" maxlength="100" required>
                            </span>
                            </label>
                        </div>     
                        <div class="mb-3">
                            <label> <strong>Giá bán</strong>
                            <span>
                                <input name="new_price" type="text" class="form-control edit-product-input" value="' . htmlspecialchars($row['price']) . '" maxlength="10" required>
                            </span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Mô tả</strong>
                            <span>
                                <textarea name="new_description" class="form-control edit-product-input">' . htmlspecialchars($row['description']) . '</textarea>
                            </span>
                            </label>
                        </div>
                         <div class="mb-3">
                            <label> <strong>Loại</strong>
                            <div class="checkbox-edit">
                                <div class="checkbox-input">
                                    <input name="new_type" type="radio" class="" value="Gà">Gà
                                </div>
                                <div class="checkbox-input">
                                    <input name="new_type" type="radio" class="" value="Pizza">Pizza
                                </div>
                                <div class="checkbox-input">
                                    <input name="new_type" type="radio" class=""  value="Hamburger">Hamburger
                                </div>
                                <div class="checkbox-input">
                                    <input name="new_type" type="radio" class="" value="Mì ý">Mì ý
                                </div>
                                <div class="checkbox-input">
                                    <input name="new_type" type="radio" class="" value="Xúc xích">Xúc xích
                                </div>
                                <div class="checkbox-input">
                                    <input name="new_type" type="radio" class="" value="Tráng miệng">Tráng miệng
                                </div>
                                <div class="checkbox-input">
                                    <input name="new_type" type="radio" class="" value="Đồ uống">Đồ uống
                                </div>
                            </div>
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for=""> <strong>Giá khuyến mãi</strong>
                            <span>
                                <input type="text" class="form-control add-product-input" name="new_sale" placeholder="Nhập giá khuyến mãi mới" value="' . htmlspecialchars($row['sale']) . '">
                            </span>
                            </label>
                            </div>

                        <div class="mb-3">
                            <label for=""> <strong>Bán chạy</strong>
                            <div class="checkbox-edit">
                                <div class="checkbox-input">
                                    <input name="new_bestseller" type="radio" class="" value="Có">Có
                                </div>
                                <div class="checkbox-input">
                                    <input name="new_bestseller" type="radio" class="" value="Không">Không
                                </div>           
                            </div>
                            </label>
                        </div>  

                        <div class="mb-3">
                            <label> <strong>Hình ảnh</strong>
                            <span>';
                            if(empty($row['image'])){
                                echo '<img src="/../images/product/food.png" class="edit-product-image">';
                            } else {
                                echo '<img src="' . htmlspecialchars($row['image']) . '" class="edit-product-image">';
                            }    
                            echo' <input name="image" type="file" class="form-control edit-product-input" id="image"  placeholder="Chọn avatar mới" value="' .   htmlspecialchars($row['image']) . '">
                            </span>
                            </label>
                        </div>
                        <input type ="hidden" name="id_product" class="form-control edit-product-input" value="' . htmlspecialchars($_GET['id_product']) . '">
                        <div class="edit-button">
                            <button type="submit" class="btn btn-warning" id="edit-button">Chỉnh Sửa Sản Phẩm</button>
                        </div>
                    </form>
                ';
    } 
} elseif (isset($_POST['id_product']) && is_numeric($_POST['id_product']) && ($_POST['id_product'] > 0)){
    $query = "SELECT * FROM product where id_product = ?";
    try{
        $statement = $pdo-> prepare($query);
        $statement->execute([$_POST['id_product']]);
        while($row = $statement->fetch()){
            $old_image = $row['image'];
            $old_type = $row['type'];
            $old_bestseller = $row['bestseller'];
        }
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }
   if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    
    if($_POST['new_type'] === 'Gà'){
        $target_directory = "C:/CT27106/foodstore/public/images/product/ga/";
    }
    else if ($_POST['new_type'] === 'Pizza'){
        $target_directory = "C:/CT27106/foodstore/public/images/product/pizza/";
    }
    else if ($_POST['new_type'] === 'Hamburger'){
        $target_directory = "C:/CT27106/foodstore/public/images/product/hamburger/";
    }
    else if ($_POST['new_type'] === 'Mì ý'){
        $target_directory = "C:/CT27106/foodstore/public/images/product/miy/";
    }
    else if ($_POST['new_type'] === 'Xúc xích'){
        $target_directory = "C:/CT27106/foodstore/public/images/product/xucxich/";
    }
    else if ($_POST['new_type'] === 'Tráng miệng'){
        $target_directory = "C:/CT27106/foodstore/public/images/product/trangmieng/";
    }
    else if ($_POST['new_type'] === 'Đồ uống'){
        $target_directory = "C:/CT27106/foodstore/public/images/product/douong/";
    }
    else {
        $target_directory = "C:/CT27106/foodstore/public/images/product/{$_POST['new_type']}/";
    }
    
    // Đường dẫn đầy đủ của file đích
    $target_file = $target_directory . basename($file_name);

    // Không di chuyển file, chỉ cập nhật đường dẫn trong cơ sở dữ liệu
    if($_POST['new_type'] === 'Gà'){
        $target_file_in_db = "/../images/product/ga/" . basename($file_name);
    }

        else if($_POST['new_type'] === 'Pizza'){
        $target_file_in_db = "/../images/product/pizza/" . basename($file_name);
    }

        else if($_POST['new_type'] === 'Hamburger'){
        $target_file_in_db = "/../images/product/hamburger/" . basename($file_name);
    }

        else if($_POST['new_type'] === 'Mì ý'){
        $target_file_in_db = "/../images/product/miy/" . basename($file_name);
    }

        else if($_POST['new_type'] === 'Xúc xích'){
        $target_file_in_db = "/../images/product/xucxich/" . basename($file_name);
    }

        else if($_POST['new_type'] === 'Tráng miệng'){
        $target_file_in_db = "/../images/product/trangmieng/" . basename($file_name);
    }

        else if($_POST['new_type'] === 'Đồ uống'){
        $target_file_in_db = "/../images/product/douong/" . basename($file_name);
    }

        else if(!empty($_POST['new_type'])){
        $target_file_in_db = "/../images/product/{$_POST['new_type']}/" . basename($file_name);
    }

        else{
        $target_file_in_db = "/../images/product/" . basename($file_name);
    }

    // Di chuyển file từ thư mục tạm đến thư mục đích
    move_uploaded_file($file_tmp, $target_file);
    } else if (isset($old_image)){
    $target_file_in_db = $old_image;
    } else{
    $target_file_in_db = "";
    }

    if (!isset($_POST['new_type'])) {
    $_POST['new_type'] = $old_type;
    }

    if(!isset($_POST['new_bestseller'])){
        $_POST['new_bestseller'] = $old_bestseller;
    }

    $query = 'UPDATE product SET name=?, price=?, description=?, type=?, sale=?, bestseller=?, image=? WHERE id_product=?';

    try {
        $statement = $pdo->prepare($query);
        $statement->execute([
            $_POST['new_name'],
            $_POST['new_price'],
            $_POST['new_description'],
            $_POST['new_type'],
            $_POST['new_sale'],
            $_POST['new_bestseller'],
            $target_file_in_db, // Lưu đường dẫn trong cơ sở dữ liệu
            $_POST['id_product']
        ]);
        echo '
        <script>
            alert("Chỉnh sửa sản phẩm thành công");
            window.location.href = "/../admin/product_management/load.php";
        </script>
        ';
    } catch (PDOException $e) {
        echo '
        <script>
            alert("Chỉnh sửa sản phẩm thất bại");
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
                <div class="col-lg-3"></div>
            </div>
        </div>
    </main>
</body>
</html>