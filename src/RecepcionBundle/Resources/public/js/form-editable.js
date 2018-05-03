var FormEditable = function () {

    $.mockjaxSettings.responseTime = 500;

    var log = function (settings, response) {
        
        if(settings.data != undefined){
            var option = settings.data.value;
            var id = settings.data.name.substr(-1, 1);            
            if(option > 1){
                $('#divMotivo_'+id).show();                
            }else{
                $('#txt_motivo_'+id).code('');
                $('#divMotivo_'+id).hide();
            }
        }
    }

    var initAjaxMock = function () {
        //ajax mocks

        $.mockjax({
            url: '/post',
            response: function (settings) {
                log(settings, this);
            }
        });

        $.mockjax({
            url: '/error',
            status: 400,
            statusText: 'Bad Request',
            response: function (settings) {
                this.responseText = 'Please input correct value';
                log(settings, this);
            }
        });
                
        $.mockjax({
            url: '/status',
            status: 500,
            response: function (settings) {
                this.responseText = 'Internal Server Error';
                log(settings, this);
            }
        });

        $.mockjax({
            url: '/groups',
            response: function (settings) {
                this.responseText = [{
                        value: 0,
                        text: 'Sin evaluar'
                    }, {
                        value: 1,
                        text: 'Favorable'
                    }, {
                        value: 2,
                        text: 'Observado'
                    }, {
                        value: 3,
                        text: 'Desfavorable'
                    }
                ];
                
                log(settings, this);
            }
        });
                

    }

    var initEditables = function (value) {
        var cboEval = value.split(",");
        
        //set editable mode based on URL parameter
        if (Metronic.getURLParameter('mode') == 'inline') {
            $.fn.editable.defaults.mode = 'inline';
            $('#inline').attr("checked", true);
            jQuery.uniform.update('#inline');
        } else {
            $('#inline').attr("checked", false);
            jQuery.uniform.update('#inline');
        }

        //global settings 
        $.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = '/post';

        $.each(cboEval, function( index, value ) {
            $('#group_'+value).editable({ showbuttons: false });
        });
    }

    return {
        //main function to initiate the module
        init: function (value) {

            // inii ajax simulation
            initAjaxMock();

            // init editable elements
            initEditables(value);
        }

    };

}();