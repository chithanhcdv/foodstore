<?php
$pageTitle = "Chi tiết đơn hàng";
require_once dirname(__DIR__) . '/../partials/header.php';
?>

    <main> 
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 mt-3 mb-2">       
                    <div class="card">
                        <div class="card-header">
                            <h3>Chi tiết đơn hàng</h3>
                        </div>
                        <div class="card-body">
                        
<?php
if(isset($_GET['id_order']) && is_numeric($_GET['id_order']) && ($_GET['id_order'] > 0)){
    $query = "SELECT * FROM orders INNER JOIN user ON orders.id_user 
              = orders.id_user WHERE orders.id_order=?";
    
    try{
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['id_order']]);
        $row = $statement->fetch();
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }

    if (!empty($row)) {
                echo'
                    <p>ID đơn hàng: '. htmlspecialchars($row['id_order']) .'</p>
                    <p>Ngày đặt hàng '. htmlspecialchars($row['date']) .'</p>
                    <p>Tình trạng đơn hàng: '. htmlspecialchars($row['status']) .'</p>
                    <p>Phương thức thanh toán: '. htmlspecialchars($row['payment_method']) .'</p>
                    <p>Phương thức vận chuyển: '. htmlspecialchars($row['ship_method']) .' </p>
                    <h3>Số tiền thanh toán: '. number_format(htmlspecialchars($row['total_amount']), '0', ',', '.') .'đ</h3>
                ';
    }
}
?>
                       
                        </div>
                    </div> 
                </div>
                <div class="col-lg-3"></div>
            </div>     
        </div>
    </main>

<?php
require_once dirname(__DIR__) . '/../partials/footer.php';
?>