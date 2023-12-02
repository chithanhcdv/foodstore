<?php
$pageTitle = "Giỏ hàng";
require_once dirname(__DIR__) . '/../partials/header.php'
?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php
                        if(!isset($_SESSION['id_user'])){
                        echo '<script>
                            alert("Bạn chưa đăng nhập!");
                            window.location.href = "/../user/login.php";
                            </script>';      
                        } else{
                            $query = "SELECT * FROM cart WHERE id_user=?";
                            try{ 
                                $statement = $pdo->prepare($query);
                                $statement->execute([$_SESSION['id_user']]);
                                $row = $statement->fetch();
                                if(empty($row['id_cart'])){
                                    echo'
                                        <div class="cart-empty mt-2 mb-2">
                                            <img src="/../images/cart/empty-cart.png">
                                            <h4>Giỏ hàng rỗng</h4>
                                            <button class="btn btn-primary buy-now"><a href="/../">Mua hàng ngay</a></button>
                                        </div>
                                    ';
                                } else{
                                    echo'
                                        <table class="table table-bordered mt-2" id="cart">
                                            <div class="cart-text mt-2">
                                                <img src="/../images/cart/cart.jpg" class="cart-img">
                                                <span>Giỏ Hàng</span>
                                            </div>
                                            <thead>
                                                <tr>
                                                    <th scope="col">Hình ảnh</th>
                                                    <th scope="col">Tên</th>
                                                    <th scope="col" class="quantity">Số lượng</th>
                                                    <th scope="col">Đơn giá</th>
                                                    <th scope="col">Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                    ';
                                }
                            } catch(PDOException $e){
                                $error_message = 'Không thể lấy dữ liệu';
                                $reason = $e->getMessage();
                                include dirname(__DIR__) . '/../partials/show_error.php';
                            }
                            
                        }
                    ?>    
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['id_product'],$_SESSION['id_user'], $_POST['quantity'])) {
        $check = 'SELECT * FROM cart WHERE id_product = ? AND id_user = ?';
        $checkstatement = $pdo->prepare($check);
        $checkstatement->execute([$_POST['id_product'], $_SESSION['id_user']]);
        $checkrow = $checkstatement->fetch();
        
        if(!($checkrow)){    
            $query= 'INSERT INTO cart (id_product, id_user, quantity) VALUES (?, ?, ?)';
        try{
            $statement = $pdo->prepare($query);
            $statement->execute([
                $_POST['id_product'],
                $_SESSION['id_user'],
                $_POST['quantity']
            ]);
            echo' <script>
            alert("Thêm vào giỏ hàng thành công!")
            window.location.href = "' . htmlspecialchars($_SERVER['HTTP_REFERER']) . '";
            </script>';
        } catch (PDOException $e) {    
            echo '<script>
            alert("Thêm vào giỏ hàng không thành công!")
            window.location.href = "' . htmlspecialchars($_SERVER['HTTP_REFERER']) . '";
            </script> ';
        }

        } else{
            echo '<script>alert("sản phẩm đã tồn tại trong giỏ hàng!") 
            window.location.href = "' . htmlspecialchars($_SERVER['HTTP_REFERER']) . '";
            </script> ';
        }
    }
    else if (isset($_POST['id_product'])) {
        $query = 'DELETE FROM cart WHERE id_product = ? AND id_user = ?';
        try {
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['id_product'], $_SESSION['id_user']]);
            echo '<script>
                    alert("Xóa sản phẩm thành công!")
                    window.location.href = "/../cart/cart.php";
                </script>';
        } catch (PDOException $e) {
            echo '<script>
                    alert("Xóa sản phẩm không thành công, Lỗi!")
                    window.location.href = "/../cart/cart.php";
                </script>';
        }
    }
}

$query =   "SELECT cart.id_cart, cart.quantity, product.image, product.name, product.price, product.id_product , product.sale
            FROM cart 
            INNER JOIN product ON cart.id_product = product.id_product 
            WHERE cart.id_user=?";
try{
    $statement = $pdo->prepare($query);
    $statement->execute([$_SESSION['id_user']]);
    $total = 0;

    while($row = $statement->fetch()){
        if($row['sale'] > 0){
            $subtotal = $row['sale'] * $row['quantity'];
        } else{
            $subtotal = $row['price'] * $row['quantity'];
        }
        $total = $total + $subtotal;
        echo'
            <tr>
                <td> <img src="'. htmlspecialchars($row['image']) .'"> </td>
                <td>' . htmlspecialchars($row['name']) .'</td>
                <form method="post" action="update_cart.php" id="updateForm">
                    <input type="hidden" name="id_product" value="' . htmlspecialchars($row['id_product']) . '">
                    <td>
                        <input type="number" value="' . htmlspecialchars($row['quantity']) . '" name="quantity" class="form-control quantityInput" min="1">
                        <button type="submit" class="btn btn-primary update-quantity-button">Cập nhật</button>
                    </td>
                </form>';
                
        if($row['sale'] > 0){
        echo'   <td>' . number_format(htmlspecialchars($row['sale']), '0', ',', '.') .'đ</td>';
        } else{
        echo'   <td>' . number_format(htmlspecialchars($row['price']), '0', ',', '.') .'đ</td>';    
        }
        echo'   <td>' . number_format(htmlspecialchars($subtotal), '0', ',', '.') .'đ</td>';

        echo'   <td>
                    <form method="post" action="">
                        <input type="hidden" name="id_product" value="' . htmlspecialchars($row['id_product']) . '">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr> 
        ';   
    }

    $statement2 = $pdo->prepare($query);
    $statement2->execute([$_SESSION['id_user']]);
    $row2=$statement2->fetch();
    if(empty($row2['id_cart'])){
        echo'';
    } else{
        echo'
                </tbody>
            </table>
            <div class="text-right">
                <h4 id="cart-total">Tổng tiền: '. number_format(htmlspecialchars($total), '0', ',', '.') .'đ</h4>
                <a href="/../order/order.php?id_user=' . htmlspecialchars($_SESSION['id_user']) . ' && total_amount=' . htmlspecialchars($total) . '"><button class="btn btn-primary">Thanh toán</button></a>
            </div>
        ';
    }
   
} catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include dirname(__DIR__) . '/../partials/show_error.php';
    }    
?>          
                    
                </div>
            </div>
        </div>
    </main> 

<?php
require_once dirname(__DIR__) . '/../partials/footer.php';
?>
















           
