<?php

require_once '../../db.php';
require_once '../../api.php';

$api_obj = new api();

//инициируем метод
$api_obj->init_metod($_REQUEST['metod'], "post");

//инициируем параметры
$surname = $api_obj->init_request($_REQUEST['surname'],"surname");
$name = $api_obj->init_request($_REQUEST['name'],"surname");
$middle_name = $api_obj->init_request($_REQUEST['middle_name'],"surname");

// запрос к БД
$sql = "INSERT INTO executor (id_executor, surname, name, middle_name) VALUES(NULL,?,?,?)";
DB::run($sql, [$surname, $name, $middle_name])->fetchAll();

// ответ клиенту
echo $api_obj->response("Good", 200);