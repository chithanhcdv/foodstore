<?php
$pageTitle = "Danh sách đơn hàng";
require_once dirname(__DIR__) . '/../partials/header.php';
?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mt-3">
                    <form method="post" action="">
                        <div class="card">
                            <div class="card-header">
                                <h4>Lọc</h4>
                            </div>
                            <div class="card-body">    
                                <div class="filter">
                                    <div class="filter-input">
                                        <input type="radio" name="price_filter">0 - 200.000đ
                                    </div>
                                    <div class="filter-input">
                                        <input type="radio" name="price_filter">200.000đ - 500.000đ
                                    </div>
                                    <div class="filter-input">
                                        <input type="radio" name="price_filter">>500.000đ - 1.000.000đ
                                    </div>
                                    <div class="filter-input">
                                        <input type="radio" name="price_filter">>1.000.000đ
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-9 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="order_list-text">
                                <h4>Đơn hàng của bạn</h4>
                            </div>
                        </div>

<?php
if(isset($_SESSION['username'], $_SESSION['id_user'])){
    $query = "SELECT * FROM orders WHERE id_user =? ORDER BY id_order DESC";
    try{
        $statement=$pdo->prepare($query);
        $statement->execute([$_SESSION['id_user']]);
        while($row=$statement->fetch()){    
            echo'
                <div class="card-body order-list">
                    <div>
                        <p>ID đơn hàng: '. htmlspecialchars($row['id_order']) .'</p>
                        <p>Tình trạng: '. htmlspecialchars($row['status']) .'</p>
                        <p>Ngày đặt hàng: '. htmlspecialchars($row['date']) .'</p>   
                    </div>
                    <div>
                        <p>Phương thức thanh toán: '. htmlspecialchars($row['payment_method']) .'</p>
                        <p>Phương thức vận chuyển: '. htmlspecialchars($row['ship_method']) .'</p>
                        <p>Số tiền thanh toán: '. number_format(htmlspecialchars($row['total_amount']), 0, ',', '.') . 'đ</p>
                    </div>
                    <div class="order_list-button">
                        <button class="btn btn-primary"><a href="/../order/order_item.php?id_order='. htmlspecialchars($row['id_order']) .'" class="text-white">Xem chi tiết</a></button>
                        <button class="btn btn-danger"><a href="/../order/delete.php?id_order='. htmlspecialchars($row['id_order']) .'" class="text-white">Xóa</a></button>
                    </div>
                </div>
                <hr>
            ';
        }
    } catch(PDOException $e){
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include dirname(__DIR__) . '/../partials/show_error.php';
    } 
}
?>    
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
require_once dirname(__DIR__) . '/../partials/footer.php';
?>