<?php
$pageTitle = $_GET['name'];
require_once dirname(__DIR__) . '/../partials/header.php'
?>

    <main> 
        <div class="container">   
            <div class="top-page">       
                <div class="row">
                    <div class="col-lg-2 mt-3">
                        <?php
                        require_once dirname(__DIR__) . '/../partials/navbar.php';         
                        ?>
                    </div>
                    
<?php
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

if(isset($_GET['name'])){
    $query = "SELECT * FROM product WHERE name LIKE ?";

    try{
        $statement = $pdo-> prepare($query);
        $searchTerm = '%' . $_GET['name'] . '%';
        $statement->execute([$searchTerm]);
        echo'
            <div class="col-lg-10 mt-4">
                <h2>Tìm kiếm với từ khóa:'. ' ' . htmlspecialchars($_GET['name']) .'</h2>
                <div class="product">
        ';
        while ($row = $statement->fetch()){         
                            echo '                     
                                    <div class="product-item">             
                                        <a href="/../product/item.php?name='. str_replace(' ', '-', strtr(strtolower((htmlspecialchars($row['name']))), $replace)) . '" class="product-link">                       
                                            <img src="'  . htmlspecialchars($row['image']) . '" alt="">
                                            <p>  ' . htmlspecialchars($row['name']) . '</p>
                                            <p>  ' . htmlspecialchars($row['price']) . '</p>
                                        </a> 
                                        <form action="/../cart/cart.php" method="post" class="addToCart-form">                  
                                            <input type="hidden" class="id_product" value="' . htmlspecialchars($row['id_product']) . '" name="id_product">
                                            <input type="hidden" class="form-control quantity" value="1" name="quantity">
                                            <button type="submit" class="btn btn-primary addToCart">Thêm Vào Giỏ Hàng</button>
                                        </form>  
                                    </div>           
                ';
            }
                echo'           </div> ';    

    } catch (PDOException $e) {
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
require_once dirname(__DIR__) . '/../partials/footer.php'
?>
