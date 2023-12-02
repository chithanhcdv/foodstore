<?php
$pageTitle = "Đơn hàng của bạn";
require_once dirname(__DIR__) . '/../partials/header.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_SESSION['id_user'], $_POST['total_amount'], $_POST['payment_method'], $_POST['ship_method'])){
        $query= "INSERT INTO orders (id_user, total_amount, payment_method, ship_method, status) VALUES (?, ?, ?, ?, ?)";

        try{
            $statement = $pdo->prepare($query);
            $statement->execute([
                $_SESSION['id_user'],
                $_POST['total_amount'],
                $_POST['payment_method'],
                $_POST['ship_method'],
                $_POST['status']
            ]);
            echo'<script>alert("Đặt hàng thành công!")</script>';

        } catch (PDOException $e) {
            $error_message = 'Không thể kết nối đến CSDL';
            $reason = $e->getMessage();
            include dirname(__DIR__) . '/../partials/show_error.php';
        }
    }

    if(isset($_SESSION['id_user'], $_POST['name'], $_POST['address'], $_POST['phone'], $_POST['email'])) {
        $query = "UPDATE user SET name=?, address=?, phone=?, email=? WHERE id_user=?";

        try{
            $statement = $pdo->prepare($query);
            $statement->execute([
                $_POST['name'],
                $_POST['address'],
                $_POST['phone'],
                $_POST['email'],
                $_SESSION['id_user']
            ]); 
        } catch(PDOException $e){
            $error_message = 'Không thể kết nối đến CSDL';
            $reason = $e->getMessage();
            include dirname(__DIR__) . '/../partials/show_error.php';
        } 
    }

    if(isset($_SESSION['id_user'], $_POST['total_amount'], $_POST['ship_method'], $_POST['payment_method'], $_POST['name'],
    $_POST['address'], $_POST['phone'], $_POST['email'], $_POST['status'])){
        $query = "DELETE FROM cart WHERE id_user=?";

        try{
            $statement = $pdo->prepare($query);
            $statement->execute([$_SESSION['id_user']]);
        } catch(PDOException $e){
            $error_message = 'Không thể kết nối đến CSDL';
            $reason = $e->getMessage();
            include dirname(__DIR__) . '/../partials/show_error.php';
        }
    }
}
?>

    <main>
        <div class="container">
            <div class="row">

<?php
if(isset($_SESSION['id_user'], $_POST['total_amount'], $_POST['ship_method'], $_POST['payment_method'], $_POST['name'],
    $_POST['address'], $_POST['phone'], $_POST['email'], $_POST['status'])){
    $query = "SELECT date FROM orders WHERE id_user=? ORDER BY date DESC";
    try{
        $statement=$pdo->prepare($query);
        $statement->execute([$_SESSION['id_user']]);
        $row=$statement->fetch();
            echo'
                <div class="col-lg-8 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>Thông tin đặt hàng</h2>
                        </div>
                        <div class="card-body">
                            <p>Họ tên: '. htmlspecialchars($_POST['name']) .'</p>
                            <p>Địa chỉ: '. htmlspecialchars($_POST['address']) .'</p>
                            <p>Số điện thoại: '. htmlspecialchars($_POST['phone']) .'</p>
                            <p>Email: '. htmlspecialchars($_POST['email']) .'</p>
                            <p>Phương thức thanh toán: '. htmlspecialchars($_POST['payment_method']) .'</p>
                            <p>Phương thức vận chuyển: '. htmlspecialchars($_POST['ship_method']) .'</p> 
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>Đơn hàng</h2>
                        </div>
                        <div class="card-body">
                            <p>Ngày đặt hàng: '. htmlspecialchars($row['date']) .'</p>
                            <p>Tình trạng: '. htmlspecialchars($_POST['status']) .' </p> 
                        </div>
                        <div class="card-footer">
                            <h3>Số tiền thanh toán: '. number_format(htmlspecialchars($_POST['total_amount']), 0, ',', '.') . 'đ</h3>
                        </div>
                    </div>
                </div>
            ';        
    }catch(PDOException $e){
        $error_message = 'Không thể kết nối đến CSDL';
        $reason = $e->getMessage();
        include dirname(__DIR__) . '/../partials/show_error.php';
    }
}
?>
            </div>
            <div class="row">
                <div class="col">
                    <div class="order_info-text">
                        <h3>Cảm ơn bạn đã mua hàng</h3>
                        <button class="btn btn-primary"><a href="/../">Tiếp tục mua hàng</a></button>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
require_once dirname(__DIR__) . '/../partials/footer.php'
?>