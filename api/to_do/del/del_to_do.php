<?php

require_once '../../db.php';
require_once '../../api.php';

$api_obj = new api();

//инициируем метод
$api_obj->init_metod($_REQUEST['metod'], "delete");

//инициируем параметры
$id_to_do = $api_obj->init_request($_REQUEST['id_to_do'],"id_to_do");

// запрос к БД
$sql = "DELETE FROM to_do WHERE id_to_do = ?";
DB::run($sql, [$id_to_do])->fetchAll();

// ответ клиенту
echo $api_obj->response("Good", 200);
