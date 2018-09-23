<?php

class ControllerBase {

    private $render;
    /**
     * @var DB $db
     */
    private $db = null;

    public $params;

    public function __construct()
    {
    }

    public function canAnonymus($action) {
        return true;
    }

    public function setRender($render) {
        $this->render = $render;
    }

    /**
     * @return render
     */
    protected function Render() {
        return $this->render;
    }

    /**
     * @return DB
     */
    protected function DB() {
        if ($this->db == null) {
            $this->db = app::Current()->getDB();
            $this->db->selectDB("db");
        }

        return $this->db;
    }

    public function exec($action) {
        if (!method_exists($this, $action)) {
            return $this->Render()->WriteError("Метода не существует");
        }

        if (!is_callable([$this, $action])) {
            return $this->Render()->WriteError("Метод не доступен");
        }

        return $this->$action();
    }

    /**
     * Переопределяя эти функции, мы влияем на 
     * отрисовку CSS файлов в заголовке сайта
     */
    public function getHeaderCSS() {
        return [
            "http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css",
            "http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css",
            "http://www.rubiconepro.ru/assets/fd84b692/css/bootstrap-yii.css",
            "http://www.rubiconepro.ru/assets/fd84b692/css/jquery-ui-bootstrap.css",
            "http://www.rubiconepro.ru/assets/8d678d2d/slick-theme.css",
            "http://www.rubiconepro.ru/assets/8d678d2d/slick.css",
            "http://www.rubiconepro.ru/assets/fa275fdf/css/sweetalert.css",
            "http://www.rubiconepro.ru/assets/98aa8e9/css/rubicone.css?v=3.2",
            "http://www.rubiconepro.ru/assets/98aa8e9/css/flags.css",
            "http://www.rubiconepro.ru/assets/98aa8e9/css/yupe.css",
            "http://www.rubiconepro.ru/assets/98aa8e9/js/fancybox/source/jquery.fancybox.css",
        ];
    }

    /**
     * Переопределяя эти функции, мы влияем на 
     * отрисовку JS файлов в заголовке сайта
     */
    public function getHeaderJS() {
        return [
            "http://www.rubiconepro.ru/assets/9adfe06c/jquery.js",
            "http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js",
            "http://www.rubiconepro.ru/assets/fd84b692/js/bootstrap-noconflict.js",
            "http://www.rubiconepro.ru/assets/fd84b692/bootbox/bootbox.min.js",
            "http://www.rubiconepro.ru/assets/8d678d2d/slick.min.js",
            "ttp://www.rubiconepro.ru/assets/fa275fdf/js/jquery.waterwheelCarousel.min.js",
            "http://www.rubiconepro.ru/assets/fa275fdf/js/sweetalert.min.js",
            "http://www.rubiconepro.ru/assets/9adfe06c/jquery.yiiactiveform.js",
            "http://www.rubiconepro.ru/assets/98aa8e9/js/main.js?v=1",
            "http://www.rubiconepro.ru/assets/98aa8e9/js/jquery.li-translit.js",
            "http://www.rubiconepro.ru/assets/98aa8e9/js/jquery.maskedinput.min.js",
            "http://www.rubiconepro.ru/assets/98aa8e9/js/fancybox/source/jquery.fancybox.js",
            "http://www.rubiconepro.ru/assets/98aa8e9/js/jquery.onscreen.min.js",
        ];
    }

    /**
     * Переопределяя эти функции, мы влияем на 
     * отрисовку Layout'a сайта
     */
    public function getLayout() {
        return "index";
    }

}