<?php
include_once './controller/UserController.php';
class login
{
    public function loginProcessing($data)
    {
        global $conn;
        $username = $data['username'];
        $password = $data['password'];
        // $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "SELECT count(*) FROM `users` where username = '$username'";
        $sql_number =  $conn->prepare($sql); //kiểu dữ liệu trả về là số
        $sql_number->execute(); // thực thi câu lệnh
        $number = $sql_number->fetchColumn();
        if ($number == 1) {
            // header("Location: index.php");
            $authSql = "SELECT * FROM `users` where username = '$username'";
            $stmt = $conn->query($authSql);
            $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
            $row = $stmt->fetch();
            // echo password_verify($password, $row->password);
            if (password_verify($password, $row->password)) {
                // luu thong tin dang nhap len session
                $_SESSION["object"] = serialize($row);
                // lấy thông tin ngươi đăng nhập
                $object = unserialize($_SESSION["object"]);
                // echo $object->name;
                return true;
            } else {
                echo "sai mật khẩu";
                return false;
            }
            //  print_r($row->name);
        } else {
            echo "tài khoản ko chính sác";
            return false;
        }
    }
    public function logout()
    {
        unset($_SESSION['object']);
    }
}
