<?php
require_once __DIR__ . '/../admin/partials/header.php';
require_once __DIR__ . '/../admin/partials/main.php';

if(!isset($_SESSION['username_admin'])){
    header("Location: /../admin/login.php");
}
?>
 
</body>
</html>
