<?php


class good_basket extends ControllerBase {

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

    private function getBaskets() {
        return $this->db->selectMany("SELECT * FROM `good_basket`", []);
    }
    
    private function getBasket($id) {
        return $this->db->selectOne("SELECT * FROM `good_basket` where `id` = :id", [ "id" => $id ]);
    }
    
    private function getBasketByUser($id) {

        //// Как PHP генерирует ответ от базы
        // $arr = [];

        //// База присылает массив значений
        // $records = [
        //     ["1", "test", "abc", "11"],
        //     ["2", "tttt", "aaa", "22"]
        // ];

        //// А так же массив ключей
        // $keys = [
        //     "id", "name", "value", "id"
        // ];

        //// Индекс массива ключей равен индексу массива значений
        //// И именно по этому совпадению, PHP генерит свой итоговый массив
        // foreach ($records as $k => $v) {
        //     foreach ($keys as $key => $value) {
        //         $arr[$value] = $v[$key];
        //     }
        // }

        return $this->db->selectMany(
            "SELECT `good_basket`.`id`, `good_basket`.`number_order`, `good_basket`.`good_id`, `good_basket`.`prise`, `good_basket`.`user_id`, `good_basket`.`count`, `good_basket`.`is_done`, `good`.`name`, `good`.`description`, `good`.`category_id` FROM `good_basket` LEFT JOIN `good` on `good`.`id` = `good_basket`.`good_id` where `user_id` = :id AND `is_done` = 0", [ "id" => $id ]);
    }

    public function addGoodInBasket() {
        if (isset($_POST["action"]) && $_POST["action"] == "addBasket") {
            $this->saveAddGoodBasket();
        }

    }
    public function saveAddGoodBasket() {
        $curUser = app::Current()->getUser();
        $basket = [
            "id" => $_POST["id"],
            "number_order" => "0",
            "good_id" => $_POST["id_good_basket"],
            "prise" => "10",
            "user_id" => $curUser->getUserID(),
            "count" => "1",
            "is_done" => "0"
        ];

       // var_dump($basket); exit();
      
        $this->db->create(
            "INSERT INTO `good_basket` (`number_order`, `good_id`, `prise`, `user_id`, `count`, `is_done`)
             VALUES (:number_order, :good_id, :prise, :user_id, :count, :is_done)", [
                                    "number_order" => $basket["number_order"],
                                    "good_id" => $basket["good_id"],
                                    "prise" => $basket["prise"],
                                    "user_id" => $basket["user_id"],
                                    "count" => $basket["count"],
                                    "is_done" => $basket["is_done"],

                                ]);
        


    }

    public function deleteGoodBasket (){
     
        $id = $_POST["id"];

        $this->db->create("UPDATE `good_basket` SET `is_done` = '1' WHERE `good_basket`.`id` = :id", ["id" => $id]);

        return $this->index();
 

    }

    public function index() {
        $curUser = app::Current()->getUser();
        $curUserID = $curUser->getUserID();
        $goods_basket = $this->getBasketByUser($curUserID);

     //   var_dump($goods_basket); exit();
        return $this->Render()->WriteHTML(
            [
                "goods_basket" => $goods_basket
            ], 
            "good_basket", "index"
        );
    }

}
