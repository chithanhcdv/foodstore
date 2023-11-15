<?php
$pageTitle = "Thêm sản phẩm mới";
require_once __DIR__ . '/../partials/header.php';
?>

    <main> 
        <div class="container"> 
             <div class="row"> 
                <div class="col-lg-3"></div>         
                <div class="col-lg-6">
                    <form class="add-form" id="product-add-form" method="post" enctype="multipart/form-data">
                        <h3 class="add-text">Thêm Sản Phẩm Mới</h3>
                            <div class="mb-3">
                                <label for=""> <strong>Tên</strong>
                                <span>
                                    <input name="name" type="text" class="form-control add-product-input" maxlength="100" required>
                                </span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label for=""> <strong>Giá bán</strong>
                                <span>
                                    <input name="price" type="text" class="form-control add-product-input" maxlength="10" required>
                                </span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label for=""> <strong>Mô tả</strong>
                                <span>
                                    <textarea name="description" class="form-control add-product-input"></textarea>
                                </span>
                                </label>
                            </div>

                           <div class="mb-3">
                                <label for=""> <strong>Loại</strong>
                                <div class="checkbox-edit">
                                    <div class="checkbox-input">
                                        <input name="type" type="radio" class="" value="Gà" required>Gà
                                    </div>
                                    <div class="checkbox-input">
                                        <input name="type" type="radio" class="" value="Pizza" required>Pizza
                                    </div>
                                    <div class="checkbox-input">
                                        <input name="type" type="radio" class="" value="Hamburger" required>Hamburger
                                    </div>
                                    <div class="checkbox-input">
                                        <input name="type" type="radio" class="" value="Mì ý" required>Mì ý
                                    </div>
                                    <div class="checkbox-input">
                                        <input name="type" type="radio" class="" value="Xúc xích" required>Xúc xích
                                    </div>
                                    <div class="checkbox-input">
                                        <input name="type" type="radio" class="" value="Tráng miệng" required>Tráng miệng
                                    </div>
                                    <div class="checkbox-input">
                                        <input name="type" type="radio" class="" value="Đồ uống" required>Đồ uống
                                    </div>
                                </div>
                                </label>
                            </div>  

                            <div class="mb-3">
                                <label for=""> <strong>Giá khuyến mãi</strong>
                                <span>
                                    <input name="sale" type="text" class="form-control add-product-input" maxlength="10">
                                </span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label for=""> <strong>Bán chạy</strong>
                                <div class="checkbox-edit">
                                    <div class="checkbox-input">
                                        <input name="bestseller" type="radio" class="" value="Có">Có
                                    </div>
                                    <div class="checkbox-input">
                                        <input name="bestseller" type="radio" class="" value="Không">Không
                                    </div>           
                                </div>
                                </label>
                            </div>  
        
                            <div class="mb-3">
                                <label for=""> <strong>Hình ảnh</strong>
                                <span>
                                    <input name="image" type="file" class="form-control add-product-input" >
                                </span>
                                </label>
                            </div>

                        <div class="add-button">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </main>
</body>
</html>

<?php
if(!isset($_SESSION['username_admin'])){
    header("Location: /../admin/login.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['name'], $_POST['price'], $_POST['description'], $_POST['sale'])) {
        $_POST['type'] = isset($_POST['type']) ? $_POST['type'] : '';
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
            if($_POST['type'] === 'Gà'){
                $target_directory = "C:/CT27106/foodstore/public/images/product/ga/";
            }
            else if ($_POST['type'] === 'Pizza'){
                $target_directory = "C:/CT27106/foodstore/public/images/product/pizza/";
            }
            else if ($_POST['type'] === 'Hamburger'){
                $target_directory = "C:/CT27106/foodstore/public/images/product/hamburger/";
            }
            else if ($_POST['type'] === 'Mì ý'){
                $target_directory = "C:/CT27106/foodstore/public/images/product/miy/";
            }
            else if ($_POST['type'] === 'Xúc xích'){
                $target_directory = "C:/CT27106/foodstore/public/images/product/xucxich/";
            }
            else if ($_POST['type'] === 'Tráng miệng'){
                $target_directory = "C:/CT27106/foodstore/public/images/product/trangmieng/";
            }
            else if ($_POST['type'] === 'Đồ uống'){
                $target_directory = "C:/CT27106/foodstore/public/images/product/douong/";
            }
            else {
                $target_directory = "C:/CT27106/foodstore/public/images/product/{$_POST['type']}/";
            }

            // Đường dẫn đầy đủ của file đích
            $target_file = $target_directory . basename($file_name);

            // Không di chuyển file, chỉ cập nhật đường dẫn trong cơ sở dữ liệu
            
            if($_POST['type'] === 'Gà'){
                $target_file_in_db = "/../images/product/ga/" . basename($file_name);
            }

             else if($_POST['type'] === 'Pizza'){
                $target_file_in_db = "/../images/product/pizza/" . basename($file_name);
            }

             else if($_POST['type'] === 'Hamburger'){
                $target_file_in_db = "/../images/product/hamburger/" . basename($file_name);
            }

             else if($_POST['type'] === 'Mì ý'){
                $target_file_in_db = "/../images/product/miy/" . basename($file_name);
            }

             else if($_POST['type'] === 'Xúc xích'){
                $target_file_in_db = "/../images/product/xucxich/" . basename($file_name);
            }

             else if($_POST['type'] === 'Tráng miệng'){
                $target_file_in_db = "/../images/product/trangmieng/" . basename($file_name);
            }

            else if($_POST['type'] === 'Đồ uống'){
                $target_file_in_db = "/../images/product/douong/" . basename($file_name);
            }

             else if(!empty($_POST['type'])){
                $target_file_in_db = "/../images/product/{$_POST['type']}/" . basename($file_name);
            }

             else{
                $target_file_in_db = "/../images/product/" . basename($file_name);
            }

            move_uploaded_file($file_tmp, $target_file);
        } else {
            $target_file_in_db = "";
        }

        $_POST['bestseller'] = isset($_POST['bestseller']) ? $_POST['bestseller'] : '';

        $query= 'INSERT INTO product (name, price, type, description, sale, bestseller, image) VALUES (?, ?, ?, ?, ?, ?, ?)';
        try{
            $statement = $pdo->prepare($query);
            $statement->execute([
                $_POST['name'],
                $_POST['price'],
                $_POST['type'],
                $_POST['description'],
                $_POST['sale'],
                $_POST['bestseller'],
                $target_file_in_db
            ]);

        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }
        
        if ($statement && $statement->rowCount() == 1){
        echo '
        <script>
            alert("Thêm sản phẩm mới thành công");
            window.location.href = "/../admin/product_management/load.php";
        </script>
        ';
        } else{
        echo '
        <script>
            alert("Thêm sản phẩm mới không thành công");
        </script>
        ';
        }
    }
}

?>
