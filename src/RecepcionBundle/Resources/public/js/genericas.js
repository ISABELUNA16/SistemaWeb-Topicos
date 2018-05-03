/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function validTdoc(e) {
    var tdoc = $('#cbo_tdoc').val();
    if (tdoc === '1' || tdoc === '6') {
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57 || key === 8 || key === 0)
    }else{
        var tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla==8 || tecla==0) return true; // 3
            patron =/\w/; // Acepta números y letras
            te = String.fromCharCode(tecla); // 5
        return patron.test(te);
    }
}

function validTdoccOMP(e) {
    var tdoc = $('#cbo_documento').val();
    if (tdoc === '1' || tdoc === '6') {
        var key = window.Event ? e.which : e.keyCode
        return (key >= 48 && key <= 57 || key === 8 || key === 0)
    }else{
        var tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla==8 || tecla==0) return true; // 3
            patron =/\w/; // Acepta números y letras
            te = String.fromCharCode(tecla); // 5
        return patron.test(te);
    }
}

function soloNumeros(e) {
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57 || key === 8 || key === 0)
}

var App = function () {
};

App.send = function (url, data, type, dataType) {
    var rpta;

    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: dataType,
        beforeSend: function (jqXHR) {
            $('#divProcesando').show();
        },
        success: function (data_response) {
            rpta = data_response;
            $('#divProcesando').hide();
        },
        error: function () {
            console.log('Error: Ocurrio un problema al cargar ' + url);
            jAlert('error', 'Un error ha ocurrido durante el proceso. Consulte con el Administrador', 'Sistema de Resoluciones Deportivo', null);
        }
    });

    return rpta;
};
