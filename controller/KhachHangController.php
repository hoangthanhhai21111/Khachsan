<?php
include_once './model/KhachHang.php'; 
include_once './model/GRoup.php';

class KhachHangController {
    function KhachHang(){
        return new KhachHang();
    }
    function Group(){
        return new Group();
    }
    function list(){
        
        $this->Group()->haspermission('view_khach_hang');
        $id = [];
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        // $pages = 1;
        // if (isset($_GET['pages'])) {
        //     $pages = (!empty($_GET['pages'])) ? $_GET['pages']  : '1';
        // }
        // $rows = $group->list($id)['rows'];
        // $number_page = $group->list($id)['number_page'];
        include_once 'views/KhachHangs/list.php';
    }
}
?>