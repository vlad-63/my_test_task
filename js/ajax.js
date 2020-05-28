// Отправляем на серевер ФИО исполнителя
function executor_add () {
    
    // получаем из input ФИО
    let surname =($('#inp_1').val()).trim();
    let name = ($('#inp_2').val()).trim();
    let middle_name = ($('#inp_3').val()).trim();

    if(!surname || !name || !middle_name){

        alert("Нельзя отправлять пустое поле! Заполните все поля!");

    }else{

        if (confirm("Добавить ИСПОЛНИТЕЛЯ?") == true) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "api/executor/add/add_executor.php",
                data: { metod: 'post', surname: surname, name: name, middle_name: middle_name },
                cache: false,
                success: function(responce){ 
                        $('div[id="result1"]').html(responce[0]); 

                }
            });
        }
        
        // очищаем input 
        $('#inp_1').val('');
        $('#inp_2').val('');
        $('#inp_3').val('');
        
        // Получаем с сервера таблицу ИСПОЛНИТЕЛЕЙ
        executor_disp ();
        
        // Получаем с сервера select ИСПОЛНИТЕЛЕЙ для формы дбавления задач
        executor_select ();
    }  
}

// Получаем с сервера таблицу ИСПОЛНИТЕЛЕЙ
function executor_disp () {
    
    // делаем задержку для асинхроного запроса
    setTimeout(() => { 
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/executor/disp/disp_executor.php",
        data: { metod: 'get', executor_status: 'table'},
        cache: false,
        success: function (responce) {
            $('div[id="disp_table"]').html(responce[0]);
 
        }
    });
    }, 500);
}   

// Получаем с сервера select ИСПОЛНИТЕЛЕЙ для формы дбавления задач
function executor_select () {
    
    // делаем задержку для асинхроного запроса
    setTimeout(() => { 
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/executor/disp/disp_executor.php",
        data: { metod: 'get', executor_status: 'select'},
        cache: false,
        success: function (responce) {
            $('select[id="executor_select"]').html(responce[0]);
 
        }
    });
    }, 500);
}

// Отправляем на серевер id для удаления записи об ИСПОЛНИТЕЛЕ
function executor_delete (id) {
    
    let id_executor = id;

    if (confirm("Удалить ИСПОЛНИТЕЛЯ?") == true) {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/executor/del/del_executor.php",
        data: { metod: 'delete', id_executor: id_executor },
        cache: false,
        success: function (responce) {
          $('div[id="result1"]').html(responce[0]);
 
        }
    });
    }
    
    // Получаем с сервера таблицу ИСПОЛНИТЕЛЕЙ
    executor_disp();

    // Получаем с сервера select ИСПОЛНИТЕЛЕЙ для формы дбавления задач
    executor_select();
}

// Отправляем на серевер данные для новой ЗАДАЧИ
function to_do_add () {
    
    // текст задачи
    let to_do_text =($('#to_do_text').val()).trim();
    
    // исполнитель
    let executor_select =$('#executor_select option:selected').text();
    
    // исполнитель id
    let id_executor =$('#executor_select').val();

    if(!to_do_text){

        alert("Заполните поле ЗАДАНИЕ");
        
    }else if(executor_select=="- Выберите исполнителя -"){
        
        alert("Выберите ИСПОЛНИТЕЛЯ");
        
    }else{

        if (confirm("Добавить ЗАДАНИЕ?") == true) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "api/to_do/add/add_to_do.php",
                data: { metod: 'post', to_do_text: to_do_text, id_executor: id_executor },
                cache: false,
                success: function(responce){ 
                        $('div[id="result1"]').html(responce[0]); 
                }
            });
        }
        // очищаем поле ЗАДАЧИ
        $('#to_do_text').val('');
        
        // Получаем с сервера таблицу ЗАДАЧ
        to_do_disp ();
    }  
}

