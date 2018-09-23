<?php

class admin extends ControllerBase {

    public function canAnonymus($action) {
        return false;
    }

    public function getHeaderJS() {
        $data = parent::getHeaderJS();

        $data[] = "https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js";

        return $data;
    }

    protected function topMenu() {
        $db = $this->DB();


        if (isset($_POST["action"]) &&
            $_POST["action"] == "delete") {
                $id = $_POST["id"];

            $db->create(
                "DELETE FROM `top_menu` WHERE `id` = :id", 
                [
                    "id" => $id
                ]);                
        }

        if (isset($_POST["action"]) &&
            $_POST["action"] == "add") {
                $id = $_POST["id"];

                if ($id == "-1")
                    $db->create("INSERT INTO `top_menu` (`name`, `link`) VALUES (:name, :link);", [
                    "name" => $_POST["name"],
                    "link" => $_POST["link"]
                    ]);
                else
                    $db->create(
                    "UPDATE `top_menu` 
                        SET `name` = :name , `link` = :link
                    WHERE `id` = :id", 
                    [
                        "name" => $_POST["name"],
                        "link" => $_POST["link"],
                        "id" => $id
                    ]);

        }

        $items = $db->selectMany("SELECT * FROM `top_menu`", []);
        
        $item = [
            "id" => -1,
            "name" => "",
            "link" => ""
        ];

        if (isset($_POST["action"]) &&
            $_POST["action"] == "edit") {
            $id = $_POST["id"];

            foreach ($items as $v) {
                if ($v["id"] == $id)
                    $item = $v;
            }
        }
        

        return $this->Render()->WriteHTML(
            [
                "items" => $items,
                "item" => $item
            ]
            , "admin", "topMenu"
        );
    }

    protected function Home() {

        $config = app::Current()->getConfig();
        $config->load("home");

        if (isset($_POST["text"])) {
            $config->set("text", $_POST["text"]);
            $config->set("text1", $_POST["text1"]);
            $config->set("abc", base64_encode($_POST["text1"]));
            $config->save("home");
        }

        $data = [
            "text" => $config->get("text"),
            "text1" => $config->get("text1"),
        ];
        

        return $this->Render()->WriteHTML(
            $data, "admin", "Home"
        );
    }
}