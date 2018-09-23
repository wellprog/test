<?php

class User {

    private $id;
    private $login;

    const USERID = "USERID";
    const LOGIN  = "LOGIN";

    public function __construct()
    {
        if (isset($_SESSION[self::USERID])) {
            $this->id    = $_SESSION[self::USERID];
            $this->login = $_SESSION[self::LOGIN];
        } else {
            $this->logOut();
        }
    }

    public function logIn ($login, $id) {
        $this->id = $id;
        $this->login = $login;

        $_SESSION[self::USERID] = $id;
        $_SESSION[self::LOGIN] = $login;
    }

    public function logOut () {
        $this->id = -1;
        $this->login = "";

        unset($_SESSION[self::LOGIN]);
        unset($_SESSION[self::USERID]);
    }

    public function isLogined() {
        return $this->id != -1;
    }

    public function getLoginIn() {
        return $this->login;
    }

    public function getUserID() {
        return $this->id;
    }

}