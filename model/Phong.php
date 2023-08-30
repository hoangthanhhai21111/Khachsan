<?php
class Phong
{
    function all()
    {
        global $conn;
        // if (!empty($id)) {
        //     foreach ($id as $item) {
        //         $user = $this->find($item);
        //         if (isset($user->avatar)) {

        //             unlink($user->avatar);
        //         }
        //         $this->delete($item);
        //     }
        // }
        $sql = "SELECT phongs.*, hang_phongs.name as hang_phong FROM `phongs`
        JOIN hang_phongs on hang_phongs.id = phongs.hang_id
        -- LEFT JOIN gia_phongs on hang_phongs.id = gia_phongs.hang_id 
        ";

        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $rows = $stmt->fetchAll();
        return $rows;
    }
    function listAll($name, $hang, $trang_thai, $id)
    {
        global $conn;
        // if (!empty($id)) {
        //     foreach ($id as $item) {
        //         $user = $this->find($item);
        //         if (isset($user->avatar)) {

        //             unlink($user->avatar);
        //         }
        //         $this->delete($item);
        //     }
        // }
        $sql = "SELECT phongs.*, hang_phongs.name as hang_phong FROM `phongs`
        JOIN hang_phongs on hang_phongs.id = phongs.hang_id
        -- LEFT JOIN gia_phongs on hang_phongs.id = gia_phongs.hang_id 
        ";
        if ($name) {
            $sql = "SELECT phongs.*, hang_phongs.name as hang_phong FROM `phongs`
                    JOIN hang_phongs on hang_phongs.id = phongs.hang_id where phongs.name like '%$name%'
                    ";
        }
        if ($hang) {
            $sql = "SELECT phongs.*, hang_phongs.name as hang_phong FROM `phongs`
                    JOIN hang_phongs on hang_phongs.id = phongs.hang_id where phongs.name like '%$name%'
                    ";
        }

        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $rows = $stmt->fetchAll();
        return $rows;
    }
    function bugPhongs($id, $data)
    {
        echo "<pre>";
        print_r($data);
        // global $conn;
        // $id_khach_hang = $id;
        // $idphong = $data['id'];
        // $timestamp = time();
        // foreach($$idPhong as $idPhong){
        //     $sql = "INSERT INTO  `dat_phong` (`id_khach_hang`,`phong_id`, `thoi_gian_dat`,`tien`)
        //     VALUE ('$id_khach_hang', '$idPhong','$timestamp' )
        //     ";
        // }
    }
    // function     
}
