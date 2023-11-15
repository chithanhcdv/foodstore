<?php
$pageTitle = "Danh sách khách hàng";
require_once __DIR__ . '/../partials/header.php';
?>

    <main class="load-main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <h1>Danh sách khách hàng</h1>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Tài khoản</th>           
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tùy chọn</th>
                            </tr>
                        </thead>

<?php
if(!isset($_SESSION['username_admin'])){
    header("Location: /../admin/login.php");
}
else{
    $query = 'SELECT * FROM user';
    try{
        $statemen = $pdo->prepare($query);
        $statemen->execute();
        while ($row = $statemen->fetch()){
            echo '
                <tbody>
                    <tr>
                        <th>' . htmlspecialchars($row['id_user']) . '</th>
                        <td>' . htmlspecialchars($row['name']) . '</td>
                        <td>' . htmlspecialchars($row['username']) . '</td>
                        <td>';

            if((empty($row['image']))){
                echo '<img src="/../images/user/avatar.png" class="user-image">';
            } else {
                echo '<img src="' . htmlspecialchars($row['image']) . '">';
            }

            echo '</td>
                        <td>
                            <div class="detail-link">
                                <button class="btn btn-info"><a href="/../admin/user_management/detail.php?id_user=' . htmlspecialchars($row['id_user']) . '">Xem chi tiết</a></button>  
                            </div>

                            <div class="edit-link">
                                <button class="btn btn-warning"><a href="/../admin/user_management/edit.php?id_user=' . htmlspecialchars($row['id_user']) . '">Sửa</a></button>
                            </div>
                            
                            <div class="delete-link">
                                <button class="btn btn-danger"><a href="/../admin/user_management/delete.php?id_user=' . htmlspecialchars($row['id_user']) . '">Xóa</a></button>
                            </div>
                        </td>
                    </tr>                            
                </tbody>
            ';
        }  
    }  catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include __DIR__ . '/../partials/show_error.php';
    }
}
?>      
       
                    </table>
                    <div class="add-link">
                        <a href="/../admin/user_management/add.php">Thêm người dùng mới</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
