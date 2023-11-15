<?php
$pageTitle = $_GET['name'];
require_once dirname(__DIR__) . '/../partials/header.php'
?>

    <main> 
        <div class="container">      
            <div class="row">
                    
<?php
if(isset($_GET['name'])){
    $replace = [
    'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a','ă' => 'a', 'ắ' => 'a', 
    'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a','â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 
    'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a','đ' => 'd','é' => 'e', 'è' => 'e', 'ẻ' => 'e', 
    'ẽ' => 'e', 'ẹ' => 'e','ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e',
    'ệ' => 'e','í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i','ó' => 'o', 
    'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o','ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 
    'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o','ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 
    'ỡ' => 'o', 'ợ' => 'o','ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u',
    'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u','ý' => 'y',
    'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y','(' => '', ')' => '', ' -' => '',
    ];

    $query = 'SELECT * FROM product';
    try{
        $statement = $pdo->prepare($query);
        $statement->execute();
        while($row = $statement->fetch()){
            $default_name = $row['name'];    
            $row['name'] = strtolower($row['name']);
            $row['name'] = strtr($row['name'], $replace);
            $row['name'] = str_replace(' ', '-', $row['name']);
            if($row['name'] === $_GET['name']){
                echo'
                    <div class="col-lg-5 mt-3">
                        <div class="item-image">
                            <img src="'. htmlspecialchars($row['image']) .'">
                        </div>
                    </div>
                    <div class="col-lg-7 mt-3">
                        <div class="item-info">
                            <h1>'. htmlspecialchars($default_name) .'</h1> 
                            <p><h3>Loại: '. htmlspecialchars($row['type']) .'</h3></p>';
                            if($row['sale'] > 0){
                            echo'
                            <div class="price">
                                <p><h3>'. number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</h3></p>
                                <p><h3><del>'. number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</del></h3></p>
                            </div>';
                            } else{
                                echo'
                                <p><h3>'. number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</h3></p>';
                            }
                            echo'
                            <form method="post" action="/../cart/cart.php" class="addToCart-form">
                                <div class="quantity-select">
                                    <h4>Số lượng: </h4>
                                    <input type ="number" name="quantity"class="form-control-sm" value="1">
                                    <input type="hidden" class="id_product" value="' . htmlspecialchars($row['id_product']) . '" name="id_product">
                                </div>
                                <div class="addToCart-button">
                                    <button type="submit" class="btn btn-primary addToCart">Thêm vào giỏ hàng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="description-text">
                        <h3>Mô tả</h3>
                        <p>' . htmlspecialchars($default_name) .'</p>
                    </div>
                    <div class="description">
                        <p>'. htmlspecialchars($row['description']) .'</p>
                    </div>
                </div>
                ';
                }
        }               
    } catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include dirname(__DIR__) . '/../partials/show_error.php';
    }
}
?>      

            </div>
        </div>
    </main>

<?php
require_once dirname(__DIR__) . '/../partials/footer.php';
?>