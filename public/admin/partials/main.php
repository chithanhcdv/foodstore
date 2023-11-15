
    <main class="main">
        <div class="container">
            <div class="row">
<?php
$totalUserCount = 0;
$totalProductCount = 0;
$totalOrderCount = 0;
$total_amountOrderCount = 0;
$orderData = array();

if (!isset($_SESSION['username_admin'])) {
    header("Location: /../admin/login.php");
} else {
    $query = "SELECT * FROM user";
    try{
        $statement = $pdo->prepare($query);
        $statement->execute();
        while($row = $statement->fetch()){
            $totalUserCount++;    
        }
        echo'   <div class="col">
                    <h4>Số lượng khách hàng</h4>
                    <h4>'. htmlspecialchars($totalUserCount) .'</h4>   
                </div>';
    } catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include __DIR__ . '/../partials/show_error.php';
    }

    $query = "SELECT * FROM product";
    try{
        $statement = $pdo->prepare($query);
        $statement->execute();
        while($row = $statement->fetch()){
            $totalProductCount++;
        }
        echo'   <div class="col">
                    <h4>Số lượng sản phẩm</h4>
                    <h4>'. htmlspecialchars($totalProductCount) .'</h4>
                </div>
        ';

    } catch (PDOException $e){
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include __DIR__ . '/../partials/show_error.php';
    }  

    $query = "SELECT * FROM orders";
    try {
        $statement = $pdo->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $orderData[] = array(
                'id_order' => htmlspecialchars($row['id_order']),
                'total_amount' => htmlspecialchars($row['total_amount'])   
            );
            $totalOrderCount++;
            $total_amountOrderCount += $row['total_amount'];
        }
        echo'   <div class="col">
                    <h4>Số lượng đơn hàng</h4>
                    <h4>'. htmlspecialchars($totalOrderCount) .'</h4>
                </div>
        ';

        echo'   <div class="col">
                    <h4>Tổng doanh thu</h4>
                    <h4>'. number_format(htmlspecialchars($total_amountOrderCount), 0, ',', '.') . 'đ</h4>
                </div>
        ';

        
    } catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include __DIR__ . '/../partials/show_error.php';
    } 
}
?>                            
            </div>
            <div class="row">
                <div class="col">
                    <canvas id="orderChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Lấy dữ liệu từ PHP và chuyển thành mảng JavaScript
        var orderData = <?php echo json_encode($orderData); ?>;

        // Lấy thẻ canvas và vẽ biểu đồ
        var ctx = document.getElementById('orderChart').getContext('2d');
        var orderChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: orderData.map(order => order.id_order),
                datasets: [{
                    label: 'Đơn hàng',
                    data: orderData.map(order => order.total_amount),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>