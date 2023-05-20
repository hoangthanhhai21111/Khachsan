<?php
class Group
{
    public function all()
    {
        global $conn;
        // global $conn;
        $sql = "SELECT * FROM Groups";
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $rows = $stmt->fetchAll();
        return $rows;
    }
        //tra ve record theo id
    //     public function find($id){
    //         global $conn;
    //         $sql = "SELECT * FROM `c10_mat_hang` WHERE MAHANG = $id";
    //         $stmt = $conn->query($sql);
    //         $stmt->setFetchMode(PDO::FETCH_OBJ);//array => object
    //         $row = $stmt->fetch();
    //         return $row;
    //     }
    //     //xu ly them moi
        public function store( $data ){
            // global $conn;
            // $name = $data['name'];
            // $address = $data['address'];
            // $email = $data['email'];
            // $day_of_birth = $data['day_of_birth'];
            // $password = $data['password'];
            // $username = $data['username'];
            // $phone = $data['phone'];
            // $group = $data['group'];
            // global $conn;
            // $sql = "INSERT INTO `c10_mat_hang` 
            // (`TENHANG`, `MACONGTY`) 
            // VALUES 
            // ('$TENHANG', $MACONGTY) ";
            // $conn->exec($sql);
        }
    //     //xu ly cap nhat
    //     public function update( $id, $data ){
    //         global $conn;
    //         $TENHANG = $data['TENHANG'];
    //         $MACONGTY = $data['MACONGTY'];    
    //         $sql = " UPDATE `c10_mat_hang` SET 
    //             `TENHANG` = '$TENHANG',
    //             `MACONGTY` = '$MACONGTY'
    //         WHERE `MAHANG` = $id";
    //         $conn->exec($sql);
    //     }
    //     //xu ly xoa
    //     public function delete( $id){
    //         global $conn;
    //         $sql = "DELETE FROM `c10_mat_hang` WHERE MAHANG = $id";
    //         $conn->exec($sql);
    //     }
    }
    ?>