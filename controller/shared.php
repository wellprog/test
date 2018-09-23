<?php

class shared extends ControllerBase {

    public function canAnonymus($action) {
        if ($action == "bottomForm")
            return false;
        return true;
    }

    public function bottomForm() {
        return $this->Render()->WriteHTML(
            "",
            "shared",
            "form"
        );
    }

    public function topMenu() {
        $db = $this->DB();
        $items = $db->selectMany("SELECT * FROM `top_menu`", []);

        return $this->Render()->WriteHTML(
            $items,
            "shared",
            "topMenu"
        );
    }

}