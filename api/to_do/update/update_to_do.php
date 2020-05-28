<?php

require_once '../../db.php';
require_once '../../api.php';

$api_obj = new api();

//инициируем метод
$api_obj->init_metod($_REQUEST['metod'], "update");

//инициируем параметры
$to_do_text = $api_obj->init_request($_REQUEST['to_do_text'], "to_do_text");
$id_to_do = $api_obj->init_request($_REQUEST['id_to_do'], "id_to_do");
$id_status = $api_obj->init_request($_REQUEST['id_status'], "id_status");
$id_executer = $api_obj->init_request($_REQUEST['id_executer'], "id_executer");

// запрос к БД
$sql = "UPDATE to_do SET body = ?, id_status = ?, id_executor = ? WHERE id_to_do = ?";
DB::run($sql, [$to_do_text, $id_status, $id_executer, $id_to_do])->fetchAll();

// ответ клиенту
echo $api_obj->response("Good", 200);
