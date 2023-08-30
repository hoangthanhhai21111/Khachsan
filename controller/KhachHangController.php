<?php
include_once './model/KhachHang.php';
include_once './model/HangPhong.php';
include_once './model/Group.php';
include_once './model/phong.php';

class KhachHangController
{
    function KhachHang()
    {
        return new KhachHang();
    }
    function Group()
    {
        return new Group();
    }
    function HangPhong()
    {
        return new HangPhong();
    }
    function Phong()
    {
        return new Phong();
    }
    function list()
    {
        $this->Group()->haspermission('view_khach_hang');
        $id = [];
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        // $this->KhachHang()->all();
        // $pages = 1;
        // if (isset($_GET['pages'])) {
        //     $pages = (!empty($_GET['pages'])) ? $_GET['pages']  : '1';
        // }
        // $rows = $group->list($id)['rows'];
        // $number_page = $group->list($id)['number_page'];

        $id = [];
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $ten = "";
        $cmnd = "";
        $sdt = "";
        if (isset($_GET['ten'])) {
            if (!empty($_GET['ten'])) {
                $ten = $_GET['ten'];
            }
        }

        if (isset($_GET['cmnd'])) {
            if (!empty($_GET['cmnd'])) {
                $cmnd = $_GET['cmnd'];
            }
        }
        if (isset($_GET['sdt'])) {
            if (!empty($_GET['sdt'])) {
                $sdt = $_GET['sdt'];
            }
        }
        $pages = 1;
        if (isset($_GET['pages'])) {
            $pages = (!empty($_GET['pages'])) ? $_GET['pages']  : '1';
        }
        // $users = new user();
        $rows = $this->KhachHang()->all($pages, $ten, $cmnd, $sdt, $id)["rows"];
        $number_page =  $this->KhachHang()->all($pages, $ten, $cmnd, $sdt, $id)["number_page"];
        include_once 'views/KhachHangs/list.php';
    }
    function add()
    {
        if (isset($_POST['store'])) {
            $this->khachHang()->store($_REQUEST);
            header("Location: ?controller=khachhangs&&page=listPhong");
        }
        $hangs = $this->HangPhong()->all();
        $phongs = $this->Phong()->all();
        include_once 'views/KhachHangs/add.php';
    }
    function listPhong()
    {

        $khachs = $this->khachHang()->khachHang1();
        $phong = $this->Phong()->all();
        // echo "<pre/>";
        // print_r($khachs);   
        $hangs = [];
        foreach ($phong as $role) {
            $hangs[$role['hang_phong']][] = $role;
        }
        include_once 'views/KhachHangs/listPhongs.php';
        $id = $khachs->id;
        if (isset($_POST['store'])) {
            $this->Phong()->bugPhongs($id,$_REQUEST);
            // $this->khachHang()->store($_REQUEST);
            // header("Location: ?controller=khachhangs&&page=listPhong");
        }
    }
}
