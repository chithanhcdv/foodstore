                 
                            <div class="product-type"> 
                                <div class="type-text">
                                    <h3>Bán chạy</h3>
                                </div>
                                <div class="product">   
                                                                
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

    $query = 'SELECT * FROM product';
    try{
        $statement = $pdo->prepare($query);
        $statement->execute();
        while ($row = $statement->fetch()){
            if($row['bestseller'] === 'Có'){
                echo '                      
                                    <div class="product-item">  
                                        <a href="/../product/item.php?name='. str_replace(' ', '-', strtr(strtolower((htmlspecialchars($row['name']))), $replace)) . '" class="product-link">
                                        <img src="'  . htmlspecialchars($row['image']) . '" alt="">
                                        <p>  ' . htmlspecialchars($row['name']) . '</p> ';
                                        if($row['sale'] > 0){
                                            echo' 
                                                <div class="price">
                                                    <p> ' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</p>
                                                    <del>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</del>
                                                </div>
                                            ';
                                        } else{
                                            echo '<p>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</p>';
                                        }
                                        
                    echo'               </a>
                                       <form action="/../cart/cart.php" method="post" class="addToCart-form">                  
                                                <input type="hidden" class="id_product" value="' . htmlspecialchars($row['id_product']) . '" name="id_product">
                                                <input type="hidden" class="form-control quantity" value="1" name="quantity">
                                                <button type="submit" class="btn btn-primary addToCart">Thêm Vào Giỏ Hàng</button>
                                        </form>
                                    </div>           
                ';
            }
        }
                echo'           </div>
                            </div>  ';
                                           
                echo'
                            <div class="product-type"> 
                                <div class="type-text">
                                    <h3>Gà</h3>
                                </div>
                                <div class="product">';

        $statement = $pdo->prepare($query);
        $statement->execute();                        
        while ($row = $statement->fetch()){
            if($row['type'] === 'Gà'){
                echo '                      
                                    <div class="product-item">                                    
                                        <a href="/../product/item.php?name='. str_replace(' ', '-', strtr(strtolower((htmlspecialchars($row['name']))), $replace)) . '" class="product-link">
                                        <img src="'  . htmlspecialchars($row['image']) . '" alt="">
                                        <p>  ' . htmlspecialchars($row['name']) . '</p> ';
                                        if($row['sale'] > 0){
                                            echo' 
                                                <div class="price">
                                                    <p> ' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</p>
                                                    <del>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</del>
                                                </div>
                                            ';
                                        } else{
                                            echo '<p>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</p>';
                                        }
                                        
                    echo'               </a>
                                        <form action="/../cart/cart.php" method="post" class="addToCart-form">                  
                                            <input type="hidden" class="id_product" value="' . htmlspecialchars($row['id_product']) . '" name="id_product">
                                            <input type="hidden" class="form-control quantity" value="1" name="quantity">
                                            <button type="submit" class="btn btn-primary addToCart">Thêm Vào Giỏ Hàng</button>
                                        </form>  
                                    </div>          
                ';
            }
        }
                echo'           </div>
                            </div>  ';

                echo'
                            <div class="product-type"> 
                                <div class="type-text">
                                    <h3>Pizza</h3>
                                </div>
                                <div class="product">';

        $statement = $pdo->prepare($query);
        $statement->execute();                        
        while ($row = $statement->fetch()){
            if($row['type'] === 'Pizza'){
                echo '                      
                                    <div class="product-item">                                    
                                        <a href="/../product/item.php?name='. str_replace(' ', '-', strtr(strtolower((htmlspecialchars($row['name']))), $replace)) . '" class="product-link">
                                        <img src="'  . htmlspecialchars($row['image']) . '" alt="">
                                        <p>  ' . htmlspecialchars($row['name']) . '</p> ';
                                        if($row['sale'] > 0){
                                            echo' 
                                                <div class="price">
                                                    <p> ' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</p>
                                                    <del>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</del>
                                                </div>
                                            ';
                                        } else{
                                            echo '<p>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</p>';
                                        }
                                        
                    echo'               </a>
                                        <form action="/../cart/cart.php" method="post" class="addToCart-form">                  
                                            <input type="hidden" class="id_product" value="' . htmlspecialchars($row['id_product']) . '" name="id_product">
                                            <input type="hidden" class="form-control quantity" value="1" name="quantity">
                                            <button type="submit" class="btn btn-primary addToCart">Thêm Vào Giỏ Hàng</button>
                                        </form>   
                                    </div>           
                ';
            }
        }
                echo'           </div>
                            </div>  ';     
                                                   
                echo'
                            <div class="product-type"> 
                                <div class="type-text">
                                    <h3>Hamburger</h3>
                                </div>
                                <div class="product">';

        $statement = $pdo->prepare($query);
        $statement->execute();                        
        while ($row = $statement->fetch()){
            if($row['type'] === 'Hamburger'){
                echo '                      
                                    <div class="product-item">                                    
                                        <a href="/../product/item.php?name='. str_replace(' ', '-', strtr(strtolower((htmlspecialchars($row['name']))), $replace)) . '" class="product-link">
                                        <img src="'  . htmlspecialchars($row['image']) . '" alt="">
                                        <p>  ' . htmlspecialchars($row['name']) . '</p> ';
                                        if($row['sale'] > 0){
                                            echo' 
                                                <div class="price">
                                                    <p> ' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</p>
                                                    <del>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</del>
                                                </div>
                                            ';
                                        } else{
                                            echo '<p>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</p>';
                                        }
                                        
                    echo'               </a>
                                        <form action="/../cart/cart.php" method="post" class="addToCart-form">                  
                                            <input type="hidden" class="id_product" value="' . htmlspecialchars($row['id_product']) . '" name="id_product">
                                            <input type="hidden" class="form-control quantity" value="1" name="quantity">
                                            <button type="submit" class="btn btn-primary addToCart">Thêm Vào Giỏ Hàng</button>
                                        </form>    
                                    </div>          
                ';
            }
        }
                echo'           </div>
                            </div>  ';   
                                                    
                echo'
                            <div class="product-type"> 
                                <div class="type-text">
                                    <h3>Mì ý</h3>
                                </div>
                                <div class="product">';

        $statement = $pdo->prepare($query);
        $statement->execute();                        
        while ($row = $statement->fetch()){
            if($row['type'] === 'Mì ý'){
                echo '                      
                                    <div class="product-item">                                    
                                        <a href="/../product/item.php?name='. str_replace(' ', '-', strtr(strtolower((htmlspecialchars($row['name']))), $replace)) . '" class="product-link">
                                        <img src="'  . htmlspecialchars($row['image']) . '" alt="">
                                        <p>  ' . htmlspecialchars($row['name']) . '</p> ';
                                        if($row['sale'] > 0){
                                            echo' 
                                                <div class="price">
                                                    <p> ' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</p>
                                                    <del>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</del>
                                                </div>
                                            ';
                                        } else{
                                            echo '<p>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</p>';
                                        }
                                        
                    echo'               </a>
                                        <form action="/../cart/cart.php" method="post" class="addToCart-form">                  
                                            <input type="hidden" class="id_product" value="' . htmlspecialchars($row['id_product']) . '" name="id_product">
                                            <input type="hidden" class="form-control quantity" value="1" name="quantity">
                                            <button type="submit" class="btn btn-primary addToCart">Thêm Vào Giỏ Hàng</button>
                                        </form>    
                                    </div>            
                ';
            }
        }
                echo'           </div>
                            </div>  ';     
                                                
                echo'
                            <div class="product-type"> 
                                <div class="type-text">
                                    <h3>Xúc xích</h3>
                                </div>
                                <div class="product">';

        $statement = $pdo->prepare($query);
        $statement->execute();                        
        while ($row = $statement->fetch()){
            if($row['type'] === 'Xúc xích'){
                echo '                      
                                    <div class="product-item">                                    
                                        <a href="/../product/item.php?name='. str_replace(' ', '-', strtr(strtolower((htmlspecialchars($row['name']))), $replace)) . '" class="product-link">
                                        <img src="'  . htmlspecialchars($row['image']) . '" alt="">
                                        <p>  ' . htmlspecialchars($row['name']) . '</p> ';
                                        if($row['sale'] > 0){
                                            echo' 
                                                <div class="price">
                                                    <p> ' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</p>
                                                    <del>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</del>
                                                </div>
                                            ';
                                        } else{
                                            echo '<p>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</p>';
                                        }
                                        
                    echo'               </a>
                                        <form action="/../cart/cart.php" method="post" class="addToCart-form">                  
                                            <input type="hidden" class="id_product" value="' . htmlspecialchars($row['id_product']) . '" name="id_product">
                                            <input type="hidden" class="form-control quantity" value="1" name="quantity">
                                            <button type="submit" class="btn btn-primary addToCart">Thêm Vào Giỏ Hàng</button>
                                        </form>     
                                    </div>          
                ';
            }
        }
                echo'           </div>
                            </div>  ';

                echo'
                            <div class="product-type"> 
                               <div class="type-text">
                                    <h3>Tráng miệng</h3>
                                </div>
                                <div class="product">';

        $statement = $pdo->prepare($query);
        $statement->execute();                        
        while ($row = $statement->fetch()){
            if($row['type'] === 'Tráng miệng'){
                echo '                      
                                    <div class="product-item">                                    
                                        <a href="/../product/item.php?name='. str_replace(' ', '-', strtr(strtolower((htmlspecialchars($row['name']))), $replace)) . '" class="product-link">
                                        <img src="'  . htmlspecialchars($row['image']) . '" alt="">
                                        <p>  ' . htmlspecialchars($row['name']) . '</p> ';
                                        if($row['sale'] > 0){
                                            echo' 
                                                <div class="price">
                                                    <p> ' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</p>
                                                    <del>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</del>
                                                </div>
                                            ';
                                        } else{
                                            echo '<p>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</p>';
                                        }
                                        
                    echo'               </a>
                                        <form action="/../cart/cart.php" method="post" class="addToCart-form">                  
                                            <input type="hidden" class="id_product" value="' . htmlspecialchars($row['id_product']) . '" name="id_product">
                                            <input type="hidden" class="form-control quantity" value="1" name="quantity">
                                            <button type="submit" class="btn btn-primary addToCart">Thêm Vào Giỏ Hàng</button>
                                        </form>    
                                    </div>          
                ';
            }
        }
                echo'           </div>
                            </div>  ';

                echo'
                            <div class="product-type"> 
                                <div class="type-text">
                                    <h3>Đồ uống</h3>
                                </div>
                                <div class="product">';

        $statement = $pdo->prepare($query);
        $statement->execute();                        
        while ($row = $statement->fetch()){
            if($row['type'] === 'Đồ uống'){
                echo '                      
                                    <div class="product-item">                                    
                                        <a href="/../product/item.php?name='. str_replace(' ', '-', strtr(strtolower((htmlspecialchars($row['name']))), $replace)) . '" class="product-link">
                                        <img src="'  . htmlspecialchars($row['image']) . '" alt="">
                                        <p>  ' . htmlspecialchars($row['name']) . '</p> ';
                                        if($row['sale'] > 0){
                                            echo' 
                                                <div class="price">
                                                    <p> ' . number_format(htmlspecialchars($row['sale']), 0, ',', '.') . 'đ</p>
                                                    <del>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</del>
                                                </div>
                                            ';
                                        } else{
                                            echo '<p>  ' . number_format(htmlspecialchars($row['price']), 0, ',', '.') . 'đ</p>';
                                        }
                                        
                    echo'               </a>
                                        <form action="/../cart/cart.php" method="post" class="addToCart-form">                  
                                            <input type="hidden" class="id_product" value="' . htmlspecialchars($row['id_product']) . '" name="id_product">
                                            <input type="hidden" class="form-control quantity" value="1" name="quantity">
                                            <button type="submit" class="btn btn-primary addToCart">Thêm Vào Giỏ Hàng</button>
                                        </form>   
                                    </div>           
                ';
            }
        }
                echo'           </div>
                            </div>  ';
           
    } catch (PDOException $e) {
        $error_message = 'Không thể lấy dữ liệu';
        $reason = $e->getMessage();
        include dirname(__DIR__) . '/../partials/show_error.php';
    }

?>
