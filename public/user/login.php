<?php
$pageTitle = "Đăng nhập";
require_once dirname(__DIR__) . '/../partials/header.php';
?>
   
    <main> 
        <div class="container"> 
             <div class="row"> 
                <div class="col-lg-3"></div>       
                <div class="col">
                    <form id="user-login-form" method="post" action="login.php" class="user-form">
                        <h1 class="user-form-text" id="login-form-text">Đăng nhập</h1>
                        <div class="mb-3 form-group">
                            <input type="text" class="form-control" name="username" placeholder="Tên tài khoản" pattern="[a-zA-Z0-9]{3,20}" title="Tên tài khoản phải chứa từ 3 đến 20 ký tự và chỉ bao gồm chữ cái và số" required>
                            <span class="error-message username-error"></span> 
                        </div>
                        <div class="mb-3 form-group">
                            <input type="password" class="form-control" name="password" id="login-password" placeholder="Mật khẩu" pattern=".{6,20}" title="Mật khẩu phải chứa từ 6 đến 20 ký tự" required>
                            <i class="fa-solid fa-eye-slash show-password" id="login-show-password"></i>
                            <span class="error-message password-error"></span>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Ghi nhớ tôi</label>
                            <label class="forgot-password"><a href="" class="forgot-password-link">Quên mật khẩu</a></label>
                        </div>
                        <div class="mb-3 form-group login-button-container">
                            <button type="submit" class="btn btn-primary login-button">Đăng nhập</button>
                        </div>
                        <div class="mb-3 form-group user-form-link" id="register-form-link">
                            <p class="">Chưa có tài khoản? <a href="/../user/register.php" class="register-link">Đăng ký</a></p>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </main>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "SELECT id_user, username, password FROM user WHERE username = ? AND password = ?";
    
    try {
        $statement = $pdo->prepare($query);
        $statement->execute([$username, $password]);

        if ($statement->rowCount() > 0) {
            $row = $statement->fetch();
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $row['id_user'];
            echo '
                <script>
                    alert("Bạn đã đăng nhập thành công!");
                    window.location.href = "/../";
                </script>
            ';        
        } else {
            echo '<script>alert("Đăng nhập thất bại, tài khoản hoặc mật khẩu không đúng!");</script>';
        }   
    } catch (PDOException $e) {
        $error_message = 'Không thể kết nối đến CSDL';
        $reason = $e->getMessage();
        include dirname(__DIR__) . '/../partials/show_error.php';
    }
}
?>
           
<?php
require_once dirname(__DIR__) . '/../partials/footer.php';
?>   