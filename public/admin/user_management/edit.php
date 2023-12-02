<?php
$pageTitle = "Chỉnh sửa khách hàng";
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
if (isset($_GET['id_user']) && is_numeric($_GET['id_user']) && ($_GET['id_user'] > 0)) {
    $query = "SELECT * FROM user WHERE id_user=?";

    try{
        $statement = $pdo-> prepare($query);
        $statement->execute([$_GET['id_user']]);
        $row = $statement->fetch();
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }

    if (!empty($row)) {
                echo '
                    <form class="edit-form" method="post" action="edit.php" enctype="multipart/form-data" id="user-edit-form">
                        <h3>Chỉnh sửa khách hàng ID:' . '  ' . htmlspecialchars($row['id_user']) . '</h3>
                        <div class="mb-3">
                            <label> <strong>Tài khoản</strong>
                            <span>
                                <input name="new_username" type="text" class="form-control edit-user-input" value="' . htmlspecialchars($row['username']) . '" pattern="[a-zA-Z0-9]{3,20}" title="Tên tài khoản phải chứa từ 3 đến 20 ký tự và chỉ bao gồm chữ cái và số" required>
                            </span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Mật khẩu</strong>
                            <span>
                                <input name="new_password" type="password" class="form-control edit-user-input" value="' . htmlspecialchars($row['password']) . '" pattern=".{6,20}" title="Mật khẩu phải chứa từ 6 đến 20 ký tự" required>
                            </span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Tên</strong>
                            <span>
                               <input name="new_name" type="text" class="form-control edit-user-input" value="' . htmlspecialchars($row['name']) . '" maxlength="30" required>
                            </span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Email</strong>
                            <span>
                                <input name="new_email" type="email" class="form-control edit-user-input" value="' . htmlspecialchars($row['email']) . '" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
                            </span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Số điện thoại</strong>
                            <span>
                                <input name="new_phone" type="tel" class="form-control edit-user-input" value="' . '0' . htmlspecialchars($row['phone']) . '" pattern="[0-9]{10}" maxlength="10" title="Số điện thoại phải bao gồm 10 số" required>
                            </span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Địa chỉ</strong>
                            <span>
                                <input name="new_address" type="text" class="form-control edit-user-input" value="' . htmlspecialchars($row['address']) . '" maxlength="100" required>
                            </span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Avavar</strong>
                            <span>';
                            if(empty($row['image'])){
                                echo '<img src="/../images/user/avatar.png">';
                            } else {
                                echo '<img src="' . htmlspecialchars($row['image']) . '">';
                            }    
                            echo' <input name="image" type="file" class="form-control edit-user-input" id="image" value="' .   htmlspecialchars($row['image']) . '">
                            </span>
                            </label>
                        </div>
                        <input type ="hidden" name="id_user" class="form-control edit-user-input" value="' . htmlspecialchars($_GET['id_user']) . '">
                        <div class="edit-button">
                            <button type="submit" class="btn btn-warning" id="edit-button">Chỉnh sửa người dùng</button>
                        </div>
                    </form>
                ';
    } else {
        $error_message = 'Không thể sửa người dùng này';
        $reason = $pdo_error ?? 'Không rõ nguyên nhân';
    }

} elseif (isset($_POST['id_user']) && is_numeric($_POST['id_user']) && ($_POST['id_user'] > 0)){
    $query = "SELECT * FROM user where id_user = ?";
    try{
        $statement = $pdo-> prepare($query);
        $statement->execute([$_POST['id_user']]);
        while($row = $statement->fetch()){
            $old_image = $row['image'];
        }
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }
   if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    
    $target_directory = "C:/CT27106/foodstore/public/images/user/";
    
    // Đường dẫn đầy đủ của file đích
    $target_file = $target_directory . basename($file_name);

    // Không di chuyển file, chỉ cập nhật đường dẫn trong cơ sở dữ liệu
    $target_file_in_db = "/images/user/" . basename($file_name);

    // Di chuyển file từ thư mục tạm đến thư mục đích
    move_uploaded_file($file_tmp, $target_file);
   } else if (isset($old_image)){
    $target_file_in_db = $old_image;
   } else{
    $target_file_in_db = "";
   }

    $query = 'UPDATE user SET username=?, password=?, name=?, email=?, phone=?, address=?, image=? WHERE id_user=?';

    try {
        $statement = $pdo->prepare($query);
        $statement->execute([
            $_POST['new_username'],
            $_POST['new_password'],
            $_POST['new_name'],
            $_POST['new_email'],
            $_POST['new_phone'],
            $_POST['new_address'],
            $target_file_in_db, // Lưu đường dẫn trong cơ sở dữ liệu
            $_POST['id_user']
        ]);
        echo '
        <script>
            alert("Chỉnh sửa người dùng thành công");
            window.location.href = "/../admin/user_management/load.php";
        </script>
        ';
    } catch (PDOException $e) {
        echo '
        <script>
            alert("Chỉnh sửa người dùng không thành công");
            window.location.href = "/../admin/user_management/load.php";
        </script>
        ';
    }
} else{
    echo '
        <script>
            alert("Không tìm thấy ID người dùng");
            window.location.href = "/../admin/user_management/load.php";
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