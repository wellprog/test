<?php

class request {

    private $path;

    private $controller;
    private $action;

    public function Controller() { return $this->controller; }
    public function Action() { return $this->action; }

    public function __construct()
    {
        $this->pathMaker();
        $this->fillVars();
    }

    /**
     * Функция заполнения переменных
     */
    private function fillVars() {
        $this->controller = "home";
        $this->action = "index";

        if (isset($this->path[0]))
            $this->controller = $this->path[0];

        if (isset($this->path[1]))
            $this->action = $this->path[1];
    }

    /**
     * Функция для получения пути запроса
     * @return array
     */
    public function getPath() {
        return $this->path;
    }

    private function pathMaker() {
        //Получаем строку запроса
        $path = $_SERVER["REQUEST_URI"];
        
        //Вычищаем её от параметров
        $qPath = strpos($path, "?");
        if ($qPath !== false) {
            $path = substr($path, 0, $qPath);
        }
        
        //Разбиваем строку по разделителю
        $tParts = explode("/", $path);

        //Убираем пустые строки
        $parts = [];
        foreach ($tParts as $k => $v) {
            if ($v != "")
                $parts[] = $v;
        }

        $this->path = $parts;
    }

}