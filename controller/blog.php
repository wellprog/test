<?php

class blog extends ControllerBase {

    /**
     * @var DB
     */
    private $db;

    private $path;

    public function __construct()
    {
        parent::__construct();

        $this->db = app::Current()->getDB();
        $this->path = app::Current()->getRequest()->getPath();
    }
    

    private function getUsers() {
        return $this->db->selectMany("SELECT `user` FROM `v_blog` GROUP by `user`;", []);
    }

    private function getUserBlog($user) {
        return $this->db->selectMany("SELECT * FROM `v_blog` WHERE `user` = :user;", ["user" => $user]);
    }

    private function drawUserBlog($user) {
        return $this->Render()->WriteHTML([
            "user" => $user,
            "showDel" => app::Current()->getUser()->getLoginIn() == $user,
            "posts" => $this->getUserBlog($user)
        ], "blog", "view");
    }
    private function getUserBlogEdit($user, $id) {

        $data = $this->db->selectOne("SELECT * FROM `v_blog` WHERE `id` = :id;", ["id" => $id]);
       
        return $this->drawUserBlogEditId($user, $data);
    }
    private function drawUserBlogEditId($user, $blog) {

        return $this->Render()->WriteHTML([
            "id" => $blog["id"],
            "user" => $blog["user"],
            "header" => $blog["header"],
            "text" => $blog["text"],
            
        ], "blog", "editshow");
    }

    private function saveEdit() {
        if (isset($_POST["action"]) &&
        $_POST["action"] == "editSave") {

            // var_dump($_POST); exit();
            $id = $_POST["userid"];
            $user = $_POST["user"];
            $header = $_POST["header"];
            $text = $_POST["text"];

           
                $this->db->create(
                "UPDATE `v_blog` SET `user` = :user, `update_date` = CURRENT_TIMESTAMP, `header` = :header, `text` = :text WHERE `v_blog`.`id` = :id", 
                [
                    "user" => $user,
                    "header" => $header,
                    "text" => $text,
                    "id" => $id
                ]);

        }

        return $this->drawUserBlog($user);

    }

    private function saveDelete() {
        if (isset($_POST["action"]) &&
        $_POST["action"] == "delete") {

            // var_dump($_POST); exit();
            $id = $_POST["userid"];
            $user = $_POST["user"];
            $header = $_POST["header"];
            $text = $_POST["text"];

           
            $this->db->create("DELETE FROM `v_blog` WHERE `v_blog`.`id` = :id", [ "id" => $id ]);

        }

        return $this->drawUserBlog($user);

    }

    private function savePost() {
        $user = $_POST["user"];
        $header = $_POST["header"];
        $text = $_POST["text"];

        if ($header == "" || $text == "")
            return $this->drawUserBlog($user);

        $this->db->create("INSERT INTO `v_blog` (
                            `user`, 
                            `create_date`, 
                            `update_date`, 
                            `header`, 
                            `text`) 
                            VALUES 
                                (:user, 
                                CURRENT_TIMESTAMP, 
                                CURRENT_TIMESTAMP, 
                                :header, 
                                :text);", 
                                [
                                    "user" => $user,
                                    "header" => $header,
                                    "text" => $text
                                ]);

        return $this->drawUserBlog($user);
    }
    
    protected function user() {
        // var_dump($_POST); exit();
        if (isset($_POST["edit"])) {
            
            $user = $_POST["user"];
            $userid = $_POST["userid"];

            return $this->getUserBlogEdit($user, $userid);
            
            $this->saveEdit();
        }
        if (isset($_POST["action"]) && $_POST["action"] == "editSave") {
            //var_dump($_POST); exit();
            $user = $_POST["user"];
            $userid = $_POST["userid"];
                       
            return $this->saveEdit();
        }
        if (isset($_POST["action"]) && $_POST["action"] == "delete") {
            $user = $_POST["user"];
            $userid = $_POST["userid"];
                       
            return $this->saveDelete();
        }

        if (isset($_POST["user"])) {
            $this->savePost();
        } else if (count($this->path) > 2) {
            return $this->drawUserBlog($this->path[2]);
        }
       

        return $this->Render()->WriteHTML($this->getUsers(), "blog", "index");
    }


    public function getHeaderJS() {
        $data = parent::getHeaderJS();

        $data[] = "https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js";

        return $data;
    }



}