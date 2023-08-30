<?php
include_once './model/phong.php';
include_once './model/GRoup.php';
include_once './model/HangPhong.php';
class PhongController
{
    function Phong()
    {
        return new Phong();
    }
    function list()
    {
        // $group = new Group();
        // $group->haspermission('view_groups');
        $phong = new Phong();
        $id = [];
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $name = "";
        $hang = "";
        $trang_thai = "";
        if (isset($_GET['hang'])) {
            if (!empty($_GET['hang'])) {
                $hang = $_GET['hang'];
            }
        }

        if (isset($_GET['name'])) {
            if (!empty($_GET['name'])) {
                $name = $_GET['name'];
            }
        }
        if (isset($_GET['trang_thai'])) {
            if (!empty($_GET['trang_thai'])) {
                $trang_thai = $_GET['trang_thai'];
            }
        }
        $pages = 1;
        if (isset($_GET['pages'])) {
            $pages = (!empty($_GET['pages'])) ? $_GET['pages']  : '1';
        }
        $hangs = new Hangphong();
        $hangs = $hangs->all();
        $phongs = $phong->listAll($name, $hang, $trang_thai, $id);
        $number_page = 1;
        include_once 'views/phongs/list.php';
    }
}
