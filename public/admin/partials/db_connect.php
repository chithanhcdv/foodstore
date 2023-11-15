<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=foodstore', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = 'Không thể kết nối đến CSDL';
    $reason = $e->getMessage();
    include __DIR__ . '/../partials/show_error.php';
    exit();
}
