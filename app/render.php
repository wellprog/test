<?php

class render {
    
    private $controller;
    private $action;
    /**
     * @var request
     */
    private $request;

    public function __construct()
    {
        $this->request = app::Current()->getRequest();
        $this->controller = $this->request->Controller();
        $this->action = $this->request->Action();
    }

    public function WriteError(string $errorMessage) {
        return $this->WriteHTML($errorMessage, "error", "inline");
    }

    public function WriteHTML($MODEL, $component, $template) {
        ob_start();
        include app::templateAddress 
                . "components/" . $component . "/"
                . $template . ".php";

        return ob_get_clean();
    }

    public function Redirect($controller, $action) {
        header("Location: /" . $controller . "/" . $action);
        die();
    }

    public function WriteJSON($MODEL) {
        return json_encode($MODEL);
    }


    public function renderPage() {
        $component = $this->drawRoute(
                            $this->controller,
                            $this->action
                    );

        $layout = $this->drawLayout($this->controller);
        $headerCSS = $this->drawHeaderCSS($this->controller);
        $headerJS  = $this->drawHeaderJS($this->controller);                    

        $html = str_replace("<<HEADERCSS>>", $headerCSS, $layout);
        $html = str_replace("<<HEADERJS>>", $headerJS, $html);
        $html = str_replace("<<COMPONENT>>", $component, $html);
        
        

        echo($html);
    }


    /**
     * Функция получения текста лайаута
     */
    public function drawLayout($controller) {
        $cl = app::Current()->ControllerClass($controller);
        $template = $cl->getLayout();

        return $this->WriteHTML("", "layout", $template);
    }


    /**
     * Функция получения текста лайаута
     */
    public function drawHeaderCSS($controller) {
        $cl = app::Current()->ControllerClass($controller);
        $css = $cl->getHeaderCSS();

        return $this->WriteHTML($css, "css_js", "inc_css");
    }


    /**
     * Функция получения текста лайаута
     */
    public function drawHeaderJS($controller) {
        $cl = app::Current()->ControllerClass($controller);
        $js = $cl->getHeaderJS();

        return $this->WriteHTML($js, "css_js", "inc_h_js");
    }    

    


    //Отрисовка акшена из контроллера
    public function drawRoute(string $controller, string $action, $params = []) {
    
        $cl = app::Current()->ControllerClass($controller);
        $cl->params = $params;

        if (!app::Current()->getUser()->isLogined())
            if (!$cl->canAnonymus($action))
                return $this->WriteHTML("", "error", "access");

        return app::Current()->execMethod($cl, "exec", $action);

    }

    public function drawAction($action) {
        $cl = app::Current()->ControllerClass($this->controller);

        if (!app::Current()->getUser()->isLogined())
            if (!$cl->canAnonymus($action))
                return $this->WriteHTML("", "error", "access");

        return app::Current()
            ->execMethod($cl, $action, "");
    }


}