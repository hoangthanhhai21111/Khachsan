<?php
include_once "./model/HangPhong.php";
 class HangPhongController{
   function list(){
    $name = $_GET['name']??"";
    $hangPhong = new HangPhong();
    $rows = $hangPhong->all();
    include_once 'views/HangPhongs/list.php';
   }
 }