<?php
include_once './model/GRoup.php';
class GroupController{
    public function list(){
        $id = [];
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
         $group = new Group();
         $pages = 1;
         if (isset($_GET['pages'])) {
             $pages = (!empty($_GET['pages'])) ? $_GET['pages']  : '1';
         }
         $rows = $group->list($id)['rows'];
         $number_page = $group->list($id)['number_page'];
         include_once 'views/groups/list.php';
    }
}
?>