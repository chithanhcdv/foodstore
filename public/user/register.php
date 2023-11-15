<?php
$pageTitle = "Đăng ký";
require_once dirname(__DIR__) . '/../partials/header.php'
?>
   
   <main> 
        <div class="container"> 
            <div class="row">
                <div class="col-lg-3"></div>     
                <div class="col-lg-6">
                    <form id="user-register-form" method="post" class="user-form">
                        <h1 class="user-form-text" id="register-form-text">Đăng ký</h1>
                        <div class="mb-3 form-group">
                            <input type="text" class="form-control" name="username" id="register-username" placeholder="Tên tài khoản" pattern="[a-zA-Z0-9]{3,20}" title="Tên tài khoản phải chứa từ 3 đến 20 ký tự và chỉ bao gồm chữ cái và số" required>
                            <span class="error-message username-error"></span>
                        </div>
                        <div class="mb-3 form-group">
                            <input type="password" class="form-control" name="password" id="register-password" placeholder="Mật khẩu" pattern=".{6,20}" title="Mật khẩu phải chứa từ 6 đến 20 ký tự" required>
                            <i class="fa-solid fa-eye-slash show-password" id="register-show-password"></i>
                            <span class="error-message password-error"></span>
                        </div>
                         <div class="mb-3 form-group">
                            <input type="password" class="form-control" name="re_password" id="register-re_password" placeholder="Nhập lại mật khẩu" pattern=".{6,20}" title="Mật khẩu phải chứa từ 6 đến 20 ký tự" required>
                            <i class="fa-solid fa-eye-slash show-password" id="register-show-re_password"></i>
                            <span class="error-message re_password-error"></span>
                        </div>
                        <div class="mb-3 form-group register-button-container">
                            <button type="submit" class="btn btn-primary register-button">Đăng ký</button>
                        </div>
                        <div class="mb-3 form-group user-form-link" id="login-form-link">
                            <p>Đã có tài khoản? <a href="/../user/login.php" class="login-link">Đăng nhập</a></p>
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
    $re_password = $_POST['re_password'];

    if ($password !== $re_password) {
        echo '<script>alert("Mật khẩu không khớp, vui lòng nhập lại!");</script>';
    } else {

        $querycheck = "SELECT username FROM user WHERE username = ?";
        try{
            $statementcheck = $pdo->prepare($querycheck);
            $statementcheck->execute([$username]);
            $rowcheck = $statementcheck->fetch();

            if(empty($rowcheck['username'])){
                $query = "INSERT INTO user (username, password) VALUES (?, ?)";
                $statement = $pdo->prepare($query);
                $statement->execute([$username,$password]);
                echo '  <script>alert("Đăng ký thành công, bạn sẽ được chuyển đến trang đăng nhập")
                              window.location.href = "/../user/login.php";  
                        </script>';
            } else{
                echo '<script>alert("Đăng ký thấp bại, tên đăng nhập đã tồn tại!");</script>';
            }
        } catch(PDOException $e){
            $error_message = 'Không thể kết nối đến CSDL';
            $reason = $e->getMessage();
            include dirname(__DIR__) . '/../partials/show_error.php';
        }
    }
}
?>

<?php
require_once dirname(__DIR__) . '/../partials/footer.php';
?>            