<?php

require_once __DIR__ . "/request.php";
require_once __DIR__ . "/render.php";
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/db.php";
require_once __DIR__ . "/user.php";

require_once __DIR__ . "/../controller/controller_base.php";

class app {

    public const baseAddress = __DIR__ . "/../";
    public const templateAddress = __DIR__ . "/../template/";

    //#####################################
    //Request
    //#####################################
    /**
     * @var request $request
     */
    private $request;

    /**
     * @return request
     */
    public function getRequest() {
        return $this->request;
    }

    //#####################################
    //Render
    //#####################################
    /**
     * @var render $render
     */
    private $render;

    /**
     * @return render
     */
    public function getRender() {
        return $this->render;
    }


    //#####################################
    //Config
    //#####################################
    /**
     * @var config $config
     */
    private $config;

    /**
     * @return config
     */
    public function getConfig() {
        return $this->config;
    }


    //#####################################
    //Database
    //#####################################
    /**
     * @var DB $db
     */
    private $db;

    /**
     * @return DB
     */
    public function getDB() {
        return $this->db;
    } 
    
    
    //#####################################
    //Database
    //#####################################
    /**
     * @var User $user
     */
    private $user;

    /**
     * @return User
     */
    public function getUser() {
        return $this->user;
    }       


    private static $current;
    /**
     * @return app
     */
    public static function Current() {
        return self::$current;
    }
    
    public function __construct()
    {
        session_start();

        self::$current = $this;

        $this->request = new request();
        $this->render = new render();
        $this->config = new config();
        $this->db     = new DB();
        $this->user   = new User();

        $this->db->selectDB("db");

        // echo $this->drawRoute(
        //     $this->request->Controller(),
        //     $this->request->Action()
        // );

        $this->render->renderPage();
    }


    /**
     * Получение класса контроллера
     */
    public function ControllerClass(string $controller) {
        $file = __DIR__ . "/../controller/" . $controller . ".php";
        if (!file_exists($file)) {
            $this->render->WriteError("Файла не существует!");
            die();
        }

        require_once $file;

        if (!class_exists($controller)) {
            $this->render->WriteError("Класса не существует!");
            die();
        }

        $cl = new $controller();
        $cl->setRender($this->render);

        return $cl;
    }
    
    //выполнить метод внутри контроллера
    //C ПРОВЕРКОЙ ВАЛИДНОСТИ
    public function execMethod($class, $method, $param) {

        if (!method_exists($class, $method)) {
            $this->render->WriteError("Не могу вызвать контроллер!");
            die();
        }

        if (!is_callable([$class, $method])) {
            return $this->render->WriteError("Метод не доступен");
            die();
        }

        return $class->$method($param);
    }


    public function getZones() {
        $zones = [
            "test",
            "ttt"
        ];

        
    }
}