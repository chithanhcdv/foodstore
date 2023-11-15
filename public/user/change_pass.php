<?php
$pageTitle = "Đổi mật khẩu";
require_once dirname(__DIR__). '/../partials/header.php'
?>

    <main> 
        <div class="container"> 
            <div class="row">
                <div class="col-lg-3"></div>        
                <div class="col-lg-6">
                    <form id="user-change_pass-form" method="post" class="user-form">
                        <h1 class="user-form-text" id="change_pass-form-text">Đổi mật khẩu</h1>
                        <div class="mb-3 form-group">
                            <input type="password" class="form-control" name="password" id="change_pass-password" placeholder="Mật khẩu hiện tại" pattern=".{6,20}" title="Mật khẩu phải chứa từ 6 đến 20 ký tự" required> 
                            <i class="fa-solid fa-eye-slash show-password" id="change_pass-show-password"></i>
                            <span class="error-message password-error"></span> 
                        </div>
                        <div class="mb-3 form-group">
                            <input type="password" class="form-control" name="new_password" id="change_pass-new_password" placeholder="Mật khẩu mới" pattern=".{6,20}" title="Mật khẩu phải chứa từ 6 đến 20 ký tự" required>
                            <i class="fa-solid fa-eye-slash show-password" id="change_pass-show-new_password"></i>
                            <span class="error-message new_password-error"></span>
                        </div>
                         <div class="mb-3 form-group">
                            <input type="password" class="form-control" name="renew_password" id="change_pass-renew_password" placeholder="Nhập lại mật khẩu mới" pattern=".{6,20}" title="Mật khẩu phải chứa từ 6 đến 20 ký tự" required>
                            <i class="fa-solid fa-eye-slash show-password" id="change_pass-show-renew_password"></i>
                            <span class="error-message renew_password-error"></span>
                        </div>
                        <div class="mb-3 form-group register-button-container">
                            <button type="submit" class="btn btn-primary register-button">Đổi mật khẩu</button>
                        </div>   
                    </form>
                </div>
                <div class="col-lg-3"></div>    
            </div>
        </div>
    </main>

<?php
if(isset($_SESSION['id_user'], $_SESSION['username'], $_POST['password'], $_POST['new_password'], $_POST['renew_password'])){
    $querycheck = "SELECT password FROM user WHERE id_user=?";
    try{
        $statementcheck = $pdo->prepare($querycheck);
        $statementcheck->execute([$_SESSION['id_user']]);
        $rowcheck = $statementcheck->fetch();

        if($_POST['password'] === $rowcheck['password']){
            if($_POST['new_password'] === $_POST['renew_password']){
                $query = "UPDATE user SET password =? WHERE id_user=?";
                $statement = $pdo->prepare($query);
                $statement->execute([$_POST['new_password'], $_SESSION['id_user']]);
                echo '<script>alert("Mật khẩu đã được cập nhật thành công")</script>;';
            } else{
                echo '<script>alert("Mật khẩu mới và nhập lại mật khẩu không khớp, vui lòng nhập lại")</script>';
            }
        } else{
            echo '<script>alert("Mật khẩu hiện tại không đúng, vui lòng nhập lại")</script>';
        }
    } 
    catch(PDOException $e){
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage(); 
        include dirname(__DIR__) . '/../partials/show_error.php';          
    }
}
?>

<?php
require_once dirname(__DIR__) . '/../partials/footer.php';
?> 