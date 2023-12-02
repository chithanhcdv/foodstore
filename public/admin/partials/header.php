<?php
session_start();
ob_start();
require_once __DIR__ . '/../partials/db_connect.php'; 
//ob_end_clean();
?>

<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageTitle) ? $pageTitle : "Trang chủ"; ?></title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel='shortcut icon' href="/../images/admin/admin.png"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="/../admin/css/style.css">
</head>
<body class="body">

    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div id="logo">
                            <a href="/../admin">
                                <img src="/../images/admin/admin.png" alt="" class="logo">
                            </a>
                        </div>
                    </div>                 
                    <div class="col-md-6">
                        <div class="input-group mb-3 search-input">
                            <form action="" class="input-group">
                                <input type="text" class="form-control" placeholder="Hãy nhập gì đó..." aria-label="Recipient's username" aria-describedby="basic-addon2" id="searchInput">
                                <button class="input-group-text"><span class="" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span></button>
                            </form>
                        </div>
                    </div>      
                    <div class="col-md-2"></div>    
                    <div class="col" id="header-right">
                        <div class="row">
                            <div class="col">
                                <a href=""><i class="fa-solid fa-bell header-icon" id="bell-icon"></i></a>
                            </div>
                            <div class="col">
                                <a href=""><i class="fa-solid fa-envelope header-icon" id="letter-icon"></i></a>
                            </div>
                            <div class="col">
                                <div class="dropdown">
                                    <button class="btn btn" type="button" data-toggle="dropdown">
                                        <i class="fa-solid fa-user header-icon" id="user-icon"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                    <?php        
                                            if(isset($_SESSION['username_admin'])){
                                            echo '<li><a class="login"> <label>Xin chào</label> ' . $_SESSION['username_admin'] . ' </a></li>';
                                            echo '<li><a href="/../admin/logout.php" class="login">Đăng xuất</a></li>';
                                        } else {
                                            echo '<li><a href="login.php" class="login">Đăng nhập</a></li>';
                                        }
                                    ?>  
                                    </ul>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once __DIR__ . '/../partials/navbar.php';
        ?>
    </header>
