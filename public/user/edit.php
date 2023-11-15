<?php
$pageTitle = "Cập nhật thông tin";
require_once dirname(__DIR__) . '/../partials/header.php';
?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>         
                <div class="col">

<?php 
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
                    <form id="user-edit-form" class="user-form" method="post" action="edit.php" enctype="multipart/form-data">
                        <div class="edit-text">
                            <h3>Cập nhật tài khoản: ' . htmlspecialchars($row['username']) . '</h3>
                        </div>
                        <div class="mb-3 edit-user">
                            <strong>Tên</strong>
                            <input name="new_name" type="text" class="form-control edit-user-input" placeholder="Nhập tên người dùng mới" value="' . htmlspecialchars($row['name']) . '" maxlength="30" required>
                        </div>
                        <div class="mb-3 edit-user">
                            <strong>Email</strong>
                            <input name="new_email" type="email" class="form-control edit-user-input"  placeholder="Nhập email mới" value="' . htmlspecialchars($row['email']) . '" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
                        </div>
                        <div class="mb-3 edit-user">
                            <strong>Số điện thoại</strong>
                            <input name="new_phone" type="tel" class="form-control edit-user-input"  placeholder="Nhập số điện thoại mới" value="' . '0' . htmlspecialchars($row['phone']) . '" pattern="[0-9]{10}" maxlength="10" title="Số điện thoại phải bao gồm 10 số" required>
                        </div>
                        <div class="mb-3 edit-user">
                            <strong>Địa chỉ</strong>
                            <input name="new_address" type="text" class="form-control edit-user-input"  placeholder="Nhập địa chỉ mới" value="' . htmlspecialchars($row['address']) . '" maxlength="100" required>
                        </div>

                        <div class="mb-3 edit-user">
                            <strong>Avavar</strong>
                            <input name="image" type="file" class="form-control edit-user-input" id="image"  placeholder="Chọn avatar mới" value="' .   htmlspecialchars($row['image']) . '">
                        </div>
                        <div class="mb-3 edit-user">  
                            <strong></strong>
                        ';
                            if(empty($row['image'])){
                                echo '<img src="/../images/user/avatar.png">';
                            } else {
                                echo '<img src="' . htmlspecialchars($row['image']) . '">';
                            }    
                            echo'
                        </div> 
                        <input type ="hidden" name="id_user" class="form-control edit-user-input" value="' . htmlspecialchars($_GET['id_user']) . '">
                        <div class="edit-button">
                            <button type="submit" class="btn btn-primary" id="edit-button">Cập nhật</button>
                        </div>
                    </form>
                ';
    } else {
        $error_message = 'Không thể cập nhật thông tin';
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
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include dirname(__DIR__) . '/../partials/show_error.php';
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

    $query = 'UPDATE user SET name=?, email=?, phone=?, address=?, image=? WHERE id_user=?';

    try {
        $statement = $pdo->prepare($query);
        $statement->execute([
            $_POST['new_name'],
            $_POST['new_email'],
            $_POST['new_phone'],
            $_POST['new_address'],
            $target_file_in_db,
            $_POST['id_user']
        ]);
        echo '
        <script>
            alert("Cập nhật thông tin thành công");
            window.location.href = "/../user/user_info.php";
        </script>
        ';
    } catch (PDOException $e) {
        echo '
        <script>
            alert("Cập nhật thông tin không thành công");
            window.location.href = "/../user/user_info.php";
        </script>
        ';
    }
} else{
    echo '
        <script>
            alert("Không tìm thấy ID người dùng");
            window.location.href = "/../user/user_info.php";
        </script>
        ';
}
?>
                </div>   
                <div class="col-lg-3"></div>
            </div>
        </div>
    </main>

<?php
require_once dirname(__DIR__) . '/../partials/footer.php'
?>