// Получаем с сервера таблицу всех ЗАДАЧ
function to_do_disp () {
//    alert ("ALL");
    // задержка для корректной работы, при асинхроном запросе
    setTimeout(() => { 
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/to_do/disp/disp_to_do.php",
        data: { metod: 'get', disp_status: 'all' },
        cache: false,
        success: function (responce) {
            $('div[id="disp_table"]').html(responce[0]);
 
        }
    });
    }, 500);
    
}

// Получаем с сервера таблицу ЗАДАЧ в работе
function to_do_disp_act () {
//    alert ("ACT");
    setTimeout(() => { 
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/to_do/disp/disp_to_do.php",
        data: { metod: 'get', disp_status: '1' },
        cache: false,
        success: function (responce) {
            $('div[id="disp_table"]').html(responce[0]);
 
        }
    });
    }, 500);
    
}

// Получаем с сервера таблицу ЗАДАЧ завершённых
function to_do_disp_end () {
//    alert ("END");
    setTimeout(() => { 
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/to_do/disp/disp_to_do.php",
        data: { metod: 'get', disp_status: '2' },
        cache: false,
        success: function (responce) {
            $('div[id="disp_table"]').html(responce[0]);
 
        }
    });
    }, 500);
    
}

// Получаем с сервера таблицу ЗАДАЧ просроченных
function to_do_disp_late () {
//    alert ("LATE");
    setTimeout(() => { 
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/to_do/disp/disp_to_do.php",
        data: { metod: 'get', disp_status: '3' },
        cache: false,
        success: function (responce) {
            $('div[id="disp_table"]').html(responce[0]);
 
        }
    });
    }, 500);
    
}

// Получаем с сервера таблицу ЗАДАЧ приостановленных
function to_do_disp_stop () {
//    alert ("STOP");
    setTimeout(() => { 
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/to_do/disp/disp_to_do.php",
        data: { metod: 'get', disp_status: '4' },
        cache: false,
        success: function (responce) {
            $('div[id="disp_table"]').html(responce[0]);
 
        }
    });
    }, 500);
    
}

// Получаем с сервера таблицу ЗАДАЧ отменённых
function to_do_disp_cancel () {
//    alert ("CANCEL");
    setTimeout(() => { 
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/to_do/disp/disp_to_do.php",
        data: { metod: 'get', disp_status: '5' },
        cache: false,
        success: function (responce) {
            $('div[id="disp_table"]').html(responce[0]);

        }
    });
    }, 500);
    
}

// удаляем ЗАДАЧУ
function  to_do_delete (id){
    
    let id_to_do = id;
    
    //alert(id_executor);
     if (confirm("Удалить ЗАДАЧУ?") == true) {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/to_do/del/del_to_do.php",
        data: { metod: 'delete', id_to_do: id_to_do },
        cache: false,
        success: function (responce) {
          $('div[id="result1"]').html(responce[0]);
 
        }
    });
    }
    
    // Получаем с сервера таблицу всех ЗАДАЧ
    to_do_disp ();
    
}

// Корректируем ЗАДАЧУ
function  to_do_update (id){
    
    let id_to_do = id;
    
    // текст ЗАДАЧИ
    let td = "#to_do_"+id;
    let to_do_text =($(td).val()).trim();
    
    // статус
    let ss = "#status_select_"+id+" option:selected";
    let id_status =$(ss).val();
    
    // исполнитель
    let es = "#executor_select_"+id+" option:selected";
    let id_executer =$(es).val();
      
//    alert("to_do_text="+to_do_text+";id_status="+id_status+";id_to_do="+id_to_do+";id_executer="+id_executer);

    if (confirm("Изменить ЗАДАЧУ?") == true) {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "api/to_do/update/update_to_do.php",
        data: { metod: 'update', id_to_do: id_to_do, to_do_text: to_do_text, id_status: id_status, id_executer: id_executer },
        cache: false,
        success: function (responce) {
          $('div[id="result1"]').html(responce[0]);
 
        }
    });
    }
    
    // Получаем с сервера таблицу всех ЗАДАЧ
    to_do_disp ();
    
}