<?php
include_once './model/User.php';
include_once './model/GRoup.php';

class UserController
{
    // trang danh sach
    public function list()
    {
        // echo __METHOD__;
        $id = [];
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $name = "";
        $email = "";
        if (isset($_GET['name'])) {
            if (!empty($_GET['name'])) {
                $name = $_GET['name'];
            }
        }
        if (isset($_GET['email'])) {
            if (!empty($_GET['email'])) {
                $email = $_GET['email'];
            }
        }
        // echo ($_GET['name']);
        $pages = 1;
        // if (isset($_GET['pages'])) {
        if (isset($_GET['pages'])) {
            $pages = (!empty($_GET['pages'])) ? $_GET['pages']  : '1';
        }
        // }
        $users = new user();
        $rows = $users->all($pages, $name, $email, $id)["rows"];
        $number_page =  $users->all($pages, $name, $email, $id)["number_page"];
        include_once 'views/users/list.php';
    }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                //    print_r($_REQUEST) ;
                $user = new user();
                $user->store($_REQUEST);
                header("Location: ?controller=users");
                //  header("Location: ./index");
                // $this->list();
            } catch (Exception $e) {
                // echo 'Message: ' .$e->getMessage();
                header("Location: ?controller=users");
                // $this->list();
            }
        } else {
            $user = new user();
            $users = $user->all1();
            $groups = new Group();
            $rows = $groups->all();
            include_once 'views/users/add.php';
        }
    }
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                //    print_r($_REQUEST) ;
                $id  = $_GET['id'];
                $user = new user();
                $user->update($id, $_REQUEST);
                header("Location: ?controller=users");
                //  header("Location: ./index");
                // $this->list();
            } catch (Exception $e) {
                echo 'Message: ' .$e->getMessage();
                // header("Location: ?controller=users");
                // $this->list();
            }
        } else {
            $id  = $_GET['id'];
            $user = new user();
            $row = $user->find($id);
            $group = new Group();
            $groups = $group->all();
            // print_r($row->name);
            include_once './views/users/update.php';
            // echo $id;
        }
    }
    public function show(){
        $id  = $_GET['id'];
        $user = new user();
        $row = $user->find($id);
        $group = new Group();
        $groups = $group->all();
        include_once './views/users/show.php';

    }
    public function delete(){
        $id  = $_GET['id']; 
        $user = new user();
        $row = $user->delete($id);
    }
}
?>
