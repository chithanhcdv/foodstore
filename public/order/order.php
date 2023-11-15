<?php
$pageTitle = "Thanh toán";
require_once dirname(__DIR__). '/../partials/header.php'
?>

    <main id="order-main"> 
        <div class="container">
            <form id="order-form" method="post" action="order_info.php">
                <div class="payment-text">
                    <img src="/../images/order/credit-card-icon.jpg" class="credit-card-img">
                    <span>Thanh Toán</span>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h3>Thông tin khách hàng</h3>
                            </div>

<?php
if(isset($_GET['id_user'], $_GET['total_amount'])){
    $query = "SELECT user.name, user.address, user.phone, user.email 
                        FROM cart 
                        INNER JOIN user ON cart.id_user = user.id_user
                        WHERE cart.id_user=?";
    $query2 = "SELECT cart.quantity, product.name, product.price, product.image
                        FROM cart
                        INNER JOIN product ON cart.id_product = product.id_product
                        WHERE cart.id_user=?";
                        
    try{
    $statement = $pdo->prepare($query);
    $statement->execute([$_SESSION['id_user']]);
    $row = $statement->fetch();
    echo'
                            <div class="card-body">
                                <div class="mb-3">
                                    <label><strong>Họ tên</strong></label>      
                                    <input name="name" type="text" class="form-control" required value="' . htmlspecialchars($row['name']) . '" maxlength="30" required>
                                </div>
                                <div class="mb-3">
                                    <label><strong>Địa chỉ</strong></label>      
                                    <input name="address" type="text" class="form-control" required value="' . htmlspecialchars($row['address']) . '" maxlength="100" required>
                                </div>
                                <div class="mb-3">
                                    <label><strong>Số điện thoại</strong></label>      
                                    <input name="phone" type="tel" class="form-control" value="' . '0' . htmlspecialchars($row['phone']) . '" pattern="[0-9]{10}" maxlength="10" title="Số điện thoại phải bao gồm 10 số" required>
                                </div>
                                <div class="mb-3">
                                    <label><strong>Email</strong></label>      
                                    <input name="email" type="email" class="form-control" required value="' . htmlspecialchars($row['email']) . '" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
                                </div>
                            </div>     
                            <div class="card-footer">
                                <h4>Chọn phương thức thanh toán</h4>
                                <div class="payment-method">
                                    <input name="payment_method" type="radio" class="" value="Tiền mặt" required> Tiền mặt
                                    <br>
                                    <input name="payment_method" type="radio" class="" value="Chuyển khoản qua ngân hàng" required> Chuyển khoản qua ngân hàng
                                    <br>
                                    <input name="payment_method" type="radio" class="" value="Qua ZaloPay" required> Qua ZaloPay
                                </div>
                            </div>     
                            <div class="card-footer">
                                <h4>chọn phương thức vận chuyển</h4>
                                <div class="ship-method">
                                    <input name="ship_method" type="radio" class="" value="Giao hàng tiêu chuẩn" required> Giao hàng tiêu chuẩn (30 phút - 1 giờ)
                                    <br>
                                    <input name="ship_method" type="radio" class="" value="Giao hàng nhanh" required> Giao nhanh (15 - 30 phút), Phí +10.000đ
                                    <br>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h3>Giỏ hàng của bạn</h3>
                            </div>
                            <div class="card-body">';
                            $statement2 = $pdo->prepare($query2);
                            $statement2->execute([$_SESSION['id_user']]);
                            $row2 = $statement->fetch();
                            while ($row2 = $statement2->fetch()){
                                $subtotal = $row2['price'] * $row2['quantity'];
                                echo'
                                <div class="order-item">
                                    <div>
                                        <p>'. htmlspecialchars($row2['name']) .' x '. htmlspecialchars($row2['quantity']) .'</p>
                                        <div class="order-price">
                                            <p>Đơn giá: '. number_format(htmlspecialchars($row2['price']), '0', ',', '.') .'đ</p>
                                            <p>Thành tiền: '. number_format(htmlspecialchars($subtotal), '0', ',', '.') .'đ</p>
                                        </div>
                                    </div>
                                    <div class="order-image">
                                        <img src ="'. htmlspecialchars($row2['image']) .'">
                                    </div>
                                </div>';
                            }
               
                            echo'
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name ="total_amount" value="'. htmlspecialchars($_GET['total_amount']) .'">
                                <h3>Tổng tiền: '. number_format(htmlspecialchars($_GET['total_amount']), '0', ',', '.') .'đ</h3>
                            </div>
                        </div>
                    </div>
                            
    ';

    } catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include dirname(__DIR__) . '/../partials/show_error.php';
    }
}
?>

                </div>
                <div class="row">
                    <div class="col">
                        <div class="order-button">
                            <input type="hidden" name="status" value="Đang xử lý">
                            <button type="submit" class="btn btn-primary">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>  
    </main>

<?php
require_once dirname(__DIR__) . '/../partials/footer.php';
?>


