<?php

require_once '../../db.php';
require_once '../../api.php';

$api_obj = new api();

// выбираем ИСПОЛНИТЕЛЕЙ из БД
$sql = "SELECT * FROM executor";
$ex = DB::run($sql)->fetchAll();

// инициируем статусы для формирования вида ответа
switch ($_REQUEST['executor_status']) {

    case "table":

        // формируем таблицу EXECUTOR
        $table = '<table border="1px" style="width: 100%;">'
                . '<caption>Список исполнителей</caption>
                        <thead>
                        <tr>
                            <th>Номер</th>
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>';

        // формируем строки таблицы
        for ($i = 0; $i < count($ex); $i++) {
            $table = $table . "<tr><td>" . $i . "</td><td>" . $ex[$i]['surname'] . "</td><td>" . $ex[$i]['name'] . "</td><td>" . $ex[$i]['middle_name'] .
                    "</td><td><button id=\"btn\" data-id_executor=\"" . $ex[$i]['id_executor'] . "\" "
                    . "onClick=\"javascript: executor_delete(this.dataset.id_executor)\">Удалить</button></td></tr>";
        }

        $table = $table . '</tbody></table>';

        // ответ клиенту
        echo $api_obj->response($table, 200);

            break;

    case "select":

        $option = "<option>- Выберите исполнителя -</option>";

        for ($i = 0; $i < count($ex); $i++) {
            $option = $option . "<option value=\"" . $ex[$i]['id_executor'] . "\">" . $ex[$i]['surname'] . " " . $ex[$i]['name'] . " " . $ex[$i]['middle_name'] . "</option>";
        }

        // ответ клиенту
        echo $api_obj->response($option, 200);

            break;

    default :

        // ответ клиенту
         echo $api_obj->response("Статус ".$_REQUEST['executor_status']." не поддерживается", 404);

            break;
}
