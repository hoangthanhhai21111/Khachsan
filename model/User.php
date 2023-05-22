<?php
include_once './controller/UserController.php';
class user
{
    public function find($id)
    {
        global $conn;
        $sql = "SELECT * FROM `users` WHERE id = $id";
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $row = $stmt->fetch();
        return $row;
    }
    public function all1()
    {
        global $conn;
        $sql = "SELECT * from users";
        $stmt = $conn->query($sql);
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public function all($pages, $name, $email, $id)
    {
        global $conn;
        $limit = 10;
        // var_dump($pages);
        if (!empty($id)) {

            foreach ($id as $item) {
                $user = $this->find($item);
                if (isset($user->avatar)) {

                    unlink($user->avatar);
                }
                // echo $item;
                // $sql = "DELETE FROM users WHERE id  = $item";
                // //thuc hien truy van
                // $conn->exec($sql); 
                $this->delete($item);
            }
        }
        $offset = ($pages - 1) * $limit;
        $sql_number = "SELECT count(*) from users";
        $sql = "SELECT users.*, groups.name as group_name
        from users LEFT JOIN groups on users.group_id = groups.id ORDER BY users.id DESC limit $limit OFFSET $offset";
        if ($name) {
            $sql_number = "SELECT count(*) from users WHERE users.name like '%$name%'";
            $sql = "SELECT users.*, groups.name as group_name
            from users LEFT JOIN groups on users.group_id = groups.id WHERE users.name like '%$name%' ORDER BY users.id ASC limit $limit OFFSET $offset";
        }
        if ($email) {
            $sql_number = "SELECT count(*) from users WHERE users.email like '%$email%'";
            $sql = "SELECT users.*, groups.name as group_name
            from users LEFT JOIN groups on users.group_id = groups.id WHERE users.email like '%$email%' ORDER BY users.id ASC limit $limit OFFSET $offset";
        }
        if ($email && $name) {
            $sql_number = "SELECT count(*) from users WHERE users.email like '%$email%'";
            $sql = "SELECT users.*, groups.name as group_name
            from users LEFT JOIN groups on users.group_id = groups.id WHERE users.email like '%$email%' AND users.name like '%$name%' ORDER BY users.id ASC limit $limit OFFSET $offset";
        }
        $sql_number =  $conn->prepare($sql_number); //kiểu dữ liệu trả về là số
        $sql_number->execute(); // thực thi câu lệnh
        $number = $sql_number->fetchColumn(); // lấy ra kết quả
        $number_page = ceil($number / $limit);
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $rows = $stmt->fetchAll();
        $param = [
            "rows" => $rows,
            "number_page" => $number_page
        ];
        return $param;
    }
    //tra ve record theo id

    //     //xu ly them moi
    public function store($data)
    {
        // try{
        $name = $data['name'];
        $address = $data['address'];
        $email = $data['email'];
        $day_of_birth = $data['day_of_birth'];
        $password = $data['password'];
        $username = $data['username'];
        $phone = $data['phone'];
        $group = $data['group'];
        $hash = password_hash($password, PASSWORD_BCRYPT);
        if ($_FILES['avatar']['name'] != '') {
            // Kiểm tra kích thước và định dạng của tệp ảnh
            list($width, $height, $type, $attr) = getimagesize($_FILES['avatar']['tmp_name']);
            if ($width > 0 && $height > 0 && in_array($type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
                // Tệp ảnh hợp lệ
                $img = $_FILES['avatar']['name'];
                $tmp_img = $_FILES['avatar']['tmp_name'];
                // Tạo một tên ngẫu nhiên cho tệp ảnh
                $img_name = md5(uniqid(rand(), true)) . '.' . image_type_to_extension($type);
                // Lưu trữ đường dẫn của tệp ảnh
                $avatar = "./public/images/users/" . $img_name;
                // $avatar = "./../public/images/users/" . $img_name;

                // Di chuyển tệp ảnh vào thư mục mong muốn
                move_uploaded_file($tmp_img, $avatar);
            } else {
                // Tệp ảnh không hợp lệ
                echo "Tệp ảnh không hợp lệ. Vui lòng chọn một tệp khác.";
            }
        }
        // if (isset($_FILES['avatar'])) {
        //     $img = $_FILES['avatar']['name'];
        //     $tmp_img = $_FILES['avatar']['tmp_name'];
        //     $avatar = "./assets/images/users/" . $img;
        //     move_uploaded_file($tmp_img, $avatar);
        // }
        global $conn;
        // Sử dụng prepared statements để tránh SQL injection
        // Sử dụng dấu chấm hỏi ? để đại diện cho các tham số
        // Sử dụng dấu nháy đơn ' thay vì dấu nháy ngược ` cho các giá trị của biến
        // echo $avatar;
        $sql = "INSERT INTO `users` 
                    (`name`, `address`,`email`,`password`,`day_of_birth`,`username`, `phone`,`group_id`,`avatar`) 
        VALUES 
        (   '$name', '$address', '$email', '$hash', '$day_of_birth', '$username', '$phone', '$group', '$avatar')";
        // Chuẩn bị câu lệnh SQL
        $conn->query($sql);
        // $users = new  UserController();
        // $users ->list($content = "thêm mới thành công");
        // } catch(Exception $e){
        // $users = new  UserController();
        //     // $users ->list($content = "thêm mới thất bại");

        // }
        //   if($conn->query($sql)){
        //        header("http://localhost/Quan_ly_khach_san_code_thuan/?controller=users");
        //    }
    }
    //     //xu ly cap nhat
    public function update($id, $data)
    {
        global $conn;
        $name = $data['name'];
        $address = $data['address'];
        $email = $data['email'];
        $day_of_birth = $data['day_of_birth'];
        $username = $data['username'];
        $phone = $data['phone'];
        $group = $data['group'];
        if ($_FILES['avatar']['name'] != '') {
            // Kiểm tra kích thước và định dạng của tệp ảnh
            list($width, $height, $type, $attr) = getimagesize($_FILES['avatar']['tmp_name']);
            if ($width > 0 && $height > 0 && in_array($type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
                // Tệp ảnh hợp lệ
                $img = $_FILES['avatar']['name'];
                $tmp_img = $_FILES['avatar']['tmp_name'];
                // Tạo một tên ngẫu nhiên cho tệp ảnh
                $img_name = md5(uniqid(rand(), true)) . '.' . image_type_to_extension($type);
                // Lưu trữ đường dẫn của tệp ảnh
                $avatar = "./public/images/users/" . $img_name;
                // $avatar = "./../public/images/users/" . $img_name;

                // Di chuyển tệp ảnh vào thư mục mong muốn
                $user = $this->find($id);
                unlink($user->avatar);
                $sql = "UPDATE `users` SET 
            `name` = '$name',
            `address` = '$address',
            `email` = '$email',
            `day_of_birth` = '$day_of_birth',
            `username` = '$username',
            `phone` = '$phone',
            `group_id` = '$group',
            `avatar` = '$avatar'
        WHERE `id` = $id";
                $conn->query($sql);
                move_uploaded_file($tmp_img, $avatar);
            } else {
                // Tệp ảnh không hợp lệ

            }
        } else {
            $sql = " UPDATE `users` SET 
                `name` = '$name',
                `address` = '$address',
                `email` = '$email',
                `day_of_birth` = '$day_of_birth',
                `username` = '$username',
                `phone` = '$phone',
                `group_id` = '$group'
            WHERE `id` = $id";
            $conn->query($sql);
        }
        // print $sql;
        // die();
    }
    //xu ly xoa
    public function delete($id)
    {
        global $conn;
        $user = $this->find($id);
        if (isset($user->avatar)) {

            unlink($user->avatar);
        }
        $sql = "DELETE FROM `users` WHERE id = $id";
        $conn->exec($sql);
    }
}
