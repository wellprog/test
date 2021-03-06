<?php

//Подключение к базе данных
$db = new PDO("mysql:host=localhost;dbname=test", "root", "", array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
));

//Запрос 1
//Получение версий данных

if (isset($_GET["type"]) && $_GET["type"] == "version") {
    $st = $db->prepare("select id, version from `user`");

    $st->execute();

    echo(json_encode($st->fetchAll()));
}


if (isset($_GET["type"]) && $_GET["type"] == "getrecords") {
    $st = $db->prepare("select * from `user` where id in (" . $_GET["records"] . ")");

    $st->execute();

    echo(json_encode($st->fetchAll()));
}


/**
 * СИНХРОНИЗАЦИЯ версия 1
 * 
 * В таблице содержится поле версия
 * 
 * запрос - дай мне версии данных
 * ответ - массив id + версия
 * 
 * запрос - дай мне строки №1,2,3
 * ответ - массив строк
 * 
 * http://192.168.30.91/?type=version
 * http://192.168.30.91/?type=getrecords&records=2,3
 * 
 * 
 * 
 * СИНХРОНИЗАЦИЯ версия 2
 * 
 * Добавляется таблица версий таблиц
 * 
 * запрос - дай мне версию данных таблицы user
 * ответ  - версия данных таблицы user 54
 * 
 * запросы из варианта 1
 * 
 * ____________________________________________
 * Метод синхронизации годится для небольших
 * данных, будет работать хорошо
 * 
 * 
 * 
 * СИНХРОНИЗАЦИЯ версия 3
 * 
 * Синхронизация методом лога
 * 
 * Создается таблица логов, что куда записалось,
 * и что было изменено.
 * 
 * При записи, изменении, удалении данных,
 * в таблицу логов пишется, в какой таблице,
 * какая запись была изменена.
 * 
 * при добавлении
 * пишется id записи, имя таблицы, в значение
 * поля пишется вся запись в формате JSON
 * 
 * при изменении
 * пишется id записи, имя таблицы, имя поля, 
 * значение поля
 * 
 * при удалении
 * пишется id записи.
 * 
 * сам тип изменения пишется в поле action_type
 * 
 * 
 * запрос - дай мне лог, начиная с позиции N
 * ответ - массив строк лога
 */