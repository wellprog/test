<?php

class DB {
    //Условия задачи
    // Класс должен работать с несколькими базами
    // Обязан иметь 4 функции
    // 1 - Добавление записи (возвращает последний вставленный ID)
    // 2 - Обновление записей (возвращает сколько записей затронуто)
    // 3 - Выбрать все
    // 4 - Выбрать одну запись

    //Использовать PDO
    
    private $currentDB;
    private $allDB = [];

    public function selectDB($dbName) {
        $this->currentDB = $dbName;
    }

    function t () {
        if (!isset($this->allDB[$this->currentDB])) {    
            $config = app::Current()->getConfig();
            $config->load($this->currentDB);

            
            $db = new PDO(
                "mysql:host=".$config->get("Host", "localhost")
                    .";port=".$config->get("Port", "3306")
                    .";dbname=".$config->get("DBName")
                    .";charset=utf8",
                $config->get("Login", "root"),
                $config->get("Password")
            );
            
            $this->allDB[$this->currentDB] = $db;
        }

        return $this->allDB[$this->currentDB];
    }

    // function add($sql, $params) {
    //     $statment = $db->prepare($sql);
    //     $statment->exec($params);

    //     return $db->lastInsertId();
    // }

    /**
     * @var PDO $db
     */
    private $db = null;

    /**
     * @return PDO
     */
    private function getDb() {
        if ($this->db == null)
            $this->db = $this->t();
        return $this->db;
    }


    /**
     * @return PDOStatement
     */
    private function createStatment($sql, $params) {
        //TODO Добавить обработку ошибок

        //Получение базы
        $db = $this->getDb();
        //Подготовка запроса
        //На данном этапе запрос уже отправлен 
        $stmt = $db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmt->execute();

        return $stmt;
    }


    /**
     * @param string $sql
     * Параметр в котором мы передаем сам запрос
     * внутри запроса могут быть плейсхолдеры (
     * метки в которые можно передать параметры)
     * например SELECT * FROM `T` WHERE `id` = :id
     * 
     * @param array $params
     * Параметры которые передаются в плейсхолдеры
     * запроса. Массив имеет вид 
     * {
     *      id   : "test",
     *      name : "abcdef"
     * }
     * 
     * @return array|false
     * Возвращает либо набор данных, либо false
     * если что то пошло не так
     */
    public function selectMany($sql, $params) {

        $stmt = $this->createStatment($sql, $params);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }


    /**
     * @param string $sql
     * Параметр в котором мы передаем сам запрос
     * внутри запроса могут быть плейсхолдеры (
     * метки в которые можно передать параметры)
     * например SELECT * FROM `T` WHERE `id` = :id
     * 
     * @param array $params
     * Параметры которые передаются в плейсхолдеры
     * запроса. Массив имеет вид 
     * {
     *      id   : "test",
     *      name : "abcdef"
     * }
     * 
     * @return array|false
     * Возвращает либо набор данных, либо false
     * если что то пошло не так
     */
    public function selectOne($sql, $params) {        

        $stmt = $this->createStatment($sql, $params);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $data;

    }


    public function create($sql, $params) {
        // var_dump($sql, $params); exit();
        $stmt = $this->createStatment($sql, $params);
        //var_dump($this->db->errorInfo()); exit();
        return $this->getDb()->lastInsertId();
    }

    //TODO Доделать
    public function createMany($sql, $delegate) {

        //Получение базы
        $db = $this->getDb();
        //Подготовка запроса
        //На данном этапе запрос уже отправлен 
        $stmt = $db->prepare($sql);

        while (true) {
            $data = $delegate();
            if ($data == false) break;

            foreach ($data as $key => $value) {
                $stmt->bindParam(":" . $key, $value);
            }

            $stmt->execute();
        }
        
        return $this->getDb()->lastInsertId();
    }


    public function update($sql, $params) {
        $stmt = $this->createStatment($sql, $params);
        return $stmt->rowCount();
    }
}