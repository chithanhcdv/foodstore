<?php
$pageTitle = "Thông tin tài khoản";
require_once dirname(__DIR__) . '/../partials/header.php';
?>

    <main> 
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">       
                    <div class="card mt-4 mb-3">
                        <div class="card-header">
                            <h4>Thông tin tài khoản</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

<?php
if (isset($_SESSION['id_user']) && is_numeric($_SESSION['id_user']) && ($_SESSION['id_user'] > 0)) {
    $query = "SELECT * FROM user WHERE id_user=?";

    try{
        $statement = $pdo-> prepare($query);
        $statement->execute([$_SESSION['id_user']]);
        $row = $statement->fetch();
    } catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include dirname(__DIR__) . '/../partials/show_error.php';
    }

    if (!empty($row)) {
                echo'
                    <div class="col-lg-6">
                        <p>ID: ' . '  ' .htmlspecialchars($row['id_user']) .'</p>
                        <p>Tài khoản:' . '  ' . htmlspecialchars($row['username']) . '</p>
                        <p>Mật khẩu:' . '  ' . htmlspecialchars($row['password']) . '</p>
                        <p>Họ và tên:' . '  ' . htmlspecialchars($row['name']) . '</p>
                        <p>Email:' . '  ' . htmlspecialchars($row['email']) . '</p>
                        <p>Số điện thoại:' . '  ' . '0' . htmlspecialchars($row['phone']) . '</p>
                        <p>Địa chỉ:' . '  ' . htmlspecialchars($row['address']) . '</p>
                    </div>          
                    ';

                    if((empty($row['image']))){
                        echo'
                            <div class="col-lg-6">
                                    <img src="/../images/user/avatar.png" class="user-image">          
                            </div>
                        ';
                    } else
                    echo '
                            <div class="col-lg-6">
                                    <img src="'  . htmlspecialchars($row['image']) . '" alt="Your Image" class="user-image">                
                            </div>
                    ';

                    echo'
                            <div class="user-update-button">
                                <button class="btn btn-warning"><a href="/../user/edit.php?id_user='. htmlspecialchars($_SESSION['id_user']) .'">Cập nhật thông tin</a></button>
                            </div>
                    ';              
    }
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

<?php
require_once dirname(__DIR__) . '/../partials/footer.php';
?>   