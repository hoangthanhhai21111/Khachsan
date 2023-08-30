<?php
ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'layouts/header.php';
include_once 'layouts/sidebar.php';
include_once './database/db.php';

$controller = 'users';
if (isset($_GET['controller']) && $_GET['controller'] != '') {
    $controller = $_GET['controller'];
}
// kiểm tra đăng nhập
if (isset($_SESSION['object'])) {
    // $auth = unserialize($_SESSION["object"]); dùng để lấy đối tượng đăng nhâp
    switch ($controller) {
        case 'users':
            include_once './controller/UserController.php';
            $objController =  new UserController();
            break;
        case 'groups':
            include_once './controller/GroupController.php';
            $objController =  new GroupController();
            break;
        case 'khachhangs':
            include_once './controller/KhachHangController.php';
            $objController =  new KhachHangController();
            break;
        case 'phongs':
            include_once './controller/PhongController.php';
            $objController =  new PhongController();
            break;
        case 'hangphongs':
            include_once './controller/HangPhongController.php';
            $objController =  new HangPhongController();
            break;
        default:
            header("Location: error404.php");
            break;
    }
} else {
    header("Location: login.php");
}

$page = 'list';
if (isset($_GET['page']) && $_GET['page'] != '') {
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
    case 'delete':
        $objController->delete();
        break;
    case 'listPhong':
        if ($controller == "khachhangs") {
            $objController->listPhong();
            break;
        }
    default:
        $objController->list();
        break;
}
include 'layouts/footer.php';
ob_end_flush();
