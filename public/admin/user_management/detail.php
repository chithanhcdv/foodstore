<?php
$pageTitle = "Thông tin khách hàng";
require_once __DIR__ . '/../partials/header.php';
?>

    <main> 
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">       
                    <div class="card">
                        <div class="card-header">
                            <h3>Thông tin khách hàng</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

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
                echo'
                    <div class="col-md-6">
                        <p>ID:' . '  ' . htmlspecialchars($row['id_user']) . '</p>
                        <p>Tài khoản:' . '  ' . htmlspecialchars($row['username']) . '</p>
                        <p>Mật khẩu:' . '  ' . htmlspecialchars($row['password']) . '</p>
                        <p>Họ tên:' . '  ' . htmlspecialchars($row['name']) . '</p>
                        <p>Email:' . '  ' . htmlspecialchars($row['email']) . '</p>
                        <p>Số điện thoại:' . '  ' . '0' . htmlspecialchars($row['phone']) . '</p>
                        <p>Địa chỉ:' . '  ' . htmlspecialchars($row['address']) . '</p>
                    </div>          
                    ';

                    if((empty($row['image']))){
                        echo'
                            <div class="col-md-6">
                                    <img src="/../images/user/avatar.png" class="user-image">          
                            </div>
                        ';
                    } else
                    echo '
                            <div class="col-md-6">
                                    <img src="'  . htmlspecialchars($row['image']) . '" alt="Your Image" class="user-image">                
                            </div>
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
                        </div>
                    </div> 
                </div>
                <div class="col-lg-3"></div>
            </div>     
        </div>
    </main>
</body>
</html>