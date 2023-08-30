<?php
include_once './model/login.php';

class loginController
{
    public function login()
    {
        if (isset($_SESSION['object'])) {
            header("Location:index.php?controller=users");
        } else {
            if (isset($_POST["login"])) {
                header("https://www.youtube.com/watch?v=MpfrOA5ghkc&t=2119s");

                $loginprocessing = new login();
                if ($loginprocessing->loginProcessing($_REQUEST)) {
                    if(isset($_SESSION['object'])){
                    header("Location:index.php?controller=users");
                }
                else {
                    include_once 'views/login/login.php';
                }
                }
            } else {
                include_once 'views/login/login.php';
            }
        }
    }
    public function logout()
    {
        if ($_SESSION['object']) {
            $loginprocessing = new login();
            $loginprocessing->logout();
            header("Location:login.php?controller=login");
        }
    }
}
