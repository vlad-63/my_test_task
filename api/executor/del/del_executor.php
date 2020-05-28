<?php

require_once '../../db.php';
require_once '../../api.php';

$api_obj = new api();

//инициируем метод
$api_obj->init_metod($_REQUEST['metod'], "delete");

//инициируем параметры
$id_executor = $api_obj->init_request($_REQUEST['id_executor'],"id_executor");

// запрос к БД
$sql = "DELETE FROM executor WHERE id_executor = ?";
DB::run($sql, [$id_executor])->fetchAll();

// ответ клиенту
echo $api_obj->response("Good", 200);
