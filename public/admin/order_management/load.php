<?php
$pageTitle = "Danh sách đơn hàng";
require_once __DIR__ . '/../partials/header.php';
?>

    <main class="load-main">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <h1>Danh sách đơn hàng</h1>
                        <thead>
                            <tr>
                                <th scope="col">ID đơn hàng</th>
                                <th scope="col">ID khách hàng</th>
                                <th scope="col">Số tiền thanh toán</th>     
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>

<?php
if(!isset($_SESSION['username_admin'])){
    header("Location: /../admin/login.php");
}
else{
    $query = 'SELECT * FROM orders';
    try{
        $statement = $pdo->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch()){
            echo '               
                    <tr>
                        <th class="load-order">' . htmlspecialchars($row['id_order']) . '</th>
                        <td class="load-order">' . htmlspecialchars($row['id_user']) . '</td>
                        <td class="load-order">' . number_format(htmlspecialchars($row['total_amount']), 0, ',', '.') . 'đ</td>
                        <td class="load-order">' . htmlspecialchars($row['status']) . '</td>
                        <td>
                            <div class="detail-link">
                                <button class="btn btn-info"><a href="/../admin/order_management/detail.php?id_order=' . htmlspecialchars($row['id_order']) . '">Xem chi tiết</a></button>  
                            </div>

                            <div class="edit-link">
                                <button class="btn btn-warning"><a href="/../admin/order_management/edit.php?id_order=' . htmlspecialchars($row['id_order']) . '">Sửa</a></button>
                            </div>
                            
                            <div class="delete-link">
                                <button class="btn btn-danger"><a href="/../admin/order_management/delete.php?id_order=' . htmlspecialchars($row['id_order']) . '">Xóa</a></button>
                            </div>
                        </td>
                    </tr>                            
                ';
            }  

    }  catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include __DIR__ . '/../partials/show_error.php';
    }
}
?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>