
<?php
ob_start();
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
include_once 'layouts/header.php';
include_once 'layouts/sidebar.php';
include_once './database/db.php';

$controller = 'users';
if(isset( $_GET['controller'] ) && $_GET['controller'] != '' ){
    $controller = $_GET['controller'];
}
// echo "<h1>".$controller."</h1>";
if(isset($_SESSION['object'])){
               $auth = unserialize($_SESSION["object"]);
switch ($controller) {
    case 'users':
        include_once './controller/UserController.php';
        $objController =  new UserController();
        break;
    case 'login':
        header("Location: login.php");
        // $objController =  new LoaiHangController();
        break;
    default:
        # code...
        break;
}}
else{
        header("Location: login.php");
    
}

$page = 'list';
if( isset( $_GET['page'] ) && $_GET['page'] != '' ){
    $page = $_GET['page'];
}

// Gọi page
switch ($page) {
    case 'list':
        $objController->list();
        break;
    case 'add':
        $objController->add();
        break;
    case 'edit':
        $objController->edit();
        break;
    case 'show':
        $objController->show();
        break;
    // default:
    //     $objController->list();
    //     break;
}
include 'layouts/footer.php';
ob_end_flush();
?>