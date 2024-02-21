<?php
include_once './model/GRoup.php';
class GroupController
{
    public function list()
    {
        $group = new Group();
        //phân quyền
        if ($group->haspermission('view_group')) {
            $id = [];
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
            }
            $pages = 1;
            if (isset($_GET['pages'])) {
                $pages = (!empty($_GET['pages'])) ? $_GET['pages']  : '1';
            }
            $rows = $group->list($id)['rows'];
            $number_page = $group->list($id)['number_page'];
            include_once 'views/groups/list.php';
        } else {
            header("Location: error.php");
        }
    }
    public function add()
    {
        $group = new Group();
        //phân quyền
        if ($group->haspermission('add_group')) {
            // $group = new Group();
            // $group->haspermission('add_group');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                try {
                    $roles = [];
                    $roles = $_POST['roles'];
                    $group->store($_REQUEST);
                    $group->addPermission($roles);
                    header("Location: ?controller=groups");
                } catch (Exception $e) {
                    header("Location: ?controller=groups");
                }
            }
            $rows = $group->listPermission();
            $position_names = [];
            /////lấy tên nhóm quyền
            foreach ($rows as $role) {
                $position_names[$role['group_name']][] = $role;
            }
            // print_r($position_names);
            include_once 'views/groups/add.php';
        } else {
            header("Location: error.php");
        }
    }
    public function show()
    {
        $group = new Group();
        if ($group->haspermission('show_group')) {
            $id = $_GET['id'];
            $group = new Group();
            $rows = $group->find($id)['rows'];
            $number_page = $group->find($id)['number_page'];
            $name = $group->find($id)['name'];
            $email = $group->find($id)['email'];
            include_once 'views/groups/show.php';
        } else {
            header("Location: error.php");
        }
    }
    public function delete()
    {
        $id = $_GET['id'];
        $group = new Group();
        $rows = $group->delete($id);
    }
    public function edit()
    {
        $group = new Group();
        if ($group->haspermission('update_group')) {
            $group = new group();
            $id = $_GET['id'];
            if (isset($_POST['update'])) {
                $row = $group->update($id, $_REQUEST);
                try {
                    $roles = [];
                    $roles = $_POST['roles'];
                    $row = $group->update($id, $_REQUEST);
                    $group->updatePermission($roles, $id);
                    header("Location: ?controller=groups");
                } catch (Exception $e) {
                    header("Location: ?controller=groups");
                }
            }
            // lấy tên Groups
            $groups = $group->find_update($id);
            // lấy quyền
            $rows = $group->listPermission();
            $position_names = [];
            /////lấy tên nhóm quyền
            foreach ($rows as $role) {
                $position_names[$role['group_name']][] = $role;
            }
            $group_role = $group->find_group_role($id);
            // echo "<pre/>";
            // print_r($group_role);
            include_once 'views/groups/update.php';
        } else {
            header("Location: error.php");
        }
    }
}
