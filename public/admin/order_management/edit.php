<?php
$pageTitle = "Chỉnh sửa đơn hàng";
require_once __DIR__ . '/../partials/header.php';
?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>         
                <div class="col-lg-6">

<?php 
if(!isset($_SESSION['username_admin'])){
    header("Location: /../admin/login.php");
}  
if (isset($_GET['id_order']) && is_numeric($_GET['id_order']) && ($_GET['id_order'] > 0)) {
    $query = "SELECT * FROM orders WHERE id_order=?";

    try{
        $statement = $pdo-> prepare($query);
        $statement->execute([$_GET['id_order']]);
        $row = $statement->fetch();
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }

    if (!empty($row)) {
                echo '
                    <form class="edit-form" method="post" action="edit.php" id="order-edit-form">
                        <h3>Chỉnh sửa đơn hàng ID:' . '  ' . htmlspecialchars($row['id_order']) . '</h3>
                        <div class="mb-3">
                            <label> <strong>ID khách hàng:</strong>
                            <span>
                                <input name="id_user" type="text" class="form-control edit-order-input" value="' . htmlspecialchars($row['id_user']) . '" maxlength="10">
                            </span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Số tiền thanh toán</strong>
                            <span>
                                <input name="total_amount" type="text" class="form-control edit-order-input" value="' . htmlspecialchars($row['total_amount']) . '" maxlength="10">
                            </span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Phương thức thanh toán</strong>
                            <div class="radio-edit">
                                <div class="radio-input">
                                    <input name="payment_method" type="radio" class="" value="Tiền mặt" required>Tiền mặt
                                </div>
                                <div class="checkbox-input">
                                    <input name="payment_method" type="radio" class="" value="Chuyển khoản qua ngân hàng" required>Chuyển khoản qua ngân hàng
                                </div>
                                <div class="checkbox-input">
                                    <input name="payment_method" type="radio" class="" value="Qua ZaloPay" required>Qua ZaloPay
                                </div>
                            </div>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Phương thức vận chuyển</strong>
                            <div class="radio-edit">
                                <div class="radio-input">
                                    <input name="ship_method" type="radio" class="" value="Giao hàng tiêu chuẩn" required>Giao hàng tiêu chuẩn
                                </div>
                                <div class="checkbox-input">
                                    <input name="ship_method" type="radio" class="" value="Giao nhanh" required>Giao nhanh
                                </div>
                            </div>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label> <strong>Trạng thái</strong>
                            <div class="radio-edit">
                                <div class="radio-input">
                                    <input name="status" type="radio" class="" value="Đang xử lý" required>Đang xử lý
                                </div>
                                <div class="checkbox-input">
                                    <input name="status" type="radio" class="" value="Hoàn thành" required>Hoàn thành
                                </div>
                            </div>
                            </label>
                        </div>
                   
                        <input type ="hidden" name="id_order" class="form-control edit-order-input" value="' . htmlspecialchars($_GET['id_order']) . '">
                        <div class="edit-button">
                            <button type="submit" class="btn btn-warning" id="edit-button">Chỉnh sửa đơn hàng</button>
                        </div>
                    </form>
                ';
    } else {
        $error_message = 'Không thể sửa đơn hàng này';
        $reason = $pdo_error ?? 'Không rõ nguyên nhân';
    }


} elseif (isset($_POST['id_order']) && is_numeric($_POST['id_order']) && ($_POST['id_order'] > 0)){

    $query = "SELECT * FROM order where id_order = ?";
    try{
        $statement = $pdo-> prepare($query);
        $statement->execute([$_POST['id_order']]);
        while($row = $statement->fetch()){
            $old_payment_method = $row['payment_method'];
            $old_ship_method = $row['ship_method'];
            $old_status = $row['status'];
        }
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }
    
    if(!isset($_POST['payment_method'])){
        $_POST['payment_method'] = $old_payment_method;
    }

    if(!isset($_POST['ship_method'])){
        $_POST['ship_method'] = $old_ship_method;
    }

    if(!isset($_POST['status'])){
        $_POST['status'] = $old_status;
    }

    $query = 'UPDATE orders SET id_user=?, total_amount=?, payment_method=?, ship_method=?, status=? WHERE id_order=?';
    try {
        $statement = $pdo->prepare($query);
        $statement->execute([
            $_POST['id_user'],
            $_POST['total_amount'],
            $_POST['payment_method'],
            $_POST['ship_method'],
            $_POST['status'],
            $_POST['id_order']
        ]);
        echo '
        <script>
            alert("Chỉnh sửa đơn hàng thành công");
            window.location.href = "/../admin/order_management/load.php";
        </script>
        ';
    } catch (PDOException $e) {
        echo '
        <script>
            alert("Chỉnh sửa đơn hàng không thành công");
            window.location.href = "/../admin/order_management/load.php";
        </script>
        ';
    }
} else{
    echo '
        <script>
            alert("Không tìm thấy ID đơn hàng");
            window.location.href = "/../admin/order_management/load.php";
        </script>
        ';
}
?>

                </div>   
                <div class="col-lg-3"></div>
            </div>
        </div>
    </main>
</body>
</html>