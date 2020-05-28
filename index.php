<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Панель управления TaskTraker</title>

    <!--  CSS -->
    <link rel="stylesheet" type="text/css" href="css/form.css">

    <!-- JS Libs -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--    <script src='components/jquery3.5.1.js'></script>-->
    <script src='js/ajax.js'></script>
    <script src='js/input.js'></script>

</head>
<body onload="javascript: executor_select(), to_do_disp();">

    <!-- первая колонка Админ панель-->
    <div  class="col-3-10" >
        <div class="fixedblok">

        <fieldset>
                <legend>Добавляем исполнителя</legend>

                    <label>Исполнитель</label>
                    <div>
                        <input type="text" placeholder="Фамилия" size="44" maxlength="20" id="inp_1" onkeyup="limitInput( 'ru', this );">
                    </div>
                    <div>
                        <input type="text" placeholder="Имя" size="44" maxlength="20" id="inp_2" onkeyup="limitInput( 'ru', this );">
                    </div>
                    <div>
                        <input type="text" placeholder="Отчество" size="44" maxlength="20" id="inp_3" onkeyup="limitInput( 'ru', this );">
                    </div>

                    <div>
                        <input type="submit" value="Отправить данные" onclick="javascript: executor_add()" data-act="add">
                    </div>

        </fieldset>

            <fieldset>
                <legend>Оформляем новый трек</legend>

                    <label>Задание</label>
                    <div>
                        <textarea placeholder="Описание задания" rows="6" cols="32" maxlength="500" id="to_do_text"></textarea>
                    </div>
                    <label>Исполнитель</label>
                    <div>
                        <select name = "executor" id="executor_select">

                        </select>
                    </div>

                    <div>
                        <input type="submit" value="Отправить данные" onclick="javascript: to_do_add()">
                    </div>

            </fieldset>
            <div>

            </div>
        </div>
    </div>

<!--     вторая колонка-->
    <div class="col-4-10">
        <div>
            Отобразить задачи
            <button onClick="javascript: to_do_disp()">Все</button>
            <button onClick="javascript: to_do_disp_act()">В работе</button>
            <button onClick="javascript: to_do_disp_end()">Выполненные</button>
            <button onClick="javascript: to_do_disp_late()">Прсроченные</button>
            <button onClick="javascript: to_do_disp_stop()">Приостановленные</button>
            <button onClick="javascript: to_do_disp_cancel()">Отменёные</button>

        </div>

        <div id="disp_table">

        </div>

    </div>

</body>
</html>