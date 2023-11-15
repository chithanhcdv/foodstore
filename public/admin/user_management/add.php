<?php
$pageTitle = "Thêm khách hàng mới";
require_once __DIR__ . '/../partials/header.php';
?>

    <main> 
        <div class="container"> 
             <div class="row"> 
                <div class="col-lg-3"></div>         
                <div class="col-lg-6">
                    <form class="add-form" id="user-add-form" method="post" enctype="multipart/form-data">
                        <h3 class="add-text">Thêm người dùng mới</h3>
                        <div class="mb-3 form-group">
                            <input type="text" class="form-control" name="username" placeholder="Tên tài khoản" pattern="[a-zA-Z0-9]{3,20}" title="Tên tài khoản phải chứa từ 3 đến 20 ký tự và chỉ bao gồm chữ cái và số" required>  
                        </div>
                        <div class="mb-3 form-group">
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu" pattern=".{6,20}" title="Mật khẩu phải chứa từ 6 đến 20 ký tự" required>
                        </div>     
                        <div class="mb-3 form-group">
                            <input type="text" class="form-control" name="name" placeholder="Họ tên" maxlength="30" required>
                        </div>     
                        <div class="mb-3 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
                        </div>     
                        <div class="mb-3 form-group">
                            <input type="tel" class="form-control" name="phone" placeholder="Số điện thoại" pattern="[0-9]{10}" maxlength="10" title="Số điện thoại phải bao gồm 10 số" required>
                        </div>     
                        <div class="mb-3 form-group">
                            <input type="text" class="form-control" name="address" placeholder="Địa chỉ" maxlength="100" required>
                        </div> 
                        <div class="mb-3 form-group">
                            <input type="file" class="form-control" name="image" placeholder="Hình ảnh">
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
    if (isset($_POST['username'], $_POST['password'], $_POST['name'], 
    $_POST['email'], $_POST['phone'], $_POST['address'])) {
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $target_directory = "C:/Cong Nghe Web/project/public/images/user/";

            // Đường dẫn đầy đủ của file đích
            $target_file = $target_directory . basename($file_name);

            // Không di chuyển file, chỉ cập nhật đường dẫn trong cơ sở dữ liệu
            $target_file_in_db = "/../images/user/" . basename($file_name);

            move_uploaded_file($file_tmp, $target_file);
        } else {
            $target_file_in_db = "";
        }

        $query= 'INSERT INTO user (username, password, name, email, phone, address, image) VALUES (?, ?, ?, ?, ?, ?, ?)';
        try{
            $statement = $pdo->prepare($query);
            $statement->execute([
                $_POST['username'],
                $_POST['password'],
                $_POST['name'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['address'],
                $target_file_in_db
            ]);
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }
        
        if ($statement && $statement->rowCount() == 1){
        echo '
        <script>
            alert("Thêm người dùng mới thành công");
            window.location.href = "/../admin/user_management/load.php";
        </script>
        ';
        } else{
        echo '
        <script>
            alert("Thêm người dùng mới không thành công");
        </script>
        ';
        }
    }
}

?>
