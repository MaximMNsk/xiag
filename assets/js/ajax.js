//ajax.js

export default class Ajax
{
    answer;
    sendReq( url, params ){
        var d = $.Deferred();
        let answer = [];
        $.ajax({
            dataType: "json",
            type: "POST",
            url: url,
            data: $.param( params ),
            success: ( ans )=>{
                this.saveResp( ans );
                d.resolve();
            },
            error: (jqXHR, exception) => {
                this.ajaxError(jqXHR, exception);
                d.resolve();
            }
        });
        return d; 
    }

    saveResp( resp ){
        this.answer = resp;
    }
    
    waiting( way ) {
        if( way=='start' ){
            $("body").prepend("<div id=\"waiting\"><img src='../assets/img/loading-page.gif' id=\"waiting-img\" /></div>");
            $("#waiting").addClass('position-absolute w-100 h-100').css({"z-index":"500"});
            $("#waiting-img").css( {"top":"10%", "left":"37%"} ).addClass('position-fixed w-25');
            // $("body").attr("disabled", true);
        }else if( way=='stop' ){
            $("body").attr("disabled", false);
            $("#waiting").remove();
        }else{
            return false;
        }
    }
    
    
    ajaxError(jqXHR, exception){
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Can not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
        $("body").prepend('<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="dialog">'+
                            '<div class="modal-dialog modal-lg" role="document">'+
                                '<div class="modal-content">'+
                                    '<div class="modal-header">'+
                                        '<h5 class="modal-title">AJAX ERROR RESP</h5>'+
                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                                            '<span aria-hidden="true">&times;</span>'+
                                        '</button>'+
                                    '</div>'+
                                    '<div class="modal-body">'+
                                        '<p>'+msg+'</p>'+
                                        '<p>'+jqXHR.responseText+'</p>'+
                                    '</div>'+
                                '</div>'+
                            '</div>');
        $( "#dialog" ).modal();
    
    }

}
