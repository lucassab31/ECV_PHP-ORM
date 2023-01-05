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
            return null;
        }
        if (md5($sPassword)== $oUser->password) {
            $_SESSION['user_id'] = $oUser->user_id;
            return $oUser;
        }
        return null;
    }

    public static function store()
    {
        $sEmail = $_POST['email'];
        $sPassword = $_POST['password'];
        $oUser = new User();
        $oUser->email = $sEmail;
        $oUser->password = md5($sPassword);
        $oUser->save();
        $_SESSION['user_id'] = $oUser->user_id;
        return $oUser;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }
}
