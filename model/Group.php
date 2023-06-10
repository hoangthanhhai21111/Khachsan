<?php
class Group
{
    public function list($id)
    {
        global $conn;
        if (!empty($id)) {
            foreach ($id as $item) {
                $this->delete($item);
            }
        }
        $pages = 1;
        if (isset($_GET['pages'])) {
            $pages = (!empty($_GET['pages'])) ? $_GET['pages']  : '1';
        }
        $limit = 10;
        $offset = ($pages - 1) * $limit;
        $sql_number = "SELECT count(*) from Groups";
        $sql = "SELECT * FROM Groups  ORDER BY id DESC limit $limit OFFSET $offset";
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
    public function all()
    {
        global $conn;
        $sql = "SELECT * FROM Groups";
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public function find($id)
    {
        global $conn;
        $pages = 1;
        if (isset($_GET['pages'])) {
            $pages = (!empty($_GET['pages'])) ? $_GET['pages']  : '1';
        }
        $name = "";
        $email = "";
        if (isset($_GET['name'])) {
            if (!empty($_GET['name'])) {
                $name = $_GET['name'];
            }
        }

        if (isset($_GET['email'])) {
            if (!empty($_GET['email'])) {
                $email = $_GET['email'];
            }
        }
        $limit = 10;
        $offset = ($pages - 1) * $limit;
        $sql_number = "SELECT count(*) from users Where users.group_id = $id";
        $sql = "SELECT users.*, groups.name as group_name
            from users LEFT JOIN groups on users.group_id = groups.id where users.group_id = $id ORDER BY users.id DESC limit $limit OFFSET $offset";
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
            "number_page" => $number_page,
            "name" => $name,
            "email" => $email,
        ];
        return $param;
    }
    public function store($data)
    {
        $name = $data['name'];
        global $conn;
        $sql = "INSERT INTO `groups` 
        (`name`) 
        VALUES 
        ('$name') ";
        $conn->exec($sql);
    }
    public function delete($id)
    {
        global $conn;
        $this->delete_group_role($id);
        $sql = "DELETE FROM `Groups` WHERE id = $id";
        $conn->exec($sql);
    }
    public function listPermission()
    {
        global $conn;
        $sql = "SELECT * FROM roles";
        $stmt = $conn->query($sql);
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public function addPermission($roles)
    {
        global $conn;
        $limit = 1;
        $sql = "SELECT * FROM Groups  ORDER BY id DESC limit $limit ";
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $rows = $stmt->fetchAll();
        $id = 0;
        foreach ($rows as $row) {
            $id = $row->id;
        }
        foreach ($roles as $item) {
            global $conn;
            $sql = "INSERT INTO `group_role` 
            (`group_id`,`role_id`) 
            VALUES 
            ('$id','$item')";
            $conn->exec($sql);
        }
    }
    public function update($id, $data)
    {
        global $conn;
        $name = $data['name'];
        $sql = "UPDATE `groups` SET
        `name` = '$name'
         WHERE `id` = $id ";
        $conn->query($sql);
    }
    function delete_group_role($id)
    {
        global $conn;
        $sql = "DELETE FROM `group_role` WHERE group_id = $id";
        $conn->exec($sql);
    }
    function find_update($id)
    {
        global $conn;
        $sql = "SELECT * FROM `groups` WHERE id = $id";
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $row = $stmt->fetch();
        return $row;
    }
    function find_group_role($id)
    {
        global $conn;
        $sql = "SELECT * FROM `group_role` WHERE group_id = $id";
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $row = $stmt->fetchAll();
        return $row;
    }
    function haspermission($value)
    {
        global $conn;
        $auth = unserialize($_SESSION["object"]);
        $sql = "SELECT roles.name from users INNER JOIN groups ON users.group_id = groups.id
        INNER JOIN group_role ON group_role.group_id = groups.id
        INNER JOIN roles ON group_role.role_id = roles.id where users.id = $auth->id AND roles.name = '$value' ;";
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ); //array => object
        $rows = $stmt->fetchAll();
        if (empty($rows)) {
            // echo true;
            header("Location: error.php");
        }
    }
    public function updatePermission($roles, $id)
    {
        global $conn;
        $this->delete_group_role($id);
        foreach ($roles as $item) {
            global $conn;
            $sql = "INSERT INTO `group_role` 
            (`group_id`,`role_id`) 
            VALUES 
            ('$id','$item')";
            $conn->exec($sql);
        }
    }
}
