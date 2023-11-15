<?php
$pageTitle = "Đăng nhập";
require_once __DIR__ . '/../admin/partials/header.php';
?>

    <main>
        <div class="container">
            <div class="row">
                <form id="login-form" method="post">
                    <h3>Đăng Nhập Trang Admin</h3>
                    <div class="mb-3">
                        <input name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tài khoản" required>
                    </div>
                    <div class="mb-3">    
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mật khẩu" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="login-button">Đăng nhập</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['username_admin'] = $username;
        echo '
            <script>
                alert("Bạn đã đăng nhập thành công!");
                window.location.href = "/../admin";
            </script>
        ';
        exit;
    } else {
        echo '<script type="text/javascript">alert("Đăng nhập thất bại, tài khoản hoặc mật khẩu không đúng!");</script>';
    }
}
?>