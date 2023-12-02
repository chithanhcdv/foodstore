<?php
$pageTitle = "Xóa đơn hàng";
require_once dirname(__DIR__) . '/../partials/header.php';
?>

    <main> 
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 mt-3 mb-2">       
                    <div class="card">
                        <div class="card-header">
                            <h3>Xóa đơn hàng</h3>
                        </div>
                        <div class="card-body">
                            
<?php
if (isset($_GET['id_order']) && is_numeric($_GET['id_order']) && ($_GET['id_order'] > 0)) {
    $query = "SELECT * FROM orders WHERE id_order=?";

    try{
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['id_order']]);
        $row = $statement->fetch(); 
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }

    if(!empty($row)) {
                echo'
                    <form method="post" action="delete.php" id="order-delete-form">
                    <div class="row">
                    <div class="col">
                        <p>ID đơn hàng:' . '  ' . htmlspecialchars($row['id_order']) . '</p>
                        <p>ID khách hàng:' . '  ' . htmlspecialchars($row['id_user']) . '</p>
                        <p>Số tiền thanh toán:' . '  ' . number_format(htmlspecialchars($row['total_amount']), 0, ',', '.') . 'đ</p>
                        <p>Phương thức thanh toán:' . '  ' . htmlspecialchars($row['payment_method']) . '</p>
                        <p>Phương thức vận chuyển:' . '  ' . htmlspecialchars($row['ship_method']) . '</p>
                        <p>Trạng thái:' . '  ' . htmlspecialchars($row['status']) . '</p>
                    </div>          
                    ';

                    echo'
                    </div>
                    <div class="row">
                        <div class="delete-button">
                            <input type ="hidden" name="id_order" value="' . htmlspecialchars($_GET['id_order']) . '">                   
                            <button class="btn btn-danger" type="submit" id="delete-button">Xóa</button>
                        </div>
                    </div>
                    </form> 
                    ';

    } else {
        $error_message = 'Không thể xóa đơn hàng này';
        $reason = $pdo_error ?? 'Không rõ nguyên nhân';
    }

} elseif (isset($_POST['id_order']) && is_numeric($_POST['id_order']) && ($_POST['id_order'] > 0)) {
    $query = "DELETE FROM orders WHERE id_order=?";

    try{
        $statement = $pdo->prepare($query);
        $statement->execute([$_POST['id_order']]);
    } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
    }

    if($statement && $statement->rowCount() == 1){
        echo '
            <script>
                alert("Xóa đơn hàng thành công");
                window.location.href = "/../order/order_list.php";
            </script>
        '; 
    } else {
        echo '
            <script>
                alert("Xóa đơn hàng không thành công, lỗi!");
                window.location.href = "/../order/order_list.php";
            </script>
        ';    
    }
} else{
    echo '
        <script>
            alert("Không tìm thấy ID đơn hàng");
            window.location.href = "/../order/order_list.php";
        </script>
        ';
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