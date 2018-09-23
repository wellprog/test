<?php

class usercontr extends ControllerBase {


    protected function checkLogin() {
        $db = $this->DB();


        if (isset($_POST["action"]) &&
            $_POST["action"] == "checklogin") {
                $login = $_POST["login"];
                $password = $_POST["password"];

            $item = $db->selectOne("SELECT * FROM `user` WHERE `login` = :login", 
            ["login" => $_POST["login"]]);
            if($item == null){
                return $this->Render()->WriteHTML(
                    $item,
                    "user",
                    "usernull"
                );
            }

            if ($item["pass"] == $_POST["password"]) {
                $id  = $item["id"];

                app::Current()->getUser()->logIn($login, $id);
                return $this->Render()->WriteHTML(
                    $item,
                    "user",
                    "userlog"
                );

            } else {
                return $this->Render()->WriteHTML(
                    $item,
                    "user",
                    "userpass"
                );
            }
            
                   
        }
    }



    public function userLog() {
        if (isset($_POST["login"])) {
            return $this->checkLogin();
        }
        if (isset($_POST["logout"])) {
            app::Current()->getUser()->logOut();
            return $this->Render()->WriteHTML(
                "",
                "user",
                "userhome"
            );
        }

        $login = app::Current()->getUser()->getLoginIn();

        if ($login == "")
            return $this->Render()->WriteHTML(
                $login,
                "user",
                "userhome"
            );
        else
            return $this->Render()->WriteHTML(
                $login,
                "user",
                "userhome2"
            );
    
    }


    public function logOut() {
        app::Current()->getUser()->logOut();
        return $this->Render()->Redirect("home", "index");
    }



    public function displayButton() {
        $isLogined = app::Current()->getUser()->isLogined();

        if ($isLogined) {
            $username = app::Current()->getUser()->getLoginIn();
            return $this->Render()->WriteHTML($username, "user", "logoutButton");
        } else
            return $this->Render()->WriteHTML("", "user", "loginButton");
    }



}