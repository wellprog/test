<?php


class good_manager extends ControllerBase {

    /**
     * @var DB $db
     */
    private $db;

    private $path;

    public function __construct()
    {
        $this->db = app::Current()->getDB();
        $this->path = app::Current()->getRequest()->getPath();
    }

    public function canAnonymus($action) {
        return false;
    }


    private function getGoods() {
        return $this->db->selectMany("SELECT * FROM `good`", []);
    }
    private function getGoods_category() {
        return $this->db->selectMany("SELECT * FROM `good_category`", []);
    }

    private function getGood($id) {
        return $this->db->selectOne("SELECT * FROM `good` where `id` = :id", [ "id" => $id ]);
    }

    private function getGood_category($id) {
        return $this->db->selectOne("SELECT * FROM `good_category` where `id` = :id", [ "id" => $id ]);
    }

    private function getParams($id) {
        return $this->db->selectMany("SELECT * FROM `good_info` where `good_id` = :id", [ "id" => $id ]);
    }

    private function saveParams($id) {
        $this->db->update("DELETE FROM `good_info` WHERE `good_id` = :id;", [ "id" => $id ]);

        $params = $_POST["param"];
        foreach ($params["name"] as $k => $v)
        if($v != "")
            $this->db->create("INSERT INTO 
                        `good_info` (`good_id`, `name`, `value`) 
                            VALUES (:good_id, :name, :value)", 
                            [
                                "good_id" => $id,
                                "name" => $v,
                                "value" => $params["value"][$k]
                            ]
                        );
    }

    private function saveGood() {
        $good = [
            "id" => $_POST["id"],
            "name" => $_POST["name"],
            "description" => $_POST["description"],
            "category_id" => $_POST["category_id"]
        ];

        if ($good["id"] > 0) {
            $this->db->update("UPDATE `good` 
                                    SET `name` = :name, 
                                        `description` = :description,
                                        `category_id` = :category_id
                                         WHERE 
                                        `good`.`id` = :id ", $good);
        } else {
            $good["id"] = $this->db->create("INSERT INTO `good` 
                                (`name`, `description`) 
                                VALUES (:name, :description)", [
                                    "name" => $good["name"],
                                    "description" => $good["description"]
                                ]);
        }

        $this->saveParams($good["id"]);
        $this->Render()->Redirect("good_manager", "index");
    }

    private function saveGood_category() {
        $good_category = [
            "id" => $_POST["id"],
            "name" => $_POST["name"],
            "description" => $_POST["description"]
        ];

        if ($good_category["id"] > 0) {
            $this->db->update("UPDATE `good_category` 
                                    SET `name` = :name, 
                                        `description` = :description WHERE 
                                        `good_category`.`id` = :id ", $good_category);
        } else {
            $good_category["id"] = $this->db->create("INSERT INTO `good_category` 
                                (`name`, `description`) 
                                VALUES (:name, :description)", [
                                    "name" => $good_category["name"],
                                    "description" => $good_category["description"]
                                ]);
        }

       // $this->saveParams($good_category["id"]);
        $this->Render()->Redirect("good_manager", "good_category");
    }


    public function index() {
        return $this->Render()->WriteHTML(
            [
                "goods" => $this->getGoods()
            ], 
            "good_manager", "index"
        );
    }

    public function good_category() {
        return $this->Render()->WriteHTML(
            [
                "good_category" => $this->getGoods_category()
            ], 
            "good_manager", "good_category"
        );
    }

    public function edit() {
        if (isset($_POST["action"]) && $_POST["action"] == "edit") {
            $this->saveGood();
        }

        $id = 0;
        if (count($this->path) > 2)
            $id = $this->path[2];

        $good = [
            "id" => 0,
            "name" => "",
            "description" => "",
            "category_id" => ""
        ];
        $params = [];
        $good_category1 = [];

        if ($id > 0) {
            $good = $this->getGood($id);
            $params = $this->getParams($id);
            $good_category1 = $this->getGoods_category();
        }

        return $this->Render()->WriteHTML(
            [
                "good" => $good,
                "params" => $params,
                "good_category" => $good_category1
            ], "good_manager", "edit"
        );
    }

    public function edit_category() {
        if (isset($_POST["action"]) && $_POST["action"] == "edit_category") {
            $this->saveGood_category();
        }

        $id = 0;
        if (count($this->path) > 2)
            $id = $this->path[2];

        $good_category = [
            "id" => 0,
            "name" => "",
            "description" => ""
        ];
      //  $params = [];

        if ($id > 0) {
            $good_category = $this->getGood_category($id);
          //  $params = $this->getParams($id);
        }

        return $this->Render()->WriteHTML(
            [
                "good_category" => $good_category
              //  "params" => $params
            ], "good_manager", "edit_category"
        );
    }

    public function showCat (){
     //  $arrCat = $this->db->selectOne("SELECT * FROM `good_category` where `name` = :name", [ "name" => $nameCat ]);
     //  $idCat = $arrCat["id"];
     $idCat = 0;
    //  var_dump($_POST); exit();
     //if (isset($_POST["action"]) && $_POST["action"] == "changeCat") {
      if (count($this->path) > 2) {
        $idCat = $this->path[2];//$_POST["changeCat"];
        return $this->changeCat($idCat);
      } else {
       $good_category1 = [];
       $good_category1 = $this->getGoods_category();  return $this->Render()->WriteHTML(
        [                     
            "good_category" => $good_category1,
            "goodCat" => []
        ], "good_manager", "cat");
        }
    }
    public function changeCat($idCat){

       $arrGoodCat = $this->db->selectMany("SELECT * FROM `good` where `category_id` = :id", [ "id" => $idCat ]);
       $good_category1 = [];
       $good_category1 = $this->getGoods_category();
       return $this->Render()->WriteHTML(
        [                     
            "good_category" => $good_category1,
            "goodCat" => $arrGoodCat 
        ], "good_manager", "cat"
    );

    }




}