<?php
$username = 'root';
$password = '123';
$database = 'khach_san_2';
// $conn = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
try {
    $conn = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
} catch (Exception $e) {
    // echo $e->getMessage();
    echo '<h1>Khong the ket noi CSDL</h1>';
}
?>
