/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function loadSolicitante(value) {
    var obj = {cod: value};
    $('#nivel_fede').hide();
    $('#nivel_doc').hide();

    if (value === '1') {
        $('#verif').text('Verificar');
        $('#nivel_doc').show();
    } else {
        $('#verif').text('Continuar');
    }

    $.ajax({
        url: 'loadbeneficiario',
        type: 'GET',
        data: obj,
        dataType: 'json',
        beforeSend: function (jqXHR) {
            $('#divProcesando').show();
            $('#block_valid').empty();
        },
        success: function (data_response) {
            $('#divProcesando').hide();
            if (data_response.status) {
                var cboBeneficiario = '<option value="">[Seleccione]</option>';
                var cboTipoDoc = '<option value="">[Seleccione]</option>';
                $.each(data_response.benef, function (item) {
                    cboBeneficiario += '<option value="' + data_response.benef[item].id + '">' + data_response.benef[item].nombre + '</option>';
                });

                $.each(data_response.tdoc, function (item) {
                    cboTipoDoc += '<option value="' + data_response.tdoc[item].id + '">' + data_response.tdoc[item].nombre + '</option>';
                });

                $('#cbo_benef').html(cboBeneficiario);
                $('#cbo_tdoc').html(cboTipoDoc);
            }
        },
        error: function () {
            $('#divProcesando').hide();
            jAlert('error', 'Un error ha ocurrido durante el proceso. Consulte con el Administrador', 'Sistema de Resoluciones ', null);
        }
    });

    return false;
}


$('#verif').click(function () {
    var obj = {benef: $('select[name=cbo_benef]').val(), tdoc: $('select[name=cbo_tdoc]').val(), ndoc: $('#txt_numerodoc').val()};
    if (obj.ndoc != '' && obj.tdoc != '' && obj.benef != '') {        
        var valbenef = true;
        if(obj.benef === '6'){
            if($('#cbo_benefRenade').val() === ''){
                valbenef = false;
            }
        }else if(obj.benef === '3' && $('#fileconadis').val() === ''){
            valbenef = false;
        }

        var valndoc = true;
        if(obj.tdoc === '1' && obj.ndoc.length !== 8){
            valndoc = false;
        }else if(obj.tdoc === '4' && obj.ndoc.length >= 12){
            valndoc = false;
        }else if(obj.tdoc === '6' && obj.ndoc.length != 11){
            valndoc = false;
        }else if(obj.tdoc === '7' && obj.ndoc.length >= 12){
            valndoc = false;
        }
        
        if(!valbenef){
            jAlert('info', 'Para poder continuar deberá ingresar los campos requeridos.', 'Sistema de Resoluciones ', null);
            return false;
        }
        if(!valndoc){
            jAlert('info', 'Ingrese correctamente un documento válido.', 'Sistema de Resoluciones ', null);
            return false;
        }
        
        $.ajax({
            url: 'validabenef',
            type: 'GET',
            data: obj,
            dataType: 'html',
            beforeSend: function (jqXHR) {
                $('#divProcesando').show();
                $('#block_valid').empty();
                $('li').addClass('active');
                document.getElementById("classActivespan").className = 'badge badge-success badge-active';
                $('#temp').empty();
            },
            success: function (data_response) {
                $('#divProcesando').hide();
                $('#block_valid').html(data_response);
                var a = document.getElementById("div_message").innerText;
                if (a === 'success') {
                    $('#classNivel1').removeClass('active');
                    document.getElementById("classActivespan").className = 'badge badge-success';
                    $('#temp').addClass('active');
                    $('#temp').append('<a href="javascript:;"><span class="badge badge-success badge-active"> 2 </span> Registro de Actividad Deportiva </a>');
                }
            },
            error: function () {
                $('#divProcesando').hide();
                jAlert('error', 'Un error ha ocurrido durante el proceso. Consulte con el Administrador', 'Sistema de Resoluciones ', null);
            }
        });
        return true;
    }else{
        jAlert('info', 'Para poder continuar deberá ingresar los campos requeridos.', 'Sistema de Resoluciones ', null);
        return false;
    }

    
})

function loadFDN(value) {
    $('#loadConadis').empty();
    $('#block_valid').empty();
    $('li').addClass('active');
    document.getElementById("classActivespan").className = 'badge badge-success badge-active';
    $('#temp').empty();
    $('#txt_numerodoc').val('');
    var tbenef = $('#cbo_tipodocumento').val();
    if(value > 4){
        $("#txt_numerodoc").attr('maxlength',11);
    }else{
        document.submit_form.txt_numerodoc.removeAttribute('maxlength');
    }
    if (tbenef === '1') {
        if (value === '3') {
            var conadis = "<div class='form-group'><label class='control-label col-md-3'> Acreditación CONADIS <span class='required'> * </span></label><div class='col-md-9'><input type='file' class='form-control' name='fileconadis' id='fileconadis'><div class='help-block'>Adjuntar documento de acreditación en el CONADIS.</div></div></div>"
            $('#loadConadis').html(conadis);
        }
    } else {
        $('#nivel_doc').show();

        if (value === '6') {
            $('#nivel_fede').show();

            var obj = {cod: value};
            $.ajax({
                url: 'loadfdn',
                type: 'GET',
                data: obj,
                dataType: 'json',
                beforeSend: function (jqXHR) {
                    $('#divProcesando').show();
                },
                success: function (data_response) {
                    $('#divProcesando').hide();
                    if (data_response.status) {
                        var cboFDN = '<option value="">[Seleccione]</option>';
                        $.each(data_response.data, function (item) {
                            cboFDN += '<option value="' + data_response.data[item].id + '">' + data_response.data[item].nombre + '</option>';
                        });

                        $('#cbo_benefRenade').html(cboFDN);
                    }
                },
                error: function () {
                    $('#divProcesando').hide();
                    jAlert('error', 'Un error ha ocurrido durante el proceso. Consulte con el Administrador', 'Sistema de Resoluciones ', null);
                }
            });
        } else {
            $('#nivel_fede').hide();
        }
    }
}

function loadActDep(value) {
    $('#cbo_actDep').html('');
    if (value > 0) {
        var obj = {cod: value};
        $.ajax({
            url: 'loadactividaddeportiva',
            type: 'GET',
            data: obj,
            dataType: 'json',
            beforeSend: function (jqXHR) {
                $('#divProcesando').show();
            },
            success: function (data_response) {
                $('#divProcesando').hide();
                if (data_response.status) {
                    var cboActDep = '<option value="">[Seleccione]</option>';
                    $.each(data_response.data, function (item) {
                        cboActDep += '<option value="' + data_response.data[item].id + '">' + data_response.data[item].nombre + '</option>';
                    });

                    $('#cbo_actDep').html(cboActDep);
                }
            },
            error: function () {
                $('#divProcesando').hide();
                jAlert('error', 'Un error ha ocurrido durante el proceso. Consulte con el Administrador', 'Sistema de Resoluciones ', null);
            }
        });
    }
}
;

function validtdoc(value){
    $('#txt_numerodoc').val('');
    return;
}