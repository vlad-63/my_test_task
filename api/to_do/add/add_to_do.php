<?php

require_once '../../db.php';
require_once '../../api.php';

$api_obj = new api();

//инициируем метод
$api_obj->init_metod($_REQUEST['metod'], "post");

//инициируем параметры
$to_do_text = $api_obj->init_request($_REQUEST['to_do_text'],"to_do_text");
$id_executor = $api_obj->init_request($_REQUEST['id_executor'],"id_executor");

// запрос к БД
$sql = "INSERT INTO to_do (id_to_do, body, id_status, id_executor) VALUES(NULL,?,?,?)";
DB::run($sql,[$to_do_text,"1",$id_executor])->fetchAll();

// ответ клиенту
echo $api_obj->response("Good", 200);
