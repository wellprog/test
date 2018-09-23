<?php

class home extends ControllerBase {

    // public function exec($action) {
    //     //Логика по доступу
    //     return parent::exec($action);
    // }

    protected function index() {

        $config = app::Current()->getConfig();
        $config->load("home");

        $data = $config->get("text");

        return $this
                ->Render()
                ->WriteHTML($data, "home", "index");
    }

    protected function test() {
        return $this
                ->Render()
                ->WriteHTML("", "home", "test");
    }

    public function leftMenu() {
        $menu = [
            [
                "name" => "test",
                "url" => "/home/test"
            ],
            [
                "name" => "index",
                "url" => "/home/index"
            ]
        ];
        return $this
            ->Render()
            ->WriteHTML($menu, "home", "left_menu");
    }
}