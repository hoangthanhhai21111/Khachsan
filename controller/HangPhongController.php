<?php
include_once "./model/Group.php";
include_once "./model/HangPhong.php";
class HangPhongController
{
  function Group()
  {
    return new Group();
  }
  function list()
  {
    // if ($this->Group()->haspermission("view_hang_phong")) {
    //   $name = $_GET['name'] ?? "";
    //   $hangPhong = new HangPhong();
    //   $rows = $hangPhong->all();
    //   include_once 'views/HangPhongs/list.php';
    // } else {
      header("Location: error.php");
    // }
  }
  function add()
  {
  }
}
