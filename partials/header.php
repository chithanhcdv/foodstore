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
  <link rel='shortcut icon' href="/../images/logo/logo.png"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="/../css/style.css">
</head>
<body>
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 logo">
                        <a href="/../">
                            <img src="/../images/logo/logo.png">
                        </a>
                    </div>                 
                    <div class="col-md-6">
                        <div class="input-group mb-3 search-input">
                            <form action="/../product/search.php" class="input-group" method="get   ">
                                <input type="text" class="form-control" placeholder="Hãy nhập gì đó..." aria-label="Recipient's username" aria-describedby="basic-addon2" id="searchInput" name="name">
                                <button class="input-group-text" type="submit"><span class="" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span></button>
                                <div id="searchResults"></div>
                            </form>
                        </div>
                    </div>      
                    <div class="col-md-2">
                        <div class="header-icon" id="phone-icon">
                            <i class="fa-solid fa-phone fa-3x"></i>
                            <label>0902576671</label>
                        </div>
                    </div>    
                    <div class="col-md-2" id="header-right">
                        <div class="d-flex align-items-center">
                            <?php 
                            if(!isset($_SESSION['id_user'])){
                                echo '<a href="/..//cart/cart.php"><i class="fa-solid fa-shopping-bag fa-3x header-icon" id="cart-icon"></i></a>';
                            } else{
                                $count=0;
                                $query = "SELECT * FROM cart WHERE id_user=?";
                                try{
                                    $statement = $pdo->prepare($query);
                                    $statement->execute([$_SESSION['id_user']]);
                                    while($row=$statement->fetch()){
                                        $count++;
                                    }
                                } catch(PDOException $e){
                                    $pdo = $e->getMessage();
                                }
                                echo '<a href="/..//cart/cart.php"><i class="fa-solid fa-shopping-bag fa-3x header-icon" id="cart-icon"></i></a>
                                    <p id="cart-count">'. $count .'</p>  ';
                            }
                            ?>
                            <div class="dropdown" id="dropdown-user">
                                <button class="btn btn" type="button" data-toggle="dropdown">
                                    <i class="fa-solid fa-user fa-3x header-icon" id="user-icon"></i>
                                </button>
                                <ul class="dropdown-menu" id="user-menu">
                                    <?php               
                                            if(isset($_SESSION['username'], $_SESSION['id_user'])){
                                            echo '<li><strong>'. $_SESSION['username'] .'</strong></li>';
                                            echo '<li><a href="/../user/user_info.php">Thông tin tài khoản</a></li>';
                                            echo '<li><a href="/../order/order_list.php">Thông tin đơn hàng</a></li>';
                                            echo '<li><a href="/../user/change_pass.php">Đổi mật khẩu</a></li>';
                                            echo '<li><a href="/../user/logout.php">Đăng xuất</a></li>';
                                        } else {
                                            echo '<li><a href="/../user/login.php">Đăng nhập</a></li>';
                                            echo '<li><a href="/../user/register.php">Đăng ký</a></li>';
                                        }
                                    ?> 
                                </ul>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bot">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col">
                        <nav class="navbar navbar-expand-lg ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link navbar-link" href="/../">Trang chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link navbar-link" href="#">Khuyến mãi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link navbar-link" href="#">Về cửa hàng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link navbar-link" href="#">Liên hệ</a>
                                </li>
                                </ul>
                            </div>
                        </nav>    
                    </div> 
                </div>
            </div>
        </div>
    </header>