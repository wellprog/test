<?php

class template {
    const layout = "/layout/index.php";

    protected $CSSArray;


    public function __construct()
    {
        $this->CSSArray = Array();

        $layout = $this->WriteHTML([], "layout", "index");
        $headercss = $this->getHeaderCSS();

        $layout = str_replace(
            "<headercss />", //Что
            $headercss,      //Чем
            $layout          //Где
        );

        echo($layout);
    }

    public function getHeaderCSS() {
        $css = [
            "css/main.css"
        ];

        $css = array_merge($this->CSSArray, $css);

        return $this->WriteHTML($css, "css_js", "inc_css");
    }

    public function getHeaderJS() {
        return [
            "js/main.js"
        ];
    }

    function getMenu($name, $template = "menu") {

        $nodes = [
            [
                "url" => "/",
                "title" => "testkljbdfas asdgf"
            ],
            [
                "url" => "/",
                "title" => "test adsgfasdf"
            ],
            
        ];

        return $this->WriteHTML($nodes, "menu", $template);
    }

    function ShowHeader() {
        $this->CSSArray[] = "/css/header.css";
        return $this->WriteHTML([], "header", "index");
    }

    function WriteHTML($MODEL, $component, $template) {
        ob_start();
        
        include self::templateAddress 
                . "components/" . $component . "/"
                . $template . ".php";

        return ob_get_clean();
    }
    
}

//new template();

require_once __DIR__ . "/app/app.php";

new app();


// $db = new PDO(
//     "mysql:host="."127.0.0.1"
//         .";ports="."3306"
//         .";dbname="."test"
//         .";charset=utf8",
//     "root",
//     ""
// );

// $st = $db->prepare("SELECT * FROM `user`");
// $st->execute();

// var_dump($st->fetchAll());