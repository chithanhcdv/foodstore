<?php
session_start();

unset($_SESSION['username_admin']);

echo '
    <script>
        alert("Bạn đã đăng xuất thành công!");
        window.location.href = "/../admin/index.php";
    </script>
';
?>