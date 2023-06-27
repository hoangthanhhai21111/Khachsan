<?php
class HangPhong{
    function all(){
        global $conn;
        $sql = "SELECT * FROM `hang_phongs`;";
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $rows = $stmt->fetchAll();
        return $rows;
    }
}