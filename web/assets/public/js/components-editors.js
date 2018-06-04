var ComponentsEditors = function () {
    
    var handleWysihtml5 = function () {
        if (!jQuery().wysihtml5) {
            return;
        }

        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["/sisweb/recursos/assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
            });
        }
    }

    var handleSummernote = function (value) {
        var cboEval = value.split(",");
        $.each(cboEval, function( index, value ) {
            $('#txt_motivo_'+value).summernote({height: 30});
        });        
        
        //API:
        //var sHTML = $('#summernote_1').code(); // get code
        //$('#summernote_1').destroy(); // destroy
    }

    return {
        //main function to initiate the module
        init: function (value) {
            handleWysihtml5();
            handleSummernote(value);
        }
    };

}();