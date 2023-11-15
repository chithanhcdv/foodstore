<?php
session_start();

unset($_SESSION['username'], $_SESSION['id_user']);

echo '
    <script>
        alert("Bạn đã đăng xuất thành công!");
        window.location.href = "/../";
    </script>
';
?>