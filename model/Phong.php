<?php
class Phong{
    function all(){
        global $conn;
        $sql = "SELECT * FROM `phongs`;";
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $rows = $stmt->fetchAll();
        return $rows;
    }
}