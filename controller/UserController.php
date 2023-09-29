<?php
include_once './model/User.php';
include_once './model/GRoup.php';

class UserController
{
    function group()
    {
        return new Group();
    }
    // $group = new Group();
    public function list()
    {
        if ($this->group()->haspermission('view_user')) {
            // $group = new Group();
            // $group->haspermission('view_user');
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
            $pages = 1;
            if (isset($_GET['pages'])) {
                $pages = (!empty($_GET['pages'])) ? $_GET['pages']  : '1';
            }
            $users = new user();
            $rows = $users->all($pages, $name, $email, $id)["rows"];
            $number_page =  $users->all($pages, $name, $email, $id)["number_page"];
            include_once 'views/users/list.php';
        } else {
            header("Location: error.php");
        }
    }

    public function add()
    {
        if ($this->group()->haspermission('add_user')) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                try {
                    $user = new user();
                    $user->store($_REQUEST);
                    header("Location: ?controller=users");
                } catch (Exception $e) {
                    header("Location: ?controller=users");
                }
            } else {
                $user = new user();
                $users = $user->all1();
                $groups = new Group();
                $rows = $groups->all();
                include_once 'views/users/add.php';
            }
        } else {
            header("location:error.php");
        }
    }
    public function edit()
    {
        if ($this->group()->haspermission("update_user")) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                try {
                    $id  = $_GET['id'];
                    $user = new user();
                    $user->update($id, $_REQUEST);
                    header("Location: ?controller=users");
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                }
            } else {
                $id  = $_GET['id'];
                $user = new user();
                $row = $user->find($id);
                $group = new Group();
                $groups = $group->all();
                include_once './views/users/update.php';
            }
        } else {
            header("Location:error.php");
        }
    }

    public function show()
    {
        if ($this->group()->haspermission("show_user")) {
            $id  = $_GET['id'];
            $user = new user();
            $row = $user->find($id);
            $group = new Group();
            $groups = $group->all();
            include_once './views/users/show.php';
        } else {
            header('location:error.php');
        }
    }

    public function delete()
    {
        if ($this->group()->haspermission("delete_user")) {
            $id  = $_GET['id'];
            $user = new user();
            $row = $user->delete($id);
        } else {
            header('location:error.php');
        }
    }
}
