<?php

require_once('./Models/User.php');

class UserController
{
    public static function login()
    {
        $sEmail = $_POST['email'];
        $sPassword = $_POST['password'];
        $oUser = User::getOneByMail($sEmail);
        if ($oUser == false) {
            return false;
        }
        if (password_verify($sPassword, $oUser->password)) {
            $_SESSION['user'] = $oUser;
            return true;
        }
        return false;
    }

    public static function register()
    {
        $sEmail = $_POST['email'];
        $sPassword = $_POST['password'];
        $oUser = new User();
        $oUser->email = $sEmail;
        $oUser->password = password_hash($sPassword, PASSWORD_DEFAULT);
        $oUser->save();
        return true;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }
}
