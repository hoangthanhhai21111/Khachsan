<?php
class khachHang
{
    function all($pages, $ten, $cmnd, $sdt, $id)
    {
        // global $conn;
        $sql = "SELECT khach_hangs.*, dat_phong.thoi_gian_dat, phongs.name
                from khach_hangs 
                LEFT JOIN dat_phong on khach_hangs.id = dat_phong.khach_hang_id
                LEFT JOIN phongs on phongs.id = dat_phong.phong_id
                ORDER BY khach_hangs.id DESC";
        //          $stmt = $conn->query($sql);
        //          $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        //          $rows = $stmt->fetchAll();
        //           print_r($rows);
        global $conn;
        $limit = 10;
        // var_dump($pages);
        // if (!empty($id)) {
        //     foreach ($id as $item) {
        //         $user = $this->find($item);
        //         if (isset($user->avatar)) {

        //             unlink($user->avatar);
        //         }
        //         $this->delete($item);
        //     }
        // }
        $offset = ($pages - 1) * $limit;
        $sql_number = "SELECT count(*) from khach_hangs";
        $sql = "SELECT khach_hangs.*, dat_phong.thoi_gian_dat, phongs.name
      from khach_hangs 
      LEFT JOIN dat_phong on khach_hangs.id = dat_phong.khach_hang_id
      LEFT JOIN phongs on phongs.id = dat_phong.phong_id
       ORDER BY khach_hangs.id DESC limit $limit OFFSET $offset";
        if ($ten) {
            $sql_number = "SELECT count(*) from khach_hangs WHERE khach_hangs.ten like '%$ten%'";
            $sql = "SELECT khach_hangs.*, dat_phong.thoi_gian_dat, phongs.name
          from khach_hangs 
          LEFT JOIN dat_phong on khach_hangs.id = dat_phong.khach_hang_id
          LEFT JOIN phongs on phongs.id = dat_phong.phong_id WHERE khach_hangs.ten like '%$ten%' ORDER BY khach_hangs.id ASC limit $limit OFFSET $offset";
        }
        if ($cmnd) {
            $sql_number = "SELECT count(*) from khach_hangs WHERE khach_hangs.cmnd like '%$cmnd%'";
            $sql = "SELECT khach_hangs.*, dat_phong.thoi_gian_dat, phongs.name
          from khach_hangs 
          LEFT JOIN dat_phong on khach_hangs.id = dat_phong.khach_hang_id
          LEFT JOIN phongs on phongs.id = dat_phong.phong_id WHERE khach_hangs.cmnd like '%$cmnd%' ORDER BY khach_hangs.id ASC limit $limit OFFSET $offset";
        }
        if ($sdt) {
            $sql_number = "SELECT count(*) from khach_hangs WHERE khach_hangs.sdt like '%$sdt%'";
            $sql = "SELECT khach_hangs.*, dat_phong.thoi_gian_dat, phongs.name
          from khach_hangs 
          LEFT JOIN dat_phong on khach_hangs.id = dat_phong.khach_hang_id
          LEFT JOIN phongs on phongs.id = dat_phong.phong_id WHERE khach_hangs.sdt like '%$sdt%' ORDER BY khach_hangs.id ASC limit $limit OFFSET $offset";
        }
        // if ($email && $name) {
        //     $sql_number = "SELECT count(*) from users WHERE users.email like '%$email%'";
        //     $sql = "SELECT users.*, groups.name as group_name
        //     from users LEFT JOIN groups on users.group_id = groups.id WHERE users.email like '%$email%' AND users.name like '%$name%' ORDER BY users.id ASC limit $limit OFFSET $offset";
        // }
        $sql_number =  $conn->prepare($sql_number); //kiểu dữ liệu trả về là số
        $sql_number->execute(); // thực thi câu lệnh
        $number = $sql_number->fetchColumn(); // lấy ra kết quả
        $number_page = ceil($number / $limit);
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $rows = $stmt->fetchAll();
        $param = [
            "rows" => $rows,
            "number_page" => $number_page,
        ];
        return $param;
    }
    function store($data)
    {
        global $conn;
        // echo"<pre/>";
        // print_r($data);
        $ten = $data['ten'];
        $cmnd = $data['cmnd'];
        $sdt = $data['sdt'];
        $sql = "INSERT INTO `khach_hangs` 
            (`ten`, `cmnd`,`sdt`)
        VALUES 
            ('$ten', '$cmnd', '$sdt')";
        $conn->query($sql);
        // $this->khachHang();
    }
     function khachHang1(){
        global $conn; 
       $sql = "SELECT * FROM `khach_hangs` ORDER BY khach_hangs.id DESC limit 1";
       $stmt = $conn->query($sql);
       $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
       $rows = $stmt->fetch();
       return $rows;
    //    print_r($rows);
     }
}
