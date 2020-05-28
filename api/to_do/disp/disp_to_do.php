<?php

require_once '../../db.php';
require_once '../../api.php';

$api_obj = new api();

//инициируем метод
$api_obj->init_metod($_REQUEST['metod'],"get");

// инициируем статусы для формирования запроса к БД для выборки ЗАДАЧ по фильтру
switch ($_REQUEST['disp_status']){

    // Отобразить все задачи
    case "all":

        $sql = "SELECT * FROM to_do t1, status t2, executor t3 WHERE t1.id_status=t2.id_status && t1.id_executor=t3.id_executor ORDER BY date_start DESC";

        break;

    // в работе
    case "1":

        $sql = "SELECT * FROM to_do t1, status t2, executor t3 WHERE t1.id_status=t2.id_status && t1.id_executor=t3.id_executor && t1.id_status='1' ORDER BY date_start DESC";

        break;

    // выполнено
    case "2":

        $sql = "SELECT * FROM to_do t1, status t2, executor t3 WHERE t1.id_status=t2.id_status && t1.id_executor=t3.id_executor && t1.id_status='2' ORDER BY date_start DESC";

        break;

    // просроченно
    case "3":

        $sql = "SELECT * FROM to_do t1, status t2, executor t3 WHERE t1.id_status=t2.id_status && t1.id_executor=t3.id_executor && t1.id_status='3' ORDER BY date_start DESC";

        break;

    // приостановленно
    case "4":

        $sql = "SELECT * FROM to_do t1, status t2, executor t3 WHERE t1.id_status=t2.id_status && t1.id_executor=t3.id_executor && t1.id_status='4' ORDER BY date_start DESC";

        break;

    // отменено
    case "5":

        $sql = "SELECT * FROM to_do t1, status t2, executor t3 WHERE t1.id_status=t2.id_status && t1.id_executor=t3.id_executor && t1.id_status='5' ORDER BY date_start DESC";

        break;

    default:

        echo $api_obj->response("Статус ".$_REQUEST['disp_status']." не поддерживается", 404);

        break;

}
// запрашиваем задачи
$to_do = DB::run($sql)->fetchAll();

// запрашиваем статусы задач
$sql2 = "SELECT * FROM status";
$to_do_status = DB::run($sql2)->fetchAll();

// запрашиваем исполнителей задач
$sql3 = "SELECT * FROM executor";
$to_do_executor = DB::run($sql3)->fetchAll();

// формируем заголовок таблицы задач
$table = '<table class="to_do_list"><caption>Список задач</caption>
        <thead>
        <tr>
            <th>Сохранить изменения</th>
            <th>Задача</th>
            <th>Статус</th>
            <th>Дата создания</th>
            <th>Исполнитель</th>
            <th>Удалить задачу</th>
        </tr>
        </thead>';

// формируем строки таблицы, таблицы задач
for ($i = 0; $i < count($to_do); $i++) {

    // формируем select статусов для ЗАДАЧ
    $status_select = "<select id=\"status_select_" . $to_do[$i]['id_to_do'] . "\">";

    for ($j = 0; $j < count($to_do_status); $j++) {

        if ($to_do[$i]['id_status'] == $to_do_status[$j]['id_status']) {

            $status_select = $status_select . "<option selected=\"1\" value=\"" . $to_do_status[$j]['id_status'] . "\">" . $to_do_status[$j]['status'] . "</option>";
        } else {

            $status_select = $status_select . "<option  value=\"" . $to_do_status[$j]['id_status'] . "\">" . $to_do_status[$j]['status'] . "</option>";
        }
    }
    $status_select = $status_select . "</select>";


    //формируем select исполнителей
    $executor_select ="<select id=\"executor_select_". $to_do[$i]['id_to_do'] ."\">";

    for ($k = 0; $k < count($to_do_executor); $k++) {

        if( $to_do[$i]['id_executor'] == $to_do_executor[$k]['id_executor'] ){

            $executor_select = $executor_select."<option selected=\"1\" value=\"" .$to_do_executor[$k]['id_executor']. "\">".$to_do_executor[$k]['surname']." ".$to_do_executor[$k]['name']." ".$to_do_executor[$k]['middle_name']."</option>";

        }else{

            $executor_select = $executor_select."<option  value=\"" .$to_do_executor[$k]['id_executor']. "\">".$to_do_executor[$k]['surname']." ".$to_do_executor[$k]['name']." ".$to_do_executor[$k]['middle_name']."</option>";

        }

    }
    $executor_select = $executor_select."</select>";

    $table = $table .
            "<tr>"
            . "<td>"
            . "<button data-id_to_do=\"" . $to_do[$i]['id_to_do'] . "\" "
            . "onClick=\"javascript: to_do_update(this.dataset.id_to_do)\">Сохранить</button>"
            . "</td>"
            . "<td>"
            . "<textarea rows=\"5\" cols=\"32\" maxlength=\"500\" id=\"to_do_".$to_do[$i]['id_to_do'] ."\">" . $to_do[$i]['body'] . "</textarea>"
            . "</td>"
            . "<td>" . $status_select . "</td>"
            . "<td>" . $to_do[$i]['date_start'] . "</td>"
            . "<td>" . $executor_select ."</td>"
            . "<td>"
            . "<button data-id_to_do=\"" . $to_do[$i]['id_to_do'] . "\" "
            . "onClick=\"javascript: to_do_delete(this.dataset.id_to_do)\">Удалить</button>"
            . "</td>"
            . "</tr>";
}

$table = $table . '</tbody></table>';

// ответ клиенту
echo $api_obj->response($table, 200);
