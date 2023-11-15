<?php
require_once dirname(__DIR__) . '/../partials/header.php'
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['id_product'],$_SESSION['id_user'], $_POST['quantity'])) {
        
        $query = 'UPDATE cart SET quantity = ? WHERE id_product = ? AND id_user = ?';
        try{
            $statement = $pdo->prepare($query);
            $statement->execute([
                $_POST['quantity'],
                $_POST['id_product'],
                $_SESSION['id_user']
            ]);

            echo '<script>
                alert("Cập nhật số lượng thành công");
                window.location.href = "/../cart/cart.php";
            </script>';
        } catch (PDOException $e) {
            echo '<script>
                alert("Cập nhật số lượng thất bại, Lỗi!")
                window.location.href = "/../cart/cart.php";
            </script>';     
        }
    }
}
?>