<?php

class config {


    //###############################################

    private $currentConfig = "";
    private $allConfigs = [];    

    public function load($config) {
        $this->currentConfig = $config;

        $file = app::baseAddress . "conf/" . $config . ".conf";
        if (file_exists($file)) {
            $data = file_get_contents($file);
            $this->allConfigs[$config] = json_decode($data, true);
        } else {
            $this->allConfigs[$config] = [];
        }
    }

    public function save($config) {
        if ($config == "")
            return;
            
        $this->currentConfig = $config;

        $file = app::baseAddress . "conf/" . $config . ".conf";

        if (!isset($this->allConfigs[$config]))
            $this->allConfigs[$config] = [];
            
        $data = json_encode($this->allConfigs[$config]);
        file_put_contents($file, $data);
    }

    public function get($key, $defaultValue = "") {
        if ($this->currentConfig == "")
            return $defaultValue;

        if (!isset($this->allConfigs[$this->currentConfig]))
            return $defaultValue;

        if (!isset($this
                ->allConfigs
                    [$this->currentConfig]
                    [$key])
            )
            return $defaultValue;

        return $this
                    ->allConfigs
                        [$this->currentConfig]
                        [$key];
    }

    public function set($key, $value) {
        if ($key == "") 
            return;

        if ($this->currentConfig == "")
            return;

        if (!isset($this->allConfigs[$this->currentConfig]))
            $this->allConfigs[$this->currentConfig] = [];

        $this->allConfigs [$this->currentConfig][$key] = $value;
    }
}