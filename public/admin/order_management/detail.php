<?php
$pageTitle = "Thông tin đơn hàng";
require_once __DIR__ . '/../partials/header.php';
?>

    <main> 
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">       
                    <div class="card">
                        <div class="card-header">
                            <h3>Thông tin đơn hàng</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

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
                echo'
                    <div class="col">
                        <p class="order-info">ID đơn hàng:' . '  ' . htmlspecialchars($row['id_order']) . '</p>
                        <p class="order-info">ID khách hàng:' . '  ' . htmlspecialchars($row['id_user']) . '</p>
                        <p class="order-info">Số tiền thanh toán:' . '  ' . number_format(htmlspecialchars($row['total_amount']), 0, ',', '.') . 'đ</p>
                        <p class="order-info">Phương thức thanh toán:' . '  ' . htmlspecialchars($row['payment_method']) . '</p>
                        <p class="order-info">Phương thức vận chuyển:' . '  ' . htmlspecialchars($row['ship_method']) . '</p>
                        <p class="order-info">Trạng thái:' . '  ' . htmlspecialchars($row['status']) . '</p>
                    </div>          
                    ';                 
    } else{
        echo '
            <script>
                alert("Không tìm thấy ID đơn hàng");
                window.location.href = "/../admin/product_management/load.php";
            </script>
            ';
    }
}
?>

                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-3"></div>
            </div>     
        </div>
    </main>
</body>
</html>