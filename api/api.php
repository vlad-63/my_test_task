<?php

class api {

    // отправляем ответ клиенту
    public function response($data, $status = 500) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode(array($data));
    }

    // формируем статус выполнения скрипта на сервере
    public function requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }

    // инициируем метод GET|POST|PUT|DELETE полученный от клиента
    public function init_metod($metod,$value1) {

        if (isset($metod) && $metod == $value1) {

            $this->property = $value1;

        }else{

            exit($this->response("Метод $metod не поддерживается",405));

        }

        return  $this->property;
    }

    // инициируем параметры полученные от клиента
    public function init_request($param,$value2) {

        if (isset($param)&& !empty($param)) {

            $this->property = $param;

        }else{

            exit($this->response("Параметр $value2 не найден",404));
        }

        return  $this->property;
    }

}