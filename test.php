<?php

$data = file_get_contents(__DIR__ . "/conf/db.conf");
$obj = json_decode($data, true);

var_dump($data, $obj);
