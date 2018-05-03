function sendEvalInfTec(value){
    var obj = { cboevaluacion: $('#cboevaluacion').val(), txtObsInftTecn: $('#txtObsInftTecn').val()}
    var formURL = '/mecenazgo/web/general/informe/'+value;
    $.ajax({
        url: formURL,
        type: "POST",
        data: obj,
        dataType: 'json',
        beforeSend: function () {
            $('#divProcesando').show();
        },
        success: function (data, textStatus, jqXHR) {
            $('#divProcesando').hide();
            if (data.status) {
                jAlert('success', data.message, 'Sistema de Mecenazgo Deportivo', null);
                $('#genInfCom').html('<li class="active"><a class="btn btn-circle btn-danger colorbnt" href="/public/web/general/informe/informeConsejo/'+value+'">Generar Informe</a></li>');
                $('#btnEvalInfTec').remove();
            } else {
                jAlert('danger', data.message, 'Sistema de Mecenazgo Deportivo', null);
            }
        }
    });
    
    return false;
};

function changeEval(value){ 
    alert(value);
    $('#txtObsInftTecn').val('');
//    if(value == '2'){
//        $('#divObsEval').show();
//    }else{
//        $('#divObsEval').hide();
//    }
//
//    if(value == '1'){
//        $('#divFiles').show();
//    }else{
//        $('#divFiles').hide();
//    }
